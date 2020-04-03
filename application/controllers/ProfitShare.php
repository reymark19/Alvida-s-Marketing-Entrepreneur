<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class ProfitShare extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }


    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Profit Share');

        //get the list of packages
        $data['packages'] = $this->p->get();

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('ProfitShare/index', $data);
        $this->load->view('Layouts/footer');
    }



    // function get($id = null){

    //     if(is_numeric($id)){
    //         //from model to get 1 record
    //         $data['data'] = $this->c->get($id);
    //         $data['success'] = false;

    //         if($data){
    //             $data['success'] = true;
    //         }
    //         echo json_encode($data);    
    //     }
    //     else{
    //         $select = [
    //             '*'
    //         ];
    //         $data['data'] = $this->c->getjointable($select,null,$where);
    //         $msg['success'] = false;
    //         if($data){
    //             $msg['success'] = true;
    //         }

    //         echo json_encode($data);
    //     }
    // }

    function getMembers($id = null){
        $this->mod->isAdmin();
        //get the members that their max profit not exceed
        $data['Members'] = $this->acc->get(['CodeId'],['IsProfitShareMax' => 0, 'IsActive' => 1]);
        $select = [
            'Sum(Package.TotalShares) as NumberOfShares'
        ];
        $join = [
            'Package' => 'Codes.PackageId = Package.PackageId'
        ];

        $where = $data['Members'];
        $arr = [];
        foreach($where as $key)
        {
          array_push($arr, $key['CodeId']);
        }
        
        $where = 'Codes.CodeId in ('. implode(', ', $arr) . ')';
        $totalShares = $this->code->getjointable($select,$join,$where,null,null,null);
        //get the earn per account
        //$data['Count'] = count($data['Members']);
        $data['Count'] = $totalShares[0]['NumberOfShares'];

        $data['Members'] = $this->acc->get(['AccountId'],['IsProfitShareMax' => 0, 'IsActive' => 1]);
        $data['ProfitShare'] = $this->ps->get($id);
        $data['Earn'] = round($data['ProfitShare'][0]['Share'] / $data['Count'],2);
        $data['Count'] = count($data['Members']);

        $data['success'] = false;

        if($data != false){
            $data['success'] = true;
        }
        echo json_encode($data);    
    }

    function insert(){

        $this->mod->isAdmin();
        
        $field = [
            'Share' => $this->input->post('share'),
            'DateCreated' => date('Y-m-d H:i:s'),
        ];

        //Process insert here
        $data = $this->ps->insert($field);

        $msg['success'] = false;

        if($data != false){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    function updatePS(){
        $this->mod->isAdmin();
        $profitshareid = $this->input->post('idps');
        $share = $this->input->post('share');
        $max = $this->input->post('maxaccount');
        //update the profit share
        $fieldPS = [
            'ShareEachMember' => $share,
            'MemberCount' => $max,
            'DatePosted' => date('Y-m-d H:i:s')
        ];
        $this->ps->update($fieldPS,$profitshareid);
        $data['success'] = true;
        echo json_encode($data);
    }

    function distribute(){
        $this->mod->isAdmin();
        $accountid = $this->input->post('accountid');
        $profitshareid = $this->input->post('idps');
        $earn = $this->input->post('share');
        $max = $this->input->post('maxaccount');
        //insert earnings
        //get the account
        $account = $this->acc->get($accountid);
        $accountcode = $this->code->get($account[0]['CodeId']);
        $accountpackage = $this->package->get($accountcode[0]['PackageId']);
        $accountname = $account[0]['AccountName'];
        //new earn
        $earn = $earn * $accountpackage[0]['TotalShares'];
        //get the total earned in profit share
        $earnInProfit = $this->earnings->get("SUM(Credit) as Total",['Tag'=> 'ProfitShare', 'AccountName' => $account[0]['AccountName']]);
        //condition if adding this earn will exceed to max profit then update acc to maxprofit to false
        if (($earnInProfit[0]['Total'] + $earn) >= $accountpackage[0]['MaxProfitSharing']) {
            $field = [
                'IsProfitShareMax' => 1
            ];
            $this->acc->update($field, $accountid);
            $earn = $accountpackage[0]['MaxProfitSharing'] - $earnInProfit[0]['Total'];
        }

        //insert with no update
        $desc = $accountname . ' earned P'. $earn .' from Profit Share on '.date('Y-m-d H:i:s');
        //member side
        $fieldinMember = [
            'AccountName' => $accountname,
            'Debit' => 0,
            'Credit' => $earn,
            'Tag' => 'ProfitShare',
            'Description' => $desc,
            'DateCreated' => date('Y-m-d H:i:s')
        ];

        $this->earnings->insert($fieldinMember);

        //company
        $fieldinCompany = [
            'AccountName' => $accountname,
            'Debit' => $earn,
            'Credit' => 0,
            'Tag' => 'ProfitShare',
            'Description' => $desc,
            'DateCreated' => date('Y-m-d H:i:s')
        ];
        $this->ledger->insert($fieldinCompany);

        $this->method->logs($desc);
        
        $data['success'] = true;
        echo json_encode($data);
    }

    function getListJson()
    {
        //Data to be Display
        $select = [
            '*',
        ];

        //Condition Processes Start Here
        $where = null;
        //Condition base on delivery from supplier status
        // $estatus = $this->input->post('param[IsUsed]');
        // if($estatus == 'Used'){
        //     $where = 'IsUsed = 1';
        // }
        // elseif($estatus == 'Not Used'){
        //     $where = 'IsUsed = 0';
        // }
        // else {
        //     $where = null;
        // }
        //Condition base on filter

        //End of the Condition

        //Joined Related Table

        $columnSearch = [
            'Share',
            'ShareEachMember',
            'MemberCount',
        ];

        //Execute the statement above here
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ps->count_all(),
            "recordsFiltered" => $this->ps->count_filtered($select,null,$where,null,null,$columnSearch,['ProfitShareId' => 'desc']),
            "data" => $this->ps->get_datatables($select,null,$where,null,null,$columnSearch,['ProfitShareId' => 'desc'])
        );

        echo json_encode($output);
    }
}
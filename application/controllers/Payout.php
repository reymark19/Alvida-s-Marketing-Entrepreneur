<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Payout extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }


    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Payout');

        //get the list of packages
        $data['packages'] = $this->p->get();

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Payout/index', $data);
        $this->load->view('Layouts/footer');
    }

     function get($id = null){
        if(is_numeric($id)){
            //from model to get 1 record
            $data['data'] = $this->pay->get($id);
            $data['success'] = false;
            if($data != false){
                $data['success'] = true;
            }
            echo json_encode($data);    
        }

        else{
            $select = [
                '*'
            ];
            $from = "User";
            $data['data'] = $this->false->getjointable($select,$from,null,$where);
            $msg['success'] = false;
            if($data != false){
                $msg['success'] = true;
            }
            echo json_encode($data);
        }
    }


    function insert(){
        $this->mod->isUser();
        //get current reward earned

        $currentEarnedDebitObj = $this->earnings->get('SUM(Debit) as TotalDebit', ['AccountName' => $_SESSION['AccountName']]);
        $currentEarnedCreditObj = $this->earnings->get('SUM(CREDIT) as TotalCredit', ['AccountName' => $_SESSION['AccountName']]);
        $currentEarned = $currentEarnedCreditObj[0]['TotalCredit'] - $currentEarnedDebitObj[0]['TotalDebit'];
        $transactiontype = $this->input->post('transactiontype');
        if ($currentEarned >= $this->input->post('amount')) {
            $field = [
                'AccountId' => $_SESSION['AccountId'],
                'Fullname' => $this->input->post('fullname'),
                'TransactionType' => $transactiontype,
                'AccountNumber' => $this->input->post('accountnumber'),
                'AccountName' => $this->input->post('accountnamefrom'),
                'Amount' => abs($this->input->post('amount')),
                'Address' => $this->input->post('address'),
                'Contact' => $this->input->post('contact'),
                'Email' => $this->input->post('email'),
                'IsApproved' => 0,
                'IsActive' => 1,
                'DateCreated' => date('Y-m-d H:i:s'),
            ];
            
            //update the old one that wasn't approve to in active and not approved with message of cancelled
            $this->pay->update(['IsActive'=> 0,'Message'=>'Cancelled'],['AccountId'=>$_SESSION['AccountId'],'IsApproved' => 0,'IsActive'=>1]);
            //Process insert here
            $data = $this->pay->insert($field);

            $msg['success'] = false;

            if($data != false){
                $msg['success'] = true;
                $msg['message'] = 'Request Payout successfully sent';
            }
            echo json_encode($msg);
        }
        else{
            $msg['success'] = false;
            $msg['message'] = 'Must be lower than your reward earned';
            echo json_encode($msg);
        }
        
    }

    function update(){

        $this->mod->isAdmin();

        $message = $this->input->post('message');
        $id = $this->input->post('id');
        //update the profit share
        $field = [
            'Message' => $message,
        ];
        $this->pay->update($field,$id);
        $data['success'] = true;
        echo json_encode($data);
    }

    function updateStatus(){

        $id = $this->input->post('id');
        $getPayout = $this->pay->get($id)[0];

        $checked = $this->input->post('checked');

        if($checked === '1'){
            $checked = false;
        }
        else{
            $checked = true;
        }

        $field = array(
        'IsApproved' => $checked,
        'DateApproved' => date('Y-m-d H:i:s')
        );

        $data = $this->pay->update($field,$id);

        $msg['success'] = false;

        if($data != false){
            $getAccount = $this->acc->get($getPayout['AccountId'])[0];
            $accountname = $getAccount['AccountName'];
            //member side
            $fieldinMember = [
                'AccountName' => $accountname,
                'Debit' => $getPayout['Amount'],
                'Credit' => 0,
                'Tag' => 'Encashment',
                'Description' => 'Request payout approved on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];

            $this->earnings->insert($fieldinMember);
            //for the tax and the admin fee
            $oamount = $getPayout['Amount'];
            $tax = ((float)$oamount) * .10;
            $adminfee = 100;
            $totalencash = $oamount - $tax - $adminfee;
            //company
            $fieldinCompany = [
                'AccountName' => $accountname,
                'Debit' => $totalencash,
                'Credit' => 0,
                'Tag' => 'Encashment',
                'Description' => 'Request payout approved on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];
            $this->ledger->insert($fieldinCompany);
            //tax
            $fieldinCompany = [
                'AccountName' => $accountname,
                'Debit' => $tax,
                'Credit' => 0,
                'Tag' => 'Tax',
                'Description' => 'Tax for the request payout from '.$accountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];
            $this->ledger->insert($fieldinCompany);
            //adminfee
            $fieldinCompany = [
                'AccountName' => $accountname,
                'Debit' => $adminfee,
                'Credit' => 0,
                'Tag' => 'AdminFee',
                'Description' => 'Admin fee for the request payout from '.$accountname.' on '.date('Y-m-d H:i:s'),
                'DateCreated' => date('Y-m-d H:i:s')
            ];
            $this->ledger->insert($fieldinCompany);


            $this->method->logs('Request payout from '.$accountname.' approved on '.date('Y-m-d H:i:s'));

            $msg['success'] = true;
            $msg['message'] = false;
            echo json_encode($msg);
        }
        

    }   

    function updateStatusActive(){

        $id = $this->input->post('id');
        $getPayout = $this->pay->get($id)[0];

        $checked = $this->input->post('checked');

        if($checked === '1' && $getPayout['IsApproved'] == 1){
            $checked = false;
            $field = array(
            'IsActive' => $checked
            );

            $data = $this->pay->update($field,$id);

            if($data != false){
                $getAccount = $this->acc->get($getPayout['AccountId'])[0];
                $accountname = $getAccount['AccountName'];
                //member side
                $fieldinMember = [
                    'AccountName' => $accountname,
                    'Debit' => 0,
                    'Credit' => $getPayout['Amount'],
                    'Tag' => 'Encashment',
                    'Description' => 'Reward earned adjustment on '.date('Y-m-d H:i:s'),
                    'DateCreated' => date('Y-m-d H:i:s')
                ];

                $this->earnings->insert($fieldinMember);

                //for the tax and the admin fee
                $oamount = $getPayout['Amount'];
                $tax = ((float)$oamount) * .10;
                $adminfee = 100;
                $totalencash = $oamount - $tax - $adminfee;

                //company
                $fieldinCompany = [
                    'AccountName' => $accountname,
                    'Debit' => 0,
                    'Credit' => $totalencash,
                    'Tag' => 'Encashment',
                    'Description' => 'Reward earned adjustment on '.date('Y-m-d H:i:s'),
                    'DateCreated' => date('Y-m-d H:i:s')
                ];
                $this->ledger->insert($fieldinCompany);
                //tax
                $fieldinCompany = [
                    'AccountName' => $accountname,
                    'Debit' => 0,
                    'Credit' => $tax,
                    'Tag' => 'Tax',
                    'Description' => 'Tax adjustment for the request payout from '.$accountname.' on '.date('Y-m-d H:i:s'),
                    'DateCreated' => date('Y-m-d H:i:s')
                ];
                $this->ledger->insert($fieldinCompany);
                //adminfee
                $fieldinCompany = [
                    'AccountName' => $accountname,
                    'Debit' => 0,
                    'Credit' => $adminfee,
                    'Tag' => 'AdminFee',
                    'Description' => 'Admin fee adjustment for the request payout from '.$accountname.' on '.date('Y-m-d H:i:s'),
                    'DateCreated' => date('Y-m-d H:i:s')
                ];
                $this->ledger->insert($fieldinCompany);

                $msg['success'] = true;
                $msg['message'] = false;
                echo json_encode($msg);
            }
        }
        else if($checked === '1'){
            $checked = false;
            $field = array(
            'IsActive' => $checked
            );

            $data = $this->pay->update($field,$id);

            $msg['success'] = true;
            $msg['message'] = false;
            echo json_encode($msg);
        }
        else{
            $checked = true;
            $field = array(
            'IsActive' => $checked
            );

            $data = $this->pay->update($field,$id);

            $msg['success'] = true;
            $msg['message'] = false;
            echo json_encode($msg);
        }

                

    }   

    function getListJson($type = 0)
    {

        //Data to be Display
        $select = [
            '*',
        ];

        //Condition Processes Start Here
        $where = null;
        //Condition base on delivery from supplier status
        $estatus = $this->input->post('param[IsApproved]');
        if($estatus == 'Approved'){
            $where = 'IsApproved = 1 and IsActive = 1';
        }
        elseif($estatus == 'Not Approved'){
            $where = 'IsApproved = 0 and IsActive = 1';
        }
        else {
            $where = null;
        }
        if ($type != 0) {
            $accountid = $_SESSION['AccountId'];
            $where = 'AccountId = '.$accountid.' and IsActive = 1';
        }
        //Condition base on filter

        //End of the Condition

        //Joined Related Table

        $columnSearch = [
            'Fullname',
            'AccountName',
            'AccountNumber',
            'Amount',
            'Contact',
        ];

        //Execute the statement above here
        $filter = $this->pay->count_filtered($select,null,$where,null,null,$columnSearch,['PayoutId' => 'desc']);
        //var_dump($this->db->last_query());
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $type != 0 ? $filter : $this->pay->count_all(),
            "recordsFiltered" => $filter,
            "data" => $this->pay->get_datatables($select,null,$where,null,null,$columnSearch,['PayoutId' => 'desc'])
        );
        
        echo json_encode($output);
    }
}

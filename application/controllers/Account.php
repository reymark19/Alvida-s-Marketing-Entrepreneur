<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Account extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Accounts');


        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Account/index', $data);
        $this->load->view('Layouts/footer');

    }



    function get($id = null){

        if(is_numeric($id)){

            //from model to get 1 record

            $data['data'] = $this->acc->get($id);

            $data['success'] = false;

            if($data){
                $data['success'] = true;
            }

            echo json_encode($data);    

        }

        else{

            $select = [
                '*'
            ];

            $data['data'] = $this->acc->getjointable($select,null,$where);

            $msg['success'] = false;

            if($data){

                $msg['success'] = true;

            }

            echo json_encode($data);

        }

        

    }



    function insert(){
        if ($_SESSION['token'] == $this->input->post('token')) {
            $code = $this->c->get(['Code' => $this->input->post('code')]);
            //get the post data here


            if ($code != false && $code[0]['IsUsed'] != 1) {
               $field = [
                    'AccountName' => 'AC'. $_SESSION['UsersId'] . date('ymdHis'),
                    'CodeId' => $code[0]['CodeId'],
                    'UsersId' => $_SESSION['UsersId'],
                    'IsActive' => 1,
                    'DateCreated' => date('Y-m-d H:i:s'),
                    'DateActive' => date('Y-m-d H:i:s')
                ];

                //Process insert here
                $data = $this->acc->insert($field, 1);
                $accountname = $data[0]['AccountName'];
                $this->method->logs('new account created '.$accountname.' on '.date('Y-m-d H:i:s'));

                $fieldCode = [
                    'IsUsed' => 1,
                    'DateUsed' => date('Y-m-d H:i:s')
                ];

                $this->c->update($fieldCode,$code[0]['CodeId']);
                $this->method->logs('code updated and used by '.$accountname.' on '.date('Y-m-d H:i:s'));

                $package = $this->package->get(['PackageId' => $code[0]['PackageId']])[0];
                //insert the mvp points
                $this->method->addMvpPoints($data,$data[0]['AccountId'],$package['MVP']);


                $msg['success'] = false;

                if($data != false){

                    //add to netword
                    $fieldNetwork = [
                        'AccountId' => $data[0]['AccountId']
                    ];
                    $this->network->insert($fieldNetwork);
                    $this->method->logs('new added network '.$accountname.' on '.date('Y-m-d H:i:s'));


                    //after all the process was success
                    //then add earnings to company base on the package of the new members
                    $earn = $package['Cost'];
                    $fieldinCompany = [
                        'AccountName' => $accountname,
                        'Debit' => 0,
                        'Credit' => $earn,
                        'Tag' => 'Company',
                        'Description' => 'Earned from new member '.$accountname.' on '.date('Y-m-d H:i:s'),
                        'DateCreated' => date('Y-m-d H:i:s')
                    ];
                    $this->ledger->insert($fieldinCompany);

                    $this->method->logs('Earned from new member '.$accountname.' on '.date('Y-m-d H:i:s'));

                    //add cashback
                    $this->method->addCashBackReward($accountname);

                    $msg['success'] = true; 

                }

                echo json_encode($msg);
            }
            else{
                echo json_encode(false);
            }
        }
        else{
            echo json_encode(false);
        }
    }



    function update(){

        $id = $this->input->post('id');
        //

        //get the post data here

        $field = [

            'IsActive' => 1,
            'DateActive' => date('Y-m-d H:i:s')

        ];
        
        $data = $this->acc->update($field,$id);
        $msg['success'] = false;

        if($data != false){
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    function updateRefferal(){

        $id = $this->input->post('id');
        $accountname = $this->input->post('accountname');
        
        //get the person who referred
        $referby = $this->acc->get(['AccountName' => $accountname]);

        $field = [

            'ReferredById' => $referby[0]['AccountId']

        ];


        
        $data = $this->acc->update($field,$id);

        $msg['success'] = false;

        if($data != false){
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }


    function setReferral(){

        $token = $this->input->post('token');
        if ($_SESSION['token'] == $token) {
            $accountname = $this->input->post('accountname');
            //check the account if exist
            $account = $this->acc->isExisted(['AccountName' => $accountname]);

            $acc = $this->acc->get(['AccountName'],['AccountName' => $accountname, 'ReferredById' => null]);
            $valid = false;
             if ($acc == false) {
                 $valid = true;
            }

            //$valid = true; //to be tested
            if ($_SESSION['AccountName'] == $accountname) {
                $valid = false;
            }
            //var_dump($valid);
            if ($account && $valid) {
                //first we need to store in the referral table
                $field = array(
                    'ReferredById'=> $accountname
                );
                if (isset($_SESSION['AccountName'])) {
                    $data = $this->acc->update($field, ['AccountName' => $_SESSION['AccountName']]);
                    
                    $msg['success'] = false;

                    if($data != false){
                        //add earn by referral
                        $this->method->addEarnedInReferral($accountname, $_SESSION['AccountName']);

                        $msg['success'] = true;
                        $msg['message'] = false;
                        echo json_encode($msg);
                    }
                    else{
                        $msg['message'] = 'internal server error';
                        echo json_encode($msg);
                    }
                }
                else{
                    $msg['message'] = 'Error, Please reload the page.';
                    echo json_encode($msg);
                }
            }
            else{
                $msg['message'] = 'Account Not Found';
                echo json_encode($msg);
            }
        }
    }   



    function getListJson()

    {

        //Data to be Display

        $select = [
            '*'
        ];

        //Condition Processes Start Here

        $where = null;
        //Condition base on delivery from supplier status

        $estatus = $this->input->post('param[IsActive]');
        if($estatus == 'Active'){
            $where = 'IsActive = 1';
        }
        elseif($estatus == 'Not Active'){
            $where = 'IsActive = 0';
        }
        else {
            $where = null;
        }

        //Condition base on filter

        //End of the Condition

        //Joined Related Table

        $join = null;

        $columnSearch = [
            'AccountName',
        ];

        //Execute the statement above here

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->acc->count_all(),
            "recordsFiltered" => $this->acc->count_filtered($select,$join,$where,null,null,$columnSearch),
            "data" => $this->acc->get_datatables($select,$join,$where,null,null,$columnSearch),
            //"query" => $this->db->last_query()//for testing
        );

        echo json_encode($output);
    }

    function upload(){
        $imgdata = $this->acc->upload($this->input->post('imageid'),'',50,true,2);
        $data["success"] = false;
        if (!isset($imgdata["error"])) {
            # code...
            $data["data"] = $imgdata['data'];
            $data["success"] = true;

        }
        else{
            $data["error"] = $imgdata["error"];
        }
        echo json_encode($data);
    }

}
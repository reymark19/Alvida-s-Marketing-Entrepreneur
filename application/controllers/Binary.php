<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Binary extends CI_Controller

{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Admin');

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Binary/network');
        $this->load->view('Layouts/footer');

    }

    function network($accountname = null, $otherAccount = null) {

        //$this->mod->isUser();
        $this->method->SetMenu('Binary');
        //set accountname in session
        $accountname = $_SESSION['AccountName'];
        $data = null;
        if (is_null($accountname)) {
            $data = $this->method->getAccountInfo();
        }
        else{
            $data = $this->method->getAccountInfo($accountname);
        }
        $accountid = $data['Account']['AccountId'];
        if ($otherAccount != null) {
            $accountid = $this->acc->get(['AccountName' => $otherAccount])[0]['AccountId'];
        }

        //print_r($accountid);
        $network['network'] = $this->method->getNetworkInfo($accountid);
        $network['accountname'] = $data['Account']['AccountName'];
        //get the list of the new members not assign
        $network['newmembers'] = $this->method->getToBeAssignMember($accountid);

        if ($network['newmembers'] != false) {
            $data['newmembertobeassigncnt'] = count($network['newmembers']);
        }
        else{
            $data['newmembertobeassigncnt'] = 0;
        }
        $network['membersCnt'] = $data['newmembertobeassigncnt'];
        //print_r($network);
        $this->load->view('Layouts/newheader');
        $this->load->view('Layouts/newmenu',$data);
        $this->load->view('Binary/newnetwork',$network);
        $this->load->view('Layouts/newfooter');

    }
    function getnetworklist($accountid = null) {
        $this->mod->isUser();
        $data = null;
        if ($this->input->post('token') == $_SESSION['token']) {
            if (is_null($accountid)) {
                $data = $this->method->getNetworkInfo($_SESSION['AccountId']);
            }
            else{
                $data = $this->method->getNetworkInfo($accountid);
            }

            //$data['query'] = $this->db->last_query();
            echo json_encode($data);
        }
        else{
            echo false;
        }
    }



    function get($id = null){

        if(is_numeric($id)){

            //from model to get 1 record

            $data['data'] = $this->u->get($id);

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

            $from = "User";

            $data['data'] = $this->u->getjointable($select,$from,null,$where);

            $msg['success'] = false;

            if($data){

                $msg['success'] = true;

            }

            echo json_encode($data);

        }

        

    }



    function insert(){
        $isadmin = 0;
        if($this->input->post('isadmin') != ""){
            $isadmin = 1;
        }
        //get the post data here

        $isExist = $this->method->CheckUsernameExist($this->input->post('username'));
        if (!$isExist) {
            # code...
            $field = [

                'Fullname' => $this->input->post('fullname'),
                'Username' => $this->input->post('username'),
                'Password' => md5($this->input->post('password') . 'sm'),
                'DateCreated' => date('Y-m-d H:i:s'),
                'IsActive' => 1,
                'IsAdmin' => $isadmin,

            ];

            //Process insert here
            $data = $this->u->insert($field);

            $msg['success'] = false;

            if($data != false){
                $msg['success'] = true;
            }
            echo json_encode($msg);
        }
        else {
            $msg['success'] = false;
            $msg['message'] = "Username Exist!";
            echo json_encode($msg);
        }
    }



    function update($accountid = null){

        $token = $this->input->post('token');

        if ($token == $_SESSION['token']) {
            $networkid = $this->input->post('member');
            $position = $this->input->post('position');
            $currentaccountid = @$_SESSION['AccountId'];
            $isValid = false;
            //validate first
            $members = $this->method->getToBeAssignMember($currentaccountid);
            if ($members != false) {
               if (count($members) > 0) {
                   $cnt = 0;
                   foreach ($members as $m) {
                       if ($m['NetworkId'] == $networkid) {
                           $cnt++;
                       }
                   }
                   if ($cnt == 1) {
                       $isValid = true;
                   }
               }
               else{
                $data['message'] = "Invalid";
                echo json_encode($data);
               }
            }
            else{
                $data['message'] = "Invalid";
                echo json_encode($data);
            }
            //this will be the update process
            if ($isValid) {
                $field = [
                    'ParentId' => $accountid,
                    'Position' => $position,
                    'DateAssigned' => date('Y-m-d H:i:s')
                ];

                //check if the position is available
                $where = [
                    'ParentId' => $accountid,
                    'Position' => $position
                ];
                //get the parent must be set first or assign first
                $getCurrent = $this->net->get(['AccountId' => $accountid]);
                $theUpper = $this->net->get(['AccountId' => $getCurrent[0]['ParentId']]);
                if ($theUpper[0]['DateAssigned'] != null || $accountid == 1) {
                    $checknetwork = $this->net->get($where);
                    if ($checknetwork == false) {
                        $data = $this->net->update($field, $networkid);
                        $msg['success'] = false;
                        if($data != false){
                            $msg['success'] = true;
                        }
                        echo json_encode($msg);
                    }
                    else{
                        $data['message'] = "Please assign this member to other position left or right";
                        echo json_encode($data);
                    }
                }
                else{
                    $data['message'] = "Please Contact the Person who referred you for the binary position of your account";
                    echo json_encode($data);
                }
                
            }
            else{
                $data['message'] = "Invalid";
                echo json_encode($data);
            }
        }
        else{
            $data['message'] = 'Invalid Token';
            echo json_encode($data);
        }
        //get the post data here
        // $field = [
        //     'Fullname' => $this->input->post('fullname'),
        //     'Password' => md5($this->input->post('password') . 'sm'),
        // ];

        // $data = $this->u->update($field,$id);
        // $msg['success'] = false;

        // if($data){
        //     $msg['success'] = true;
        // }
    }



    function updateStatus(){

        $id = $this->input->post('id');

        $checked = $this->input->post('checked');
        if($id != 1){
            if($checked === '1'){

                $checked = false;

            }

            else{

                $checked = true;

            }

            $field = array(

                'IsActive'=>$checked

                );

            $data = $this->u->update($field,$id);

            $msg['success'] = false;

            if($data){
                $msg['success'] = true;
                $msg['message'] = false;
                echo json_encode($msg);
            }
        }
        else{
            $msg['success'] = false;
            $msg['message'] = "The primary admin cant be deactivate";
            echo json_encode($msg);
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

        if($estatus == 'active'){

            $where = 'IsActive = 1';

        }

        elseif($estatus == 'notactive'){

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

            'Fullname',

            'Username',

        ];

        //Execute the statement above here

        $output = array(

            "draw" => $this->input->post('draw'),

            "recordsTotal" => $this->u->count_all(),

            "recordsFiltered" => $this->u->count_filtered($select,$join,$where,null,null,$columnSearch),

            "data" => $this->u->get_datatables($select,$join,$where,null,null,$columnSearch),

            //"query" => $this->db->last_query()//for testing

        );

        echo json_encode($output);

    }

}
<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class User extends CI_Controller

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
        $this->load->view('User/index');
        $this->load->view('Layouts/footer');

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



    function update(){
        $id = $this->input->post('id');
        //get the post data here
        $field = [
            'Fullname' => $this->input->post('fullname'),
            'Password' => md5($this->input->post('password') . 'sm'),
        ];

        $data = $this->u->update($field,$id);
        $msg['success'] = false;

        if($data){
            $msg['success'] = true;
        }
        echo json_encode($msg);
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

            "query" => $this->db->last_query()//for testing

        );

        echo json_encode($output);

    }

}
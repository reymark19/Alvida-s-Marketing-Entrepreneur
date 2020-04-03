<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth extends CI_Controller

{

    function __construct()

    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
        // Load google oauth library
        //$this->load->library('google');
    }



    function login() {

        $where = array(
            'Username' => $this->input->post('username'),
            'Password' => md5($this->input->post('password') . 'sm'),
        );

        
        //get IsActive using username and password

        $data = $this->u->get($where);

        //check if is in Debug mode
        if ($data == false) {

            $where = array(
                'Username' => $this->input->post('username'),
                'IsUserModeDebug' => 1,
            );
            $data = $this->u->get($where);
            
        }

        //if $data return is false it means invalid username or password

        if ($data == false) {
            $this->method->googleSetting();
            //$msg['success'] = false;
            $msg['message'] = 'Invalid username or password.';
            //redirect(base_url()."Login"); 
            $this->load->view('Layouts/header');
            $this->load->view('Login/index',$msg);
            $this->load->view('Layouts/footer');           
        }

        else if($data != false){
            if($data[0]["IsActive"] == 1){
                $msg['success'] = true;
                $msg['message'] = 'Successfully login.';
                $msg['isadmin'] = $data[0]["IsAdmin"];
                $this->load->library('session');
                $this->session->set_userdata($data[0]);
                redirect(base_url()."Dashboard"); 

            }
            else{
                redirect(base_url()."Login");
                //$msg['success'] = false;
                //$msg['message'] = 'Your Account is not Active';
            }
        }
        //echo json_encode($msg);
    }

    function logout() {

        $description = "Successfully Logout Username: " . @$_SESSION['Username'];
        $this->load->library('session');
        $this->session->sess_destroy();

        redirect(base_url()."Login");
    }

}
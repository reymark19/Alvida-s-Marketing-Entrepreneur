<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Login extends CI_Controller

{

    function __construct()

    {

        parent:: __construct();

        $this->load->model('Models', 'mod');

    }



    function index(){

        if (isset($_SESSION['UserId'])) {

            redirect(base_url().'Dashboard');

        }

        //$this->method->setToken();

        $this->method->googleSetting();

        $this->load->view('Layouts/header');
        $this->load->view('Login/index');
        $this->load->view('Layouts/footer');

    }

}
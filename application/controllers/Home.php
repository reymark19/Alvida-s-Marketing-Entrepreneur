<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Home extends CI_Controller

{

    function __construct()

    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {


        $this->load->view('Layouts/header');
        $this->load->view('Layouts/homemenu');
        $this->load->view('Home/index');
        $this->load->view('Layouts/upperfooter');
        $this->load->view('Layouts/footer');

    }

}
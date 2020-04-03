<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Expenses extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }


    function index() {

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Expenses/index');
        $this->load->view('Layouts/footer');

    }


    function getCompanyExpensesList()
    {
        //Data to be Display
        $select = [
            '*',
        ];
        $where = null;
        $where = ['Tag' => 'Expense'];
        $join = null;

        $columnSearch = [
            'Debit',
            'Credit',
            'Tag',
            'Description',
        ];

        //Execute the statement above here
        $filter = $this->ledger->count_filtered($select,$join,$where,null,null,$columnSearch,['LedgerId' => 'desc']);
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $filter,
            "recordsFiltered" => $filter,
            "data" => $this->ledger->get_datatables($select,$join,$where,null,null,$columnSearch,['LedgerId' => 'desc'])
        );

        echo json_encode($output);
    }


    function insert(){

        $this->mod->isAdmin();
        $desc = $this->input->post('description');
        
        $fieldinCompany = [
            'AccountName' => 'Company',
            'Debit' => $this->input->post('debit'),
            'Credit' => 0,
            'Tag' => 'Expense',
            'Description' => $desc,
            'DateCreated' => date('Y-m-d H:i:s')
        ];

        $data = $this->ledger->insert($fieldinCompany);

        $this->method->logs('Expenses added: ' .$desc. ' ' .date('Y-m-d H:i:s'));

        if($data != false){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

}
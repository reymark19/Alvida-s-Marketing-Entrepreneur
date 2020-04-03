<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Package extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Package');


        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Package/index');
        $this->load->view('Layouts/footer');

    }



    function get($id = null){

        if(is_numeric($id)){

            //from model to get 1 record

            $data['data'] = $this->p->get($id);

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

            $data['data'] = $this->p->getjointable($select,null,$where);

            $msg['success'] = false;

            if($data != false){

                $msg['success'] = true;

            }

            echo json_encode($data);

        }

        

    }



    function insert(){

        //get the post data here
        $field = [

            'PackageName' => $this->input->post('packagename'),
            'MVP' => $this->input->post('mvp'),
            'Cost' => $this->input->post('cost'),
            'MaxProfitSharing' => $this->input->post('maxprofitsharing'),
            'MaxProfitSharingWeekly' => $this->input->post('maxprofitsharingweekly'),
            'DirectSalesBonus' => $this->input->post('directsalesbonus'),
            'MatchSalesBonus' => $this->input->post('matchsalesbonus'),
            'MatchSalesBonusDailyIncome' => $this->input->post('matchsalesbonusdailyincome'),

        ];

        //Process insert here
        $data = $this->p->insert($field);

        $msg['success'] = false;

        if($data != false){

            $msg['success'] = true;

        }



        echo json_encode($msg);

    }



    function update(){

        $id = $this->input->post('id');
        //

        //get the post data here

        $field = [

            'PackageName' => $this->input->post('packagename'),
            'MVP' => $this->input->post('mvp'),
            'Cost' => $this->input->post('cost'),
            'MaxProfitSharing' => $this->input->post('maxprofitsharing'),
            'MaxProfitSharingWeekly' => $this->input->post('maxprofitsharingweekly'),
            'DirectSalesBonus' => $this->input->post('directsalesbonus'),
            'MatchSalesBonus' => $this->input->post('matchsalesbonus'),
            'MatchSalesBonusDailyIncome' => $this->input->post('matchsalesbonusdailyincome'),

        ];
        
        $data = $this->p->update($field,$id);
        $msg['success'] = false;

        if($data != false){
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }



    function updateStatus(){

        $id = $this->input->post('id');

        $checked = $this->input->post('checked');
        if($checked === '1'){
            $checked = false;
        }
        else{
            $checked = true;
        }

        $field = array(
        'IsActive'=>$checked
        );

        $data = $this->p->update($field,$id);
        
        $msg['success'] = false;
        if($data != false){
            $msg['success'] = true;
            $msg['message'] = false;
            echo json_encode($msg);
        }
        else{
            $msg['message'] = 'Error on chaging package status. internal server error';
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
            'PackageName',
        ];

        //Execute the statement above here

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->p->count_all(),
            "recordsFiltered" => $this->p->count_filtered($select,$join,$where,null,null,$columnSearch),
            "data" => $this->p->get_datatables($select,$join,$where,null,null,$columnSearch),
            //"query" => $this->db->last_query()//for testing
        );

        echo json_encode($output);
    }

    function upload(){
        $imgdata = $this->p->upload($this->input->post('imageid'),'',50,true,2);
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
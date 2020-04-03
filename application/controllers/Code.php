<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Code extends CI_Controller

{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isAdmin();
        $this->method->SetMenu('Codes');

        //get the list of packages
        $data['packages'] = $this->p->get();

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Code/index', $data);
        $this->load->view('Layouts/footer');

    }



    function get($id = null){

        if(is_numeric($id)){

            //from model to get 1 record

            $data['data'] = $this->c->get($id);

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


            $data['data'] = $this->c->getjointable($select,null,$where);

            $msg['success'] = false;

            if($data != false){

                $msg['success'] = true;

            }

            echo json_encode($data);

        }

        

    }



    function insert(){

        $this->mod->isAdmin();
        $packageid = 0;
        //get the packageid
        $package = $this->p->get(['PackageName' => $this->input->post('packagename')]);
        $packageid = $package[0]['PackageId'];

        $code = strtoupper(md5(date('YmdHis') . uniqid() . 'smdb'));
        //get the post data here
        if (!$this->c->isExisted(['Code' => $code])) {
            $field = [
                'Code' => $code,
                'DateCreated' => date('Y-m-d H:i:s'),
                'PackageId' => $packageid
            ];

            //Process insert here
            $data = $this->c->insert($field);

            $msg['success'] = false;

            if($data != false){
                $msg['success'] = true;
            }
            echo json_encode($msg);
        }
        else{
            $msg['success'] = false;
            echo json_encode($msg);
        }

        
    }



    function update(){
        $this->mod->isAdmin();
        $id = $this->input->post('id');
        
        if ($this->input->post('packagename') == 'Package1') {
            $packageid = 1;
        }elseif ($this->input->post('packagename') == 'Package2') {
            $packageid = 2;
        }elseif ($this->input->post('packagename') == 'Package3') {
            $packageid = 3;
        }
        //get the post data here
        $field = [
            'PackageId' => $packageid
        ];

        $data = $this->c->update($field,$id);
        $msg['success'] = false;

        if($data != false){
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
            '*',
        ];

        //Condition Processes Start Here

        $where = null;



        //Condition base on delivery from supplier status

        $estatus = $this->input->post('param[IsUsed]');

        if($estatus == 'Used'){

            $where = 'IsUsed = 1';

        }

        elseif($estatus == 'Not Used'){

            $where = 'IsUsed = 0';

        }

        else {

            $where = null;

        }

        //Condition base on filter



        //End of the Condition

        //Joined Related Table

        $join = [
            'Package' => 'Package.PackageId = Codes.PackageId'
        ];



        $columnSearch = [

            'Fullname',

            'Username',

        ];

        //Execute the statement above here

        $output = array(

            "draw" => $this->input->post('draw'),

            "recordsTotal" => $this->c->count_all(),

            "recordsFiltered" => $this->c->count_filtered($select,$join,$where,null,null,$columnSearch,['CodeId' => 'desc']),

            "data" => $this->c->get_datatables($select,$join,$where,null,null,$columnSearch,['CodeId' => 'desc'])

        );

        echo json_encode($output);

    }

}
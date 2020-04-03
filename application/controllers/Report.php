<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class Report extends CI_Controller

{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function index() {

        $this->mod->isStaff();
        $this->method->SetMenu('Report');

        $this->load->view('Layouts/header');
        $this->load->view('Layouts/menu');
        $this->load->view('Report/index');
        $this->load->view('Layouts/footer');

    }



    function get($id = null){

        if(is_numeric($id)){

            //from model to get 1 record

            $data['data'] = $this->r->get($id);

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

            $data['data'] = $this->r->getjointable($select,$from,null,$where);

            $msg['success'] = false;

            if($data){

                $msg['success'] = true;

            }

            echo json_encode($data);

        }

        

    }



    function insert(){

        //get the post data here
        $field = [

            'ReportName' => $this->input->post('reportname'),
            'Description' => $this->input->post('description'),
            'FileId' => $this->input->post('fileid'),
            'Size' => $this->input->post('size'),
            'DateCreated' => date('Y-m-d H:i:s'),
            'CreatedBy' => $_SESSION['Fullname'],
            'IsActive' => 1,

        ];

        //Process insert here
        $data = $this->r->insert($field);

        $msg['success'] = false;

        if($data){

            $msg['success'] = true;

        }



        echo json_encode($msg);

    }



    function update(){

        $id = $this->input->post('id');
        //

        //get the post data here

        $field = [

            'ReportName' => $this->input->post('reportname'),
            'Description' => $this->input->post('description'),
            'Size' => $this->input->post('size'),

        ];
        
        if ($this->input->post('ischange') == 'true') {
            # code...
            $file = $this->f->upload(null,$this->input->post('reportname'),50,true);
            if (!isset($file["error"])) {
                # code...

                $field = [

                    'ReportName' => $this->input->post('reportname'),
                    'Description' => $this->input->post('description'),
                    'FileId' => $file['data'][0]['FileId'],
                    'Size' => $file['data'][0]['Size'],

                ];
            }
        }
        

        $data = $this->r->update($field,$id);

        

        $msg['success'] = false;

        if($data){

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

        $data = $this->r->update($field,$id);
        //var_dump($data);
        $msg['success'] = false;
        if($data != false){
            $msg['success'] = true;
            $msg['message'] = false;
            echo json_encode($msg);
        }
        else{
            $msg['message'] = 'Error on chaging User status. internal server error';
            echo json_encode($msg);
        }

    }   



    function getListJson()

    {

        //Data to be Display

        $select = [
            'Report.*',
            'File.Path',
            'File.Size'
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

        $join = [
            "File" => "File.FileId = Report.FileId"
        ];

        $columnSearch = [

            'ReportName',

        ];

        //Execute the statement above here

        $output = array(

            "draw" => $this->input->post('draw'),

            "recordsTotal" => $this->r->count_all(),

            "recordsFiltered" => $this->r->count_filtered($select,$join,$where,null,null,$columnSearch),

            "data" => $this->r->get_datatables($select,$join,$where,null,null,$columnSearch),

            "query" => $this->db->last_query()//for testing

        );

        echo json_encode($output);

    }

    function upload(){
        $file = $this->f->upload(null,$this->input->post('reportname'),50,true);
        $data["success"] = false;
        if (!isset($file["error"])) {
            # code...
            $data["data"] = $file['data'];
            $data["success"] = true;
        }
        echo json_encode($data);
    }

}
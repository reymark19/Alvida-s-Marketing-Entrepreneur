<?php



defined('BASEPATH') OR exit('No direct script access allowed');



Class SelectList extends CI_Controller

{

    function __construct()
    {
        parent:: __construct();
        $this->load->model('Models', 'mod');
    }



    function Actions($name = null) {
        $this->db->select('ActionName as label, ActionId as key');
        $this->db->from('Action');
        $this->db->where('(ActionName like "%'.$name.'%")');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            echo json_encode($query->result());
        }
        else{
            echo json_encode(false);
        }
    }
    function Menus($name = null) {
        $this->db->select('MenuName as label, MenuId as key');
        $this->db->from('Menu');
        $this->db->where('(MenuName like "%'.$name.'%")');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            echo json_encode($query->result());
        }
        else{
            echo json_encode(false);
        }
    }
    function MissionCategories($name = null) {
        $this->db->select('MissionCategoryName as label, MissionCategoryId as key');
        $this->db->from('MissionCategory');
        $this->db->where('(MissionCategoryName like "%'.$name.'%")');

        $query = $this->db->get();

        if($query->num_rows() > 0){
            echo json_encode($query->result());
        }
        else{
            echo json_encode(false);
        }
    }


}
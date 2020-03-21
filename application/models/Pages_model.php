<?php

class Pages_model extends CI_Model{

    public function get(){
       
       $this->db->select('*');
       $this->db->from('pages');
       return $this->db->get()->result_array();
    }

    public function get_template($type){
        $this->db->select('template');
        $this->db->from('pages');
        $this->db->where('type', $type);
        return $this->db->get()->row_array()['template'];
    }
  
}
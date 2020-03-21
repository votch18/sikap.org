<?php

class Settings_model extends CI_Model{

    public function get(){
       
       $this->db->select('*');
       $this->db->from('settings');
       $this->db->limit(1);
       return $this->db->get()->row_array();
    }
  
}
<?php

class Pages_model extends CI_Model{

    public function get(){
       
       $this->db->select('pages.*');
       $this->db->from('pages');       
       $this->db->where('isactive', 1);  
       $this->db->order_by('sequence', 'ASC');
       return $this->db->get()->result_array();
    }

    public function get_template($url){
        $this->db->select('template');
        $this->db->from('pages');
        $this->db->where('url', $url);
        $type = $this->db->get()->row_array();
        return empty($type) ? '' : $type['template'];
    }
    
    public function get_type_by_url($url){
       
        $this->db->select('type');
        $this->db->from('pages');       
        $this->db->where('url', $url);  
        $this->db->limit(1);

        $type = $this->db->get()->row_array();

        //get posts type for slider
        if ( empty($type) ) {
            $this->db->select('lid');
            $this->db->from('posts_type');       
            $this->db->where('url', $url);  
            $this->db->limit(1);

            $type = $this->db->get()->row_array();
            return empty($type) ? null : $type['lid'];
        }
        
        return  $type['type'];
     }
  
}
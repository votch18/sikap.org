<?php

class Pages_model extends CI_Model{

    public function set_page($userid){

        $this->load->helper('url');
    
        $id = $this->input->post('id');

        $url = url_title($this->input->post('name'), 'dash', TRUE);

        $template = $this->input->post('template');
        //create new template
        if ($this->input->post('template') == 0){
            $template = $url.'.php';

            $this->load->model('thememodel');
            $theme = $this->thememodel->get()[0];

            //create the file
            $handle = fopen($theme['path'].$template, 'w');
            //write some data here
            fclose($handle);
        }
     
        $data = array(            
            'name' => $this->input->post('name'),
            'url' => $url,
            'template' => $template,        
            'banner' => $this->input->post('banner'),       
            'status' => $this->input->post('status'),     
            'userid' => $userid,     
            'isactive' => 1     
        );

        if ($this->validateid($id)){

            $this->db->where('id', $id);
            return $this->db->update('pages', $data) ? "success" : "An error occured while saving your page!";
           
        }

        //check title if empty
        if ( empty($this->input->post('name')  ) ) return "Please provide a valid name!";

        //check for duplicate
        if ($this->validate($url) > 0) return "This page already exists!";

           
        return $this->db->insert('pages', $data) ? "success" : "An error occured while saving your page!";
    }

    public function get(){
       
       $this->db->select('pages.*');
       $this->db->from('pages');       
       $this->db->where('isactive', 1);  
       $this->db->where('status', 1); 
       $this->db->order_by('sequence', 'ASC');
       return $this->db->get()->result_array();
    }

    public function get_all(){
       
        $this->db->select('pages.*');
        $this->db->from('pages');     
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

    public function get_banner_by_url($url){
       
        $this->db->select('banner');
        $this->db->from('pages');       
        $this->db->where('url', $url);  
        $this->db->limit(1);

        return  $this->db->get()->row_array()['banner'];
    }

    public function get_by_id($id){
       
        $this->db->select('*');
        $this->db->from('pages');       
        $this->db->where('id', $id);  
        $this->db->limit(1);

        return $this->db->get()->row_array();

     }


    public function validate($url){
        $query = $this->db->get_where('pages', array('url' => $url));
        return $query->num_rows();
    }

    public function validateid($id){
        $query = $this->db->get_where('pages', array('id' => $id));
        return $query->num_rows();
    }

    public function delete(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        return ($this->db->delete('pages')) ? "success" : "An error occured while deleting your record.";

        
    }
  
}
<?php

class Settings_model extends CI_Model{

    public function get(){
       
        $this->db->select('settings.*');
        $this->db->from('settings');
        $data = $this->db->get()->result_array();

        $settings = array();
        foreach($data as $row){
            $settings[$row['key_word']] = $row['value'];
        }
        return $settings;
    }

    
    public function get_all(){
       
        $this->db->select('settings.*');
        $this->db->from('settings');
       
        return $this->db->get()->result_array();
    }

    public function set_setting($keyword, $value, $id = FALSE){
        
        $data = array(            
            'key_word' => $keyword,
            'value' => $value,           
        );

        if ($id == FALSE){

            $this->db->where('id', $id);
            return $this->db->update('settings', $data) ? "success" : "An error occured while saving your settings!";
           
        }

        return $this->db->insert('settings', $data) ? "success" : "An error occured while saving your settings!";
    }

    //flash messages
    public function set_flash($title, $message, $id = FALSE){
        $data = array(            
            'title' => $title,
            'message' => $message,           
        );

        if ($id == FALSE){

            $this->db->where('id', $id);
            return $this->db->update('flash', $data) ? "success" : "An error occured while saving your message!";
           
        }

        return $this->db->insert('flash', $data) ? "success" : "An error occured while saving your message!";
    }

     
    public function save(){
        $keyword =$this->input->post("keyword");
        $value =  $this->input->post("value");

        $this->db->set('value', $value);
        $this->db->where('key_word', $keyword);
        if ( ! $this->db->update('settings')  ) return "failed";

        return "success";
    }
  
}
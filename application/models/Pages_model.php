<?php

class Pages_model extends CI_Model{

    public function set_page($userid){

        $this->load->helper('url');
    
        $id = $this->input->post('id');
        $url = $this->input->post('url');

        $template = $this->input->post('template');
        //create new template
        if ($this->input->post('template') == "0"){
            $template = $url.'.php';

            $this->load->model('thememodel');
            $theme = $this->thememodel->get()[0];

            //create the file
            $handle = fopen($theme['path'].$template, 'w');
            //write some data here
            fwrite($handle,$this->getBanner()."\n");
            fclose($handle);
        }
     
        $data = array(            
            'name' => $this->input->post('name'),
            'url' => $this->input->post('url'),
            'template' => $template,        
            'banner' => $this->input->post('banner'),       
            'status' => $this->input->post('status'),     
            'userid' => $userid,     
            'isactive' => 1     
        );

        if ($this->validateid($id)){

            $this->db->where('id', $id);
            return $this->db->update('pages', $data) ? "success" : "An error occurred while saving your page!";
           
        }

        //check title if empty
        if ( empty($this->input->post('name')  ) ) return "Please provide a valid name!";

        //check for duplicate
        if ($this->validate($url) > 0) return "This page already exists!";

           
        return $this->db->insert('pages', $data) ? "success" : "An error occurred while saving your page!";
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

    public function get_program_category(){
        $this->db->select('*');
        $this->db->from('programs_category');
        return $this->db->get()->result_array();
    }

    public function get_banner_by_url($url){
       
        $this->db->select('banner');
        $this->db->from('pages');       
        $this->db->where('url', $url);  
        $this->db->limit(1);

        return  $this->db->get()->row_array()['banner'];
    }

    public function get_title_by_url($url){

        $this->db->select('name');
        $this->db->from('pages');
        $this->db->where('url', $url);
        $this->db->limit(1);

        $page = $this->db->get()->row_array();
        return  $page['name'];
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
        return ($this->db->delete('pages')) ? "success" : "An error occurred while deleting your record.";
    }

    public function getBanner(){
        $this->db->select('html');
        $this->db->from('templates');
        $this->db->where('name', 'banner');
        $this->db->limit(1);

        return $this->db->get()->row_array()["html"];
    }

    public function add_view($ip_address, $browser, $type, $slug = ""){
        $data = array(
            'ip_address' => $ip_address,
            'browser' => $browser,
            'type' => $type,
            'slug' => $slug,
        );

        return $this->db->insert('views', $data) ? "success" : "An error occurred while saving your page!";
    }

    public function get_views(){
        $this->db->select('DATE_FORMAT(date, "%M %d %Y") as date');
        $this->db->select('ip_address');
        $this->db->select('browser');
        $this->db->from('views');
        $this->db->group_by('ip_address');
        $this->db->group_by('browser');
        $this->db->group_by('DATE_FORMAT(date, "%M %d %Y")');
        return $this->db->get()->result_array();
    }

    public function get_daily_views(){
        $month = empty($this->input->post('month')) ? date('F')." ".date('Y') : $this->input->post('month');
        $query = $this->db->query('select 
                                a.date as period, 
                                count(*) as views 
                                from 
                                (SELECT DATE_FORMAT(date, "%M %d") as date, ip_address, browser FROM t_views WHERE DATE_FORMAT(date, "%M %Y") = ?  GROUP BY DATE_FORMAT(date, "%M-%d-%Y"), ip_address, browser) a
                                group by a.date', array($month));
        return $query->result_array();
    }

    public function get_monthly_views(){
        $year = empty($this->input->post('year')) ? date('Y') : $this->input->post('year');
        $query = $this->db->query('select a.month as period, 
                                count(*) as views 
                                from 
                                (SELECT date, DATE_FORMAT(date, "%M %Y") as month, ip_address, browser FROM t_views WHERE year(date) = ? GROUP BY DATE_FORMAT(date, "%M-%d-%Y"), ip_address, browser) a 
                                group by a.month', array($year));
        return $query->result_array();
    }
  
}
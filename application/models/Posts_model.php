<?php

class Posts_model extends CI_Model{

    public function set_post($userid){

        $this->load->helper('url');
    
        $postid = $this->input->post('postid');

        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $type = $this->input->post('type');   

        //check title if empty
        //if ( empty($this->input->post('title')  ) ) return "Please provide a valid title!";

        //check for duplicate
        //if ($this->validate($slug, $type) > 0) return "This post already exists!";

        $data = array(            
            'postid' => $this->input->post('postid'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'post' => $this->input->post('post'),        
            'photo' => $this->input->post('image'),
            'program_category' => $this->input->post('category'),
            'type' => $type,
            'userid' => $userid,     
            'slug' => $slug      
        );

        if ($this->validateid($postid)){

            $this->db->where('postid', $postid);
            return $this->db->update('posts', $data) ? "success" : "An error occured while saving your post!";
           
        }

        return $this->db->insert('posts', $data) ? "success" : "An error occured while saving your post!";
    }



    public function get_posts($type, $slug = FALSE){     

        if ($slug === FALSE)
        {
            $sql = "SELECT 
                a.id,
                a.postid,
                a.title,
                a.description,
                a.post,
                a.slug,
                a.date,
                a.photo as featured_img, 
                a.status,
                b.id as userid,
                b.username,
                b.photo,              
                CONCAT(b.fname, ' ', b.lname) as name,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
                FROM t_posts a
                INNER JOIN t_users b ON a.userid = b.id
                WHERE a.isactive = 1 AND a.type = ?
                ORDER BY a.date DESC
            ";
            
            $query = $this->db->query($sql, array($type));    
            return $query->result_array();
        }

        $sql = "SELECT 
            a.id,
                a.id,
                a.postid,
                a.title,
                a.description,
                a.post,
                a.slug,
                a.date,
                a.photo as featured_img, 
                a.status,
                b.id as userid,
                b.username,
                b.photo,              
                CONCAT(b.fname, ' ', b.lname) as name,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
                FROM t_posts a
                INNER JOIN t_users b ON a.userid = b.id
                WHERE a.isactive = 1 AND a.type = ? AND a.slug = ?
        ";

        $query = $this->db->query($sql, array($type, $slug));      
        return $query->row_array();
    }

    public function get_published_post($type){
        $sql = "SELECT 
            a.id,
            a.postid,
            a.title,
            a.description,
            a.post,
            a.slug,
            a.date,
            a.photo as featured_img, 
            a.status,
            b.id as userid,
            b.username,
            b.photo,              
            CONCAT(b.fname, ' ', b.lname) as name,
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
            FROM t_posts a
            INNER JOIN t_users b ON a.userid = b.id
            WHERE a.isactive = 1 AND a.status = 1 AND a.type = ?
            ORDER BY a.date DESC
        ";
        
        $query = $this->db->query($sql, array($type));    
        return $query->result_array();
    }


    public function get_published_programs($category){
        $sql = "SELECT 
            a.id,
            a.postid,
            a.title,
            a.description,
            a.post,
            a.slug,
            a.date,
            a.photo as featured_img, 
            a.status,
            b.id as userid,
            b.username,
            b.photo,              
            CONCAT(b.fname, ' ', b.lname) as name,
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
            FROM t_posts a
            INNER JOIN t_users b ON a.userid = b.id
            INNER JOIN t_programs_category c ON a.program_category = c.id
            WHERE a.isactive = 1 AND a.status = 1 AND a.type = 5 AND c.url = ?
            ORDER BY a.date DESC
        ";

        $query = $this->db->query($sql, array($category));
        return $query->result_array();
    }

    public function get_featured(){
        $sql = "SELECT 
            a.id,
                a.id,
                a.postid,
                a.title,
                a.description,
                a.post,
                a.slug,
                a.date,
                a.photo as featured_img, 
                a.status,
                b.id as userid,
                b.username,
                b.photo,              
                CONCAT(b.fname, ' ', b.lname) as name,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
                FROM t_posts a
                INNER JOIN t_users b ON a.userid = b.id
                WHERE a.isactive = 1 AND a.is_featured = 1
        ";

        $query = $this->db->query($sql);      
        return $query->row_array();
    }

    public function set_featured($postid){
        $this->db->set('is_featured', 0);
        $this->db->update('posts');

        $this->db->set('is_featured', 1);
        $this->db->where('postid', $postid);
        $this->db->update('posts');

        return true;
    }

    public function get_posts_by_id($id){
        $sql = "SELECT 
                a.*
                FROM t_posts a               
                WHERE a.postid = ? 
        ";

        $query = $this->db->query($sql, array($id));      
        return $query->row_array();
    }

    public function publish(){

        $postid = $this->input->post('postid');
        $status = $this->input->post('status') == 1 ? 1 : 0;

        $sql = "UPDATE `t_posts` SET `status` = ? WHERE `postid` = ?";
        $this->db->query($sql, array($status, $postid));

        return "success";
    }

    public function validate($slug, $type){
        $query = $this->db->get_where('posts', array('slug' => $slug, 'type' => $type));
        return $query->num_rows();
    }

    public function validateid($postid){
        $query = $this->db->get_where('posts', array('postid' => $postid));
        return $query->num_rows();
    }

    public function upload(){
        if(isset($_FILES["cropImage"])){
            // Define a name for the file
            $filename = md5(uniqid(rand(), true)).'.png';
            // In this case the current directory of the PHP script
            $directory = './filemanager/'. $filename;

            // Move the file to your server
            if (!move_uploaded_file($_FILES["cropImage"]["tmp_name"], $directory)) {
                return false;
            }
            else{
                return true;
            }
        }
    }


    public function delete($postid){
        $data = array(
            'isactive' => 0,         
        );
        
        $this->db->where('postid', $postid);
        $this->db->update('posts', $data);

        return true;
    }

}
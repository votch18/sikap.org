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

    public function get_posts_by_id($id){
        $sql = "SELECT 
                *
                FROM t_posts a               
                WHERE a.postid = ? 
        ";

        $query = $this->db->query($sql, array($id));      
        return $query->row_array();
    }

    public function publish(){

        $postid = $this->input->post('postid');
        $status = $this->input->post('status') == 1 ? 1 : 0;

        $data = array(
            'status' => $status,         
        );
        
        $this->db->where('postid', $postid);
        $this->db->update('posts', $data);

        return "success";
    }

    public function search_posts($q){

        //escape string for sql injection
        $q = $this->db->escape_str("%".$q."%");

        $sql = "SELECT 
                a.id as postid,
                a.title,            
                a.post,
                a.slug,
                a.date,
                b.id as userid,
                b.username,
                d.photo,
                IFNULL(e.vote, 0) as vote,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
                IFNULL(c.comments, 0) as comments
                FROM t_posts a
                INNER JOIN t_users b ON a.userid = b.id
                LEFT JOIN (SELECT x.postid, COUNT(x.id) as comments FROM t_comments x GROUP BY x.postid) as c ON a.id = c.postid
                LEFT JOIN t_avatar d ON d.userid = b.id
                LEFT JOIN (SELECT z.userid, z.primary_id, 
                            SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) as upvote,
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END) as downvote,
                            (SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) -
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END))  as vote
                            FROM t_votes z WHERE z.type = 1 GROUP BY z.primary_id, z.userid) as e ON e.primary_id = a.id
                WHERE a.title LIKE ?
        ";
        
        $query = $this->db->query($sql, array($q));    
        return $query->result_array();
    }

    public function validate($slug, $type){
        $query = $this->db->get_where('posts', array('slug' => $slug, 'type' => $type));
        return $query->num_rows();
    }

    public function validateid($postid){
        $query = $this->db->get_where('posts', array('postid' => $postid));
        return $query->num_rows();
    }



    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('posts');

        $this->db->where('postid', $id);
        $this->db->delete('comments');

        return true;
    }

}
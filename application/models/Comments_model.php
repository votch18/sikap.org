<?php

class Comments_model extends CI_Model{

    public function set_comment(){            
        $postid = $this->input->post('postid');
        $userid = $this->input->post('userid');
        $filename = $postid.'_'.$this->input->post('filename');
        $link = $this->input->post('link');
        $photo = $this->input->post('image_file');

        $data = array(
            'postid' => $postid,
            'userid' => $userid,     
            'filename' => $filename,
            'link' => $link,
            'photo' => $photo,
        );

        return $this->db->insert('comments', $data);
    }

    public function set_comment_reply(){    
        
        $postid = $this->input->post('postid');
        $userid = $this->input->post('userid');
        $commentid = $this->input->post('commentid');
        $filename = $postid.'_'.$this->input->post('filename');

        $data = array(
            'commentid' => $commentid,
            'postid' => $postid,
            'userid' => $userid,     
            'filename' => $filename      
        );

        return $this->db->insert('reply', $data);
    }

    public function get_comments($slug = FALSE){     

        if ($slug == FALSE){
            $sql = "SELECT 
                a.id,
                a.filename,
                a.date,
                b.id as userid,
                b.username,
                d.photo,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
                e.upvote,
                e.downvote,
                e.vote
                FROM t_comments a
                INNER JOIN t_users b ON a.userid = b.id
                INNER JOIN t_posts c ON a.postid = c.id
                LEFT JOIN t_avatar d ON d.userid = b.id
                LEFT JOIN (SELECT z.userid, z.primary_id, 
                            SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) as upvote,
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END) as downvote,
                            (SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) -
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END))  as vote
                            FROM t_votes z WHERE z.type = 2 GROUP BY z.primary_id, z.userid) as e ON e.primary_id = a.id
            ";
                
            $query = $this->db->query($sql, array($slug));    
            return $query->result_array();
        }

        $sql = "SELECT 
            a.id,
            a.filename,
            a.date,
            b.id as userid,
            b.username,
            d.photo,
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
            (SELECT COUNT(x.id) FROM t_reply x WHERE x.commentid = a.id) as replies,
            IFNULL(e.upvote, 0) as upvote,
            IFNULL(e.downvote, 0) as downvote,
            IFNULL(e.vote, 0) as vote,
            a.link,
            a.photo as link_photo
            FROM t_comments a
            INNER JOIN t_users b ON a.userid = b.id
            INNER JOIN t_posts c ON a.postid = c.id
            LEFT JOIN t_avatar d ON d.userid = b.id            
            LEFT JOIN (SELECT z.userid, z.primary_id, 
                            SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) as upvote,
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END) as downvote,
                            (SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) -
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END))  as vote
                            FROM t_votes z WHERE z.type = 2 GROUP BY z.primary_id, z.userid) as e ON e.primary_id = a.id
            WHERE c.slug = ?
            ORDER BY CASE WHEN vote >= 0 THEN 1 ELSE 2 END, ABS(vote), a.date DESC
        ";
            
        $query = $this->db->query($sql, array($slug));    
        return $query->result_array();
    }

    public function get_comments_by_userid($userid){
        $sql = "SELECT 
            a.id,
            a.filename,
            a.date,
            b.id as userid,
            b.username,
            c.title,
            c.slug,
            d.photo,
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds
            FROM t_comments a
            INNER JOIN t_users b ON a.userid = b.id
            INNER JOIN t_posts c ON a.postid = c.id
            LEFT JOIN t_avatar d ON d.userid = b.id
            WHERE a.userid = ?
        ";
            
        $query = $this->db->query($sql, array($userid));    
        return $query->result_array();
    }

    public function get_comment_by_id($commentid){
        $sql = "SELECT 
            a.id,
            a.filename,
            a.date,
            b.id as userid,
            b.username,
            d.photo,
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
            (SELECT COUNT(x.id) FROM t_reply x WHERE x.commentid = a.id) as replies,
            IFNULL(e.upvote, 0) as upvote,
            IFNULL(e.downvote, 0) as downvote,
            IFNULL(e.vote, 0) as vote
            FROM t_comments a
            INNER JOIN t_users b ON a.userid = b.id
            INNER JOIN t_posts c ON a.postid = c.id
            LEFT JOIN t_avatar d ON d.userid = b.id            
            LEFT JOIN (SELECT z.userid, z.primary_id, 
                            SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) as upvote,
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END) as downvote,
                            (SUM(CASE WHEN z.vote = 1 THEN 1 ELSE 0 END) -
                            SUM(CASE WHEN z.vote = 2 THEN 1 ELSE 0 END))  as vote
                            FROM t_votes z WHERE z.type = 2 GROUP BY z.primary_id, z.userid) as e ON e.primary_id = a.id
            WHERE a.id = ?
            ORDER BY a.date DESC
        ";
            
        $query = $this->db->query($sql, array($commentid));    
        return $query->row_array();
    }

    public function get_replies(){

        $commentid = empty($this->input->post('commentid')) ? FALSE : $this->input->post('commentid');

        if ($commentid == FALSE){
            $sql = "SELECT 
                e.id,
                e.filename,
                e.date,
                b.id as userid,
                b.username,
                d.photo,
                TIME_TO_SEC(TIMEDIFF(NOW(), e.date)) as seconds
                FROM t_reply e
                INNER JOIN t_comments a ON a.id = e.commentid
                INNER JOIN t_users b ON e.userid = b.id
                INNER JOIN t_posts c ON a.postid = c.id
                LEFT JOIN t_avatar d ON d.userid = b.id
            ";
                
            $query = $this->db->query($sql);    
            return $query->result_array();
        }

        $sql = "SELECT 
            e.id,
            e.filename,
            e.date,
            b.id as userid,
            b.username,
            d.photo,
            TIME_TO_SEC(TIMEDIFF(NOW(), e.date)) as seconds
            FROM t_reply e
            INNER JOIN t_comments a ON a.id = e.commentid
            INNER JOIN t_users b ON e.userid = b.id
            INNER JOIN t_posts c ON a.postid = c.id
            LEFT JOIN t_avatar d ON d.userid = b.id     
            WHERE e.commentid = ?
            ORDER BY e.date ASC
        ";
            
        $query = $this->db->query($sql, array($commentid));    
        return $query->result_array();
    }

    public function upload(){
        if(isset($_FILES["audio"])){
            // Define a name for the file
            $filename = $this->input->post('postid').'_'.$this->input->post('filename');
            // In this case the current directory of the PHP script
            $directory = './uploads/audio/'. $filename;
            
            // Move the file to your server
            if (!move_uploaded_file($_FILES["audio"]["tmp_name"], $directory)) {
                return false;
            }
            else{
                return true;
            }
        }
    }

    public function upload_image(){
        if(isset($_FILES["file"])){
            // Define a name for the file           
            $extn = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $filename = uniqid().'.'.$extn;
            
            // In this case the current directory of the PHP script
            $directory = './uploads/images/comments/'. $filename;
            
            // Move the file to your server
            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
                return false;
            }else{               
                return $filename;
            }
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('comments');
    }

    public function delete_reply($id){
        $this->db->where('id', $id);
        $this->db->delete('reply');
    }

}
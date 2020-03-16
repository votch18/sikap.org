<?php

class Logs_model extends CI_Model{

    public function set_log($message, $userid){

        $data = array(
            'message' => $message,
            'userid' => $userid
        );

        return $this->db->insert('logs', $data);
    }

    public function get_logs($userid = FALSE){     

        if ($userid === FALSE)
        {
            $sql = "SELECT 
                    id, 
                    message,
                    userid,
                    date       
                    FROM t_logs a
                ";

            $query = $this->db->query($sql, array($userid));      
            return $query->result_array();
        }

        $sql = "SELECT 
                id, 
                message,
                userid,
                date       
                FROM t_logs a          
                WHERE a.userid = ?
            ";

        $query = $this->db->query($sql, array($userid));      
        return $query->result_array();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('posts');

        return true;
    }

}
<?php

class Messages_model extends CI_Model{

    public function send_message(){
        
        $message = $this->input->post('message');
        $sender = $this->input->post('sender');
        $receiver = $this->input->post('receiver');

        $data = array(
            'message' => $message,
            'sender' =>  $sender,
            'receiver' =>  $receiver,
        );
        
        return ( $this->db->insert('messages', $data) );

    }

    public function get_conversation(){
        $sender = $this->input->post('sender');
        $receiver = $this->input->post('receiver');

        $sql ="SELECT 
            a.id,
            a.message,
            a.date,            
            TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
            a.receiver,
            a.sender,
            CONCAT(b.fname, ' ', b.lname) as receiver_name,            
            CONCAT(d.fname, ' ', d.lname) as sender_name,
            c.photo as receiver_photo,
            e.photo as sender_photo
            FROM t_messages a
            INNER JOIN t_users b ON b.id = a.receiver
            LEFT JOIN t_avatar c ON c.userid = a.receiver
            INNER JOIN t_users d ON d.id = a.sender
            LEFT JOIN t_avatar e ON e.userid = a.sender
            WHERE a.sender in ($sender, $receiver) AND a.receiver in ($sender, $receiver)
            GROUP BY a.id
            ORDER BY a.date ASC";

        $query = $this->db->query($sql);    
        return $query->result_array();
    }

    public function get_message_thread($id){
        
        $sql = "SELECT 
                a.id,
                b.id as userid,
                b.fname,
                b.lname,
                d.photo,
                (c.total) as message_count,
                a.receiver,
                a.sender,
                (SELECT CONCAT(x.fname, ' ', x.lname) FROM t_users x WHERE x.id = a.sender) as sender_name,
                a.date,
                a.message,
                (CASE WHEN a.sender = $id THEN a.receiver ELSE a.sender END) as threadid
                FROM t_messages a
                INNER JOIN (SELECT MAX(x.id) as id, (CASE WHEN x.sender = $id THEN x.receiver ELSE x.sender END) as threadid, count(*) as total FROM t_messages x WHERE x.receiver = $id OR x.sender = $id GROUP BY threadid) c on c.id = a.id
                RIGHT JOIN t_users b ON b.id = (CASE WHEN a.sender = $id THEN a.receiver ELSE a.sender END)
                LEFT JOIN t_avatar d ON d.userid = b.id
                WHERE a.receiver = $id OR a.sender = $id 
                GROUP BY threadid
                ORDER BY a.date DESC";

        $query = $this->db->query($sql);    
        return $query->result_array();

    }

    public function get_unread_messages($id){
        $sql = "SELECT 
                a.id,
                a.message,
                a.sender,
                a.date,
                TIME_TO_SEC(TIMEDIFF(NOW(), a.date)) as seconds,
                CONCAT(b.fname, ' ', b.lname) as sender_name,
                c.photo
                FROM t_messages a
                INNER JOIN t_users b ON a.sender = b.id
                LEFT JOIN t_avatar c ON b.id = c.userid
                WHERE a.receiver = $id AND a.is_read = 0
                ORDER BY a.date DESC";

        $query = $this->db->query($sql);    
        return $query->result_array();
    }

    public function set_message_isread(){
        
        $receiver = $this->input->post('sender');

        $data = array(
            'is_read' => 1
        );

        $this->db->where('receiver', $receiver);
        $this->db->update('messages', $data);

        return true;
    }
}
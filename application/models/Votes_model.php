<?php

class Votes_model extends CI_Model{

    public function set_vote($userid){
     
        $postid =  $this->input->post('postid');
        $type = empty($this->input->post('type')) ? 1 : $this->input->post('type');

        $data = array(
            'primary_id' => $postid,
            'vote' => $this->input->post('vote'),
            'userid' => $userid,
            'type' => $type 
        );

        if ($this->validate($userid, $postid) > 0){
            return $this->db->update('votes', $data, array('primary_id' => $postid, 'userid' => $userid)) ? "success" : "An error occured while saving your post!";
        }

        return $this->db->insert('votes', $data) ? "success" : "An error occured while saving your post!";
    }

    public function validate($userid, $postid){
        $query = $this->db->get_where('votes', array('primary_id' => $postid, 'userid' => $userid));
        return $query->num_rows();
    }

}
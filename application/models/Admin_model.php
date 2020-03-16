<?php

class Admin_model extends CI_Model{

    public function set_admin(){
       
        $this->load->library('util');
        $salt = $this->util->generate_random_code();

        $data = array(
            'username' => 'utalking2',
            'email' => 'admin@utalking2.me',
            'password' =>  md5('Erinbee3!'.$salt),
            'salt' => $salt,
            'lname' =>  'System',
            'fname' =>  'Admin',
            'is_active' => '1'
        );
        
        return ( $this->db->insert('users', $data) );

    }

    public function login_admin(){

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) return;

        $salt = $this->get_salt($username);

        $query = $this->db->get_where('users', array('username' => $username, 'password' => md5($password.$salt)));
        return $query->row_array();

    }

    public function get_admin($username = FALSE){       
        if ($username === FALSE)
        {
                $query = $this->db->get('users');
                return $query->result_array();
        }

        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }

    public function get_admin_by_id(){
        $id = $this->input->post('id');
        
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function get_salt($username){
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array()["salt"];
    }

    public function validate($key, $value){
        $query = $this->db->get_where('users', array($key => $value));
        return $query->num_rows();
    }

    public function update_info(){
      
        $id = $this->input->post('id');

        $data = array(         
            'email' => $this->input->post('email'),
            'lname' =>  $this->input->post('lname'),
            'fname' =>  $this->input->post('fname')
        );
    
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return "success";
    }


    public function change_password(){
        $id = $this->input->post('id');

        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm_password');

        $salt = $this->util->generate_random_code();

        if ($password != $confirm) return "Password does not match!";

        $data = array(
            'password' => md5($password.$salt),
            'salt' => $salt
        );
        
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return "success";
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');

        return true;
    }

    public function upload(){
        if(isset($_FILES["file"])){
            // Define a name for the file
            $id = $this->input->post('id');
            $extn = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $filename = $id .'.'.$extn;
            
            // In this case the current directory of the PHP script
            $directory = './uploads/admin/'. $filename;
            
            // Move the file to your server
            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
                return false;
            }else{

                $data = array (
                    'id' => $id,
                    'photo' => $filename
                );

                $this->db->where('id', $id);
                $this->db->update('users', $data);
                return true;
            }
        }
    }
    

}
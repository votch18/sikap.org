<?php

class Users_model extends CI_Model{

    public function set_user(){
       
        //validate password
        if ($this->input->post('password') != $this->input->post('confirm_password')) return "Password does not matched!";

        //validate username
        if ( $this->validate('username', $this->input->post('username')) > 0) return "Username is already taken!";

        //validate email
        if ( $this->validate('email', $this->input->post('email')) > 0 ) return "Email address is already taken!";

        $this->load->library('util');
        $salt = $this->util->generate_random_code();

        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' =>  md5($this->input->post('password').$salt),
            'salt' => $salt,
            'role' =>  1,
            'lname' =>  $this->input->post('lname'),
            'fname' =>  $this->input->post('fname'),
            'is_active' => '1'
        );
        
        return ( $this->db->insert('users', $data) ) ? "success" : "An error occured while saving your data!";

    }

    public function update_users(){
      
        $id = $this->input->post('id');

        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'role' =>  $this->input->post('role'),
            'lname' =>  $this->input->post('lname'),
            'fname' =>  $this->input->post('fname'),
            'is_active' => '1'
        );
    
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return true;
    }

    public function update_info(){
      
        $id = $this->input->post('id');

        $data = array(
            'bio' => $this->input->post('bio'),
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


    public function login_user($username = FALSE, $password = FALSE){

        $username = ($username != FALSE) ? $username :  $this->input->post('username');
        $password = ($password != FALSE) ? $password :  $this->input->post('password');

        if (empty($username) || empty($password)) return "failed";

        $salt = $this->get_salt($username);

        $sql = "SELECT 
                a.*,
                b.photo
                FROM t_users a
                LEFT JOIN t_avatar b ON a.id = b.userid
                WHERE a.username = ? AND a.password = ?
                LIMIT 1
            ";

        $query = $this->db->query($sql, array($username, md5($password.$salt)));
        return $query->row_array();
    }

    public function get_users($username = FALSE){       
        if ($username === FALSE)
        {
            $sql = "SELECT 
                a.*,
                b.photo,
                c.description as role_desc
                FROM t_users a
                LEFT JOIN t_avatar b ON a.id = b.userid
                LEFT JOIN t_roles c ON a.role = c.id
                WHERE a.username = ?
            ";

            $query = $this->db->query($sql, array($username));
            return $query->result_array();
        }

        $sql = "SELECT 
                a.*,
                b.photo,
                c.description as role_desc
                FROM t_users a
                LEFT JOIN t_avatar b ON a.id = b.userid
                LEFT JOIN t_roles c ON a.role = c.id
                WHERE a.username = ?
                LIMIT 1
            ";
  
        $query = $this->db->query($sql, array($username));
        return $query->row_array();
    }

    public function get_salt($username){
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array()["salt"];
    }

    public function get_user_by_id(){
        
        $id = $this->input->post('id');

        $sql = "SELECT 
                a.*,
                b.photo
                FROM t_users a
                LEFT JOIN t_avatar b ON a.id = b.userid
                WHERE a.id = ?
                LIMIT 1
            ";
  
        $query = $this->db->query($sql, array($id));
        return $query->row_array();
    }

    public function validate($key, $value){
        $query = $this->db->get_where('users', array($key => $value));
        return $query->num_rows();
    }

    public function check_photo($userid){
        $query = $this->db->get_where('avatar', array('userid' => $userid));
        return $query->num_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');

        redirect('users');
    }

    public function upload(){
        if(isset($_FILES["file"])){
            // Define a name for the file
            $id = $this->input->post('id');
            $extn = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            $filename = $id .'.'.$extn;
            
            // In this case the current directory of the PHP script
            $directory = './uploads/users/'. $filename;
            
            // Move the file to your server
            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $directory)) {
                return false;
            }else{

                $data = array (
                    'userid' => $id,
                    'photo' => $filename
                );

                //resize image
                $config['image_library'] = 'gd2';
                $config['source_image'] = $directory;
                $config['create_thumb'] = false;
                $config['maintain_ration'] = true;
                $config['quality'] = '70%';
                $config['width'] = 200;
                $config['new_image'] = $directory;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                if ($this->check_photo($id) > 0){
                    $this->db->where('userid', $id);
                    $this->db->update('avatar', $data);
                    return true;
                }

                $this->db->insert('avatar', $data);
                return true;
            }
        }
    }
}
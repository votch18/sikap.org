<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
        $this->load->model('users_model');
        $this->load->model('posts_model');
        $this->load->model('comments_model');
	}

    public function add_user(){

        if ( !empty( $this->input->post('id') ) ){
            $data['user'] =  $this->users_model->get_user_by_id();
            $data["roles"] = $this->users_model->get_roles(); 
    
            $this->load->view('modal/edit_user', $data);
        }else{
            $data['user'] =  $this->users_model->get_user_by_id();
            $data["roles"] = $this->users_model->get_roles(); 
    
            $this->load->view('modal/add_user', $data);
        }
        
    }

    public function save_user(){

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->users_model->set_user()) );
        exit;	
    }

    public function do_upload()
	{				
        $this->auth->is_logged_in();	
        if ($this->users_model->upload()){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
    }
  
	public function logout(){

		$this->session->unset_userdata('login', null);
		redirect(base_url());

	}

	public function delete()
	{		
        
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->users_model->delete() ) );
        exit;	
	}

	public function change_password()
	{
		$this->auth->is_logged_in();
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->users_model->change_password() ) );
        exit;
    }	

}
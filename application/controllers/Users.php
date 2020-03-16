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

	public function profile($username = FALSE)
	{				
        if ($username == FALSE){
            $this->auth->is_logged_in();
        
            $data['user'] =  $this->auth->get_users();            
            $data['posts'] = $this->posts_model->get_posts_by_userid($data['user']['id']);
            $data['comments'] = $this->comments_model->get_comments_by_userid($data['user']['id']);
            $data['user'] = $this->users_model->get_users($data['user']['username']);

            $this->load->view('shared/header', $data);
            $this->load->view('content/user_posts', $data);
            $this->load->view('shared/footer');
        }else{            
            $data['user'] =  $this->auth->get_users();
            $data['viewed_user'] =  $this->users_model->get_users($username);
            $data["related_posts"] = $this->posts_model->get_posts_by_userid($data["viewed_user"]["id"]);
            $data['posts'] = $this->posts_model->get_posts_by_userid($data['viewed_user']['id']);
            $data['comments'] = $this->comments_model->get_comments_by_userid($data['viewed_user']['id']);
            $data['url'] = 'messages';

            $this->load->view('shared/header', $data);
            $this->load->view('content/user_profile', $data);
            $this->load->view('shared/footer');
        }
		
    }

    public function comments()
	{				
		$this->auth->is_logged_in();
        
        $data['user'] =  $this->auth->get_users();
        $data['posts'] = $this->posts_model->get_posts_by_userid($data['user']['id']);
        $data['comments'] = $this->comments_model->get_comments_by_userid($data['user']['id']);
        
		$this->load->view('shared/header', $data);
        $this->load->view('content/user_comments', $data);
        $this->load->view('shared/footer');
    }

    public function activities()
	{				
		$this->auth->is_logged_in();
        
        $data['user'] =  $this->auth->get_users();
        $data['posts'] = $this->posts_model->get_posts_by_userid($data['user']['id']);
        $data['comments'] = $this->comments_model->get_comments_by_userid($data['user']['id']);
        
		$this->load->view('shared/header', $data);
        $this->load->view('content/user_activities', $data);
        $this->load->view('shared/footer');
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
    
       
	public function edit($id = NULL)
	{
		$this->auth->is_logged_in();

		$this->load->library('form_validation');

        $this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('access', 'Role', 'required');
       
        if ($this->form_validation->run() === FALSE)
        {
			$data['users_item'] = $this->users_model->get_users($id);
			$data['user'] =  $this->auth->get_users();
			
			$this->load->view('templates/header', $data);			
			$this->load->view('users/edit', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->users_model->update_users();
            redirect('users');
		}
		
    }	

	public function login()
	{				        
        $data = $this->users_model->login_user();
        if ($data != null){
            $this->session->set_userdata('login', $data);
            
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("data" =>  "success") );
            exit;	

        }

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("data" =>  "failed") );
        exit;	
    }
    
    public function signup()
	{				        
        $data = $this->users_model->set_user();

        if ($data == "success"){
            //login
            $this->login();
        }

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("data" =>  $data) );
        exit;	
	}


	public function logout(){

		$this->session->unset_userdata('login', null);
		redirect(base_url());

	}

	public function delete()
	{		
        $id = $this->input->post('id');

        if ( $this->users_model->delete($id) ){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
        
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "failed") );
        exit;	
	}


    public function update_info(){
        $this->auth->is_logged_in();

        if ( $this->users_model->update_info() == "success" ){
            $data = $this->users_model->get_user_by_id();
            $this->session->set_userdata('login', $data);

            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" => "success" ) );
            exit;	
        }       
    }


	public function change_password()
	{
		$this->auth->is_logged_in();
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->users_model->change_password() ) );
        exit;
    }	

    public function messages(){
        $data['user'] =  $this->auth->get_users();
        $this->load->view('shared/header', $data);
        $this->load->view('content/user_chat', $data);
        $this->load->view('shared/footer');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');        
        $this->load->helper('url_helper');
        $this->load->model('admin_model');
        $this->load->model('posts_model');
        $this->load->model('users_model');
    }
   
	public function index()
	{	
        if ( $this->session->has_userdata('admin') ){
            $data['admin'] = $this->session->userdata('admin');          
            $data["url"] = "dashboard";

            $this->load->view('shared/admin_header', $data);       
            $this->load->view('admin/dashboard', $data);
            $this->load->view('shared/admin_footer');
        }else{
		    $this->load->view('admin/login');
        }
    }

    public function dashboard(){
        $data['admin'] = $this->session->userdata('admin');          
        $data["url"] = "dashboard";

        $this->load->view('shared/admin_header', $data);       
        $this->load->view('admin/dashboard');
        $this->load->view('shared/admin_footer');
    }

    public function posts(){
        $data['admin'] = $this->session->userdata('admin');    
        $url = $this->uri->segment(2);
        $type = $this->posts_model->get_posts_type($url);

        $data['posts'] = $this->posts_model->get_posts($type);
        $data['title'] = $url;
        $data['url'] = $url;
        $data['action'] = $url.'/create';

        $this->load->view('shared/admin_header', $data);  
        if ($url == 'gallery'){
            $this->load->view('admin/gallery', $data);
        }else{
            $this->load->view('admin/posts', $data);
        }
        $this->load->view('shared/admin_footer');
        
    }

    public function create_posts(){   
        $data['admin'] = $this->session->userdata('admin');    
        $url = $this->uri->segment(2);
        $type = $this->posts_model->get_posts_type($url);

        $data['title'] = 'create '.$url;   
        $data['url'] =  $url;      
        $data['type'] = $type;    

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }

    public function edit_posts(){   
        $data['admin'] = $this->session->userdata('admin');    
        $url = $this->uri->segment(2);
        $id = $this->uri->segment(4);
        $type = $this->posts_model->get_posts_type($url);
        
        $data['title'] = 'edit '.$url; ;   
        $data['url'] = $url;       
        $data['type'] = $type;    
        $data['post'] = $this->posts_model->get_posts_by_id($id);  

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }


    public function filemanager(){
        $data['admin'] = $this->session->userdata('admin');    
        
        $this->load->view('shared/admin_header', $data);  
        $this->load->view('filemanager/filemanager');
        $this->load->view('shared/admin_footer');
    }

    
    public function login()
	{				        
        $data = $this->admin_model->login_admin();

        if ( $data == null ){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("action" =>  "failed") );
            exit;	
        }

        $this->session->set_userdata('admin', $data);
            
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("action" =>  "success", "data" => $data) );
        exit;	
       
    }

    public function users(){
        $data['admin'] = $this->session->userdata('admin'); 
        $data['users'] = $this->users_model->get_users(); 
        $data["url"] = "users";

        $this->load->view('shared/admin_header', $data);       
        $this->load->view('admin/users', $data);
        $this->load->view('shared/admin_footer');
    }
  
    public function profile(){
        if ( !$this->session->has_userdata('admin') ) redirect(base_url());

        $data['admin'] = $this->session->userdata('admin'); 

        $this->load->view('shared/admin_header', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('shared/admin_footer');
    }

    public function update_info(){

        if ( $this->admin_model->update_info() == "success" ) {
            $data = $this->admin_model->get_admin_by_id();

            $this->session->set_userdata('admin', $data);

            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success" ) );
            exit;	
        }
       
    }
    
	public function change_password()
	{
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->admin_model->change_password() ) );
        exit;
    }	

    public function do_upload()
	{				
        if ($this->admin_model->upload()){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
    }

    public function logout(){
		$this->session->unset_userdata('admin', null);
		redirect(base_url().'admin');
	}
}
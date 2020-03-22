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
        $this->load->model('settings_model');
        $this->load->model('pages_model');
    }
   
	public function index()
	{	
        $data['settings'] 	= $this->settings_model->get();

        if ( $this->session->has_userdata('admin') ){
            $data['admin'] = $this->session->userdata('admin');          
            $data["url"] = "dashboard";

            $data['news'] 	= $this->posts_model->get_posts(1);
            $data['announcements'] 	= $this->posts_model->get_posts(2);
            $data['publications'] 	= $this->posts_model->get_posts(3);
            $data['awards'] 	= $this->posts_model->get_posts(4);
            $data['programs'] 	= $this->posts_model->get_posts(5);
            $data['gallery'] 	= $this->posts_model->get_posts(6);
            $data['slider'] 	= $this->posts_model->get_posts(7);
            $data['users'] 	= $this->users_model->get_users();

            $this->load->view('shared/admin_header', $data);       
            $this->load->view('admin/dashboard', $data);
            $this->load->view('shared/admin_footer');
        }else{
		    $this->load->view('admin/login');
        }
    }

    public function dashboard(){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');          
        $data["url"] = "dashboard";

        $data['news'] 	= $this->posts_model->get_posts(1);
        $data['announcements'] 	= $this->posts_model->get_posts(2);
        $data['publications'] 	= $this->posts_model->get_posts(3);
        $data['awards'] 	= $this->posts_model->get_posts(4);
        $data['programs'] 	= $this->posts_model->get_posts(5);
        $data['gallery'] 	= $this->posts_model->get_posts(6);
        $data['slider'] 	= $this->posts_model->get_posts(7);
        $data['users'] 	= $this->users_model->get_users();

        $this->load->view('shared/admin_header', $data);       
        $this->load->view('admin/dashboard');
        $this->load->view('shared/admin_footer');
    }

    public function posts($url){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');   
        $type = $this->pages_model->get_type_by_url($url);

        $data['posts'] = $this->posts_model->get_posts($type);

        if (empty($data['posts']) && $type == null) redirect(base_url().'admin');
        
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

    public function create_posts($url){   
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin'); 
        $type = $this->pages_model->get_type_by_url($url);

        $data['title'] = 'create '.$url;   
        $data['url'] =  $url;      
        $data['type'] = $type;    

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }

    public function edit_posts($url, $id){   
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $type = $this->pages_model->get_type_by_url($url);
        
        $data['title'] = 'edit '.$url; ;   
        $data['url'] = $url;       
        $data['type'] = $type;    
        $data['post'] = $this->posts_model->get_posts_by_id($id);  

        if (empty($data['post'])) redirect(base_url().'admin');

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }


    public function filemanager(){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');    
        $data['url'] =  'filemanager';     

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('filemanager/filemanager');
        $this->load->view('shared/admin_footer');
    }

    
    public function pages(){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');    
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'pages';     

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/pages');
        $this->load->view('shared/admin_footer');
    }

    public function pages_create(){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');    
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'pages';     

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/pages');
        $this->load->view('shared/admin_footer');
    }

    public function templates()
	{
		$data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');    
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'templates';   

		$data['connector'] 	= base_url().'filemanager/connector';
        $data['settings'] 	= $this->settings_model->get();

        $excludes = array('.', '..', 'js', 'plugins' );
		$includes = array('.php');
        $data['templates'] 	= $this->theme->templates($excludes, $includes);

		$this->load->view('shared/admin_header', $data);
		$this->load->view('admin/templates', $data);
		$this->load->view('shared/admin_footer');
	}

    public function settings(){
        $data['settings'] 	= $this->settings_model->get();
        $data['data'] 	= $this->settings_model->get_all();
        $data['admin'] = $this->session->userdata('admin');    
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'settings'; 

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/settings');
        $this->load->view('shared/admin_footer');
    }
    
    public function login()
	{				        
        $data['settings'] 	= $this->settings_model->get();
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

    public function users($username = FALSE){
        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin'); 
        $data['users'] = $this->users_model->get_users(); 
        $data["url"] = "users";

        $this->load->view('shared/admin_header', $data);       

        if ($username != FALSE){
            $this->load->view('admin/profile', $data);
        }else{
            $this->load->view('admin/users', $data);
        }
        
        $this->load->view('shared/admin_footer');
    }
  
    public function profile(){
        $data['settings'] 	= $this->settings_model->get();
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
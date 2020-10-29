<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
   
    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');        
        $this->load->helper('url_helper');
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
            $data['accreditation'] 	= $this->posts_model->get_posts(3);
            $data['awards'] 	= $this->posts_model->get_posts(4);
            $data['programs'] 	= $this->posts_model->get_posts(5);
            $data['gallery'] 	= $this->posts_model->get_posts(6);
            $data['slider'] 	= $this->posts_model->get_posts(7);
            $data['users'] 	= $this->users_model->get_users();
            $data['views'] 	= $this->pages_model->get_views();

            $this->load->view('shared/admin_header', $data);       
            $this->load->view('admin/dashboard', $data);
            $this->load->view('shared/admin_footer');
        }else{
		    $this->load->view('admin/login', $data);
        }
    }

    public function dashboard(){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["url"] = "dashboard";

        $data['news'] 	= $this->posts_model->get_posts(1);
        $data['announcements'] 	= $this->posts_model->get_posts(2);
        $data['accreditation'] 	= $this->posts_model->get_posts(3);
        $data['awards'] 	= $this->posts_model->get_posts(4);
        $data['programs'] 	= $this->posts_model->get_posts(5);
        $data['gallery'] 	= $this->posts_model->get_posts(6);
        $data['slider'] 	= $this->posts_model->get_posts(7);
        $data['users'] 	= $this->users_model->get_users();
        $data['views'] 	= $this->pages_model->get_views();

        $this->load->view('shared/admin_header', $data);       
        $this->load->view('admin/dashboard');
        $this->load->view('shared/admin_footer');
    }

    public function posts($url){
        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $type = $this->pages_model->get_type_by_url($url);

        $data['posts'] = $this->posts_model->get_posts($type);

        if (empty($data['posts']) && $type == null) redirect(base_url().'admin');
        
        $data['title'] = $url;
        $data['url'] = $url;
        $data['action'] = $url.'/create';

        if ($url == 'news'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 2);
            $data["delete"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 3);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 4);
        }elseif ($url == 'programs'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 5);
            $data["delete"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 6);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 7);
        }else{
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 8);
            $data["delete"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 9);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 10);
        }

        $this->load->view('shared/admin_header', $data);  
        if ($url == 'gallery'){
            $this->load->view('admin/gallery', $data);
        }else{
            $this->load->view('admin/posts', $data);
        }
        $this->load->view('shared/admin_footer');
        
    }

    public function create_posts($url){   
        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $type = $this->pages_model->get_type_by_url($url);
        $data['categories'] = $this->pages_model->get_program_category();

        $data['title'] = 'create '.$url;   
        $data['url'] =  $url;      
        $data['type'] = $type;

        if ($url == 'news'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 2);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 4);
        }elseif ($url == 'programs'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 5);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 7);
        }else{
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 8);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 10);
        }

        if (!$data["create"]) redirect(base_url().'admin/'.$url);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }

    public function edit_posts($url, $id){   
        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $type = $this->pages_model->get_type_by_url($url);
        $data['categories'] = $this->pages_model->get_program_category();

        $data['title'] = 'edit '.$url; ;   
        $data['url'] = $url;       
        $data['type'] = $type;    
        $data['post'] = $this->posts_model->get_posts_by_id($id);  

        if (empty($data['post'])) redirect(base_url().'admin');

        if ($url == 'news'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 2);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 4);
        }elseif ($url == 'programs'){
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 5);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 7);
        }else{
            $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 8);
            $data["publish"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 10);
        }

        if (!$data["create"]) redirect(base_url().'admin/'.$url);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_posts', $data);
        $this->load->view('shared/admin_footer');
    }


    public function filemanager(){
        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $data['url'] =  'filemanager';

        $data["view"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 20);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('filemanager/filemanager');
        $this->load->view('shared/admin_footer');
    }

    
    public function pages(){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $data['pages'] 	= $this->pages_model->get_all();   
        $data['url'] =  'pages';

        $data["create"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 18);
        $data["delete"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 19);
      
        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/pages');
        $this->load->view('shared/admin_footer');
    }

    public function pages_create(){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $data['url'] =  'pages';     
        $data['title'] = 'create page';  
        $excludes = array('.', '..', 'js', 'plugins', 'footer.php', 'header.php' );
		$includes = array('.php');
        $data['templates'] 	= $this->theme->templates($excludes, $includes);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_page');
        $this->load->view('shared/admin_footer');
    }

    public function pages_edit($id){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');    
        $data['page'] 	= $this->pages_model->get_by_id($id);
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $data['url'] =  'pages';     
        $data['title'] = 'Edit page';  
        $excludes = array('.', '..', 'js', 'plugins', 'footer.php', 'header.php' );
		$includes = array('.php');
        $data['templates'] 	= $this->theme->templates($excludes, $includes);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/new_page');
        $this->load->view('shared/admin_footer');
    }

    public function pages_delete()
	{				
        $this->auth->is_logged_in();	

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->pages_model->delete()) );
        exit;	
    }
    
    public function pages_save()
	{				
        $this->auth->is_logged_in();	

        $userid =  $this->auth->get_users()['id'];

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->pages_model->set_page( $userid )) );
        exit;	
    }

    public function templates()
	{

        $this->auth->is_logged_in();

		$data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data["access"] = $this->users_model->get_access_rights($data['admin']['id']);
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'templates';   

		$data['connector'] 	= base_url().'filemanager/connector';
        $data['settings'] 	= $this->settings_model->get();

        $excludes = array('.', '..', 'js', 'plugins' );
		$includes = array('.php');
        $data['templates'] 	= $this->theme->templates($excludes, $includes);

        $data["view"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 12);

		$this->load->view('shared/admin_header', $data);
		$this->load->view('admin/templates', $data);
		$this->load->view('shared/admin_footer');
    }
    

    public function settings(){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['data'] 	= $this->settings_model->get_all();
        $data['admin'] = $this->session->userdata('admin');
        $data['pages'] 	= $this->pages_model->get();   
        $data['url'] =  'settings';

        $data["view"] = $this->users_model->get_access_rights_by_id($data['admin']['id'], 13);

        $this->load->view('shared/admin_header', $data);  
        $this->load->view('admin/settings');
        $this->load->view('shared/admin_footer');
    }

    public function save_settings()
	{
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->settings_model->save() ) );
        exit;
    }	

    
    public function login()
	{				        
        $data['settings'] 	= $this->settings_model->get();
        $data = $this->users_model->login_user();

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

    public function fblogin()
    {
        $data['settings'] 	= $this->settings_model->get();
        $data = $this->users_model->get_user_by_fbid();

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

    public function fbconnect()
    {
        $data = $this->users_model->fbconnect();

        if ( $data == null ){
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode( array("action" =>  "failed") );
            exit;
        }

        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode( array("action" =>  "success", "data" => $data) );
        exit;

    }

    public function fbpost()
    {
        $data = $this->posts_model->fbpost();

        if ( $data == null ){
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode( array("action" =>  "failed") );
            exit;
        }

        header('Content-Type: application/json; charset=utf-8;');
        echo json_encode( array("action" =>  "success", "data" => $data) );
        exit;

    }

    public function users($username = FALSE){

        $this->auth->is_logged_in();

        $data['settings'] 	= $this->settings_model->get();
        $data['admin'] = $this->session->userdata('admin');
        $data['users'] = $this->users_model->get_users($username); 
        $data["url"] = "users";


        $this->load->view('shared/admin_header', $data);       

        if ($username != FALSE){
            $this->load->view('admin/profile', $data);
        }else{
            if ($data['admin']['id'] != 1) redirect(base_url().'admin/');

            $this->load->view('admin/users', $data);
        }
        
        $this->load->view('shared/admin_footer');
    }
  
    public function update_info(){

        $this->auth->is_logged_in();

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
        $this->auth->is_logged_in();
        
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
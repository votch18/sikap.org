<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');        
        $this->load->library('util');
        $this->load->library('theme');
        $this->load->model('users_model');
        $this->load->model('posts_model');
        $this->load->model('settings_model');
        $this->load->model('pages_model');
    }
    	
    public function index()
	{
        
		$data['title'] 		= 'Home';
        $data['settings'] 	= $this->settings_model->get();
        $data['pages'] 	= $this->pages_model->get();
        $data['url'] =  '';
        
        $data['news'] 	= $this->posts_model->get_published_post(1);
        $data['announcements'] 	= $this->posts_model->get_published_post(2);
        $data['programs'] 	= $this->posts_model->get_published_post(5);
        $data['programs_menu']   = $this->posts_model->get_programs_order_by_category();
        $data['slider'] 	= $this->posts_model->get_published_post(7);

		$data['template'] = 'home.php';

        $this->pages_model->add_view($this->util->getIpAddress(), $this->util->getBrowserName(), 'home', null);

		$this->theme->initialize($data);
    }

    public function posts( $url)
	{
	    $category = $this->input->get('category', TRUE);

        $data['settings'] 	= $this->settings_model->get();
        $data['pages'] 	= $this->pages_model->get();
        $data['url'] =  $url;
        $data['title'] =  $this->pages_model->get_title_by_url($url);

        $data['banner'] = $this->pages_model->get_banner_by_url($url);
        $type = $this->pages_model->get_type_by_url($url);

        if ($url == "programs" && $category != ""){
            $data['posts'] 	= $this->posts_model->get_published_programs($category);
        }else{
            $posts = $this->posts_model->get_published_post($type);
            $data['posts'] 	= $posts;
        }

        $data['news'] 	= $this->posts_model->get_published_post(1);
        $data['announcements'] 	= $this->posts_model->get_published_post(2);
        $data['programs'] 	= $this->posts_model->get_published_post(5);
        $data['programs_menu']   = $this->posts_model->get_programs_order_by_category();
        $data['slider'] 	= $this->posts_model->get_published_post(7);
        $data['category'] = $category;

		$data['template'] 	= $this->pages_model->get_template($url);

        $this->pages_model->add_view($this->util->getIpAddress(), $this->util->getBrowserName(), $url, null);

        $this->theme->initialize($data);
	}
    
    public function view($url, $slug ,$preview = false)
	{
	
        if($preview){
			$this->auth->is_logged_in();
        }
/*
        if ($url == 'programs'){
            redirect(base_url().'programs/1');
        }
        */
        $data['settings'] 	= $this->settings_model->get();
        $data['pages'] 	= $this->pages_model->get();
        $data['url'] =  $url;
        $data['title'] =  $this->pages_model->get_title_by_url($url);

        $data['banner'] = $this->pages_model->get_banner_by_url($url);
        $type = $this->pages_model->get_type_by_url($url);
        
		$posts = $this->posts_model->get_posts($type, $slug);
        $data['posts'] 	= $posts;
        $data['slug'] 	= $slug;

        $data['news'] 	= $this->posts_model->get_published_post(1);
        $data['announcements'] 	= $this->posts_model->get_published_post(2);
        $data['programs'] 	= $this->posts_model->get_published_post(5);
        $data['programs_menu']   = $this->posts_model->get_programs_order_by_category();
        $data['slider'] 	= $this->posts_model->get_published_post(7);

       	if(empty($data['posts'])){
       		redirect(base_url());
       	}

		$data['template'] 	= 'view_post.php';

        $this->pages_model->add_view($this->util->getIpAddress(), $this->util->getBrowserName(), $url,  $slug);

        $this->theme->initialize($data);
	}

    public function programs( $category = 1)
    {
        $url = 'programs';

        $data['settings'] 	= $this->settings_model->get();
        $data['pages'] 	= $this->pages_model->get();
        $data['url'] =  $url;

        $data['banner'] = $this->pages_model->get_banner_by_url($url);
        $data['programs'] 	= $this->posts_model->get_published_programs($category);

        $data['template'] 	= $this->pages_model->get_template($url);

        $this->pages_model->add_view($this->util->getIpAddress(), $this->util->getBrowserName(), $url,  null);

        $this->theme->initialize($data);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');        
        $this->load->library('util');
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
        
        $data['news'] 	= array_slice($this->posts_model->get_published_post(1), 0, 3);
        $data['featured_news'] 	= $this->posts_model->get_featured();
        $data['slider'] 	= $this->posts_model->get_published_post(7);
        $data['programs'] 	= $this->posts_model->get_published_post(5);

		//$menu = $this->menumodel->get();

		//if(!empty($menu)){
			//$data['menus'] = json_decode($menu[0]->Sequence);
		//}

		$data['template'] = 'home.php';

		$this->theme->initialize($data);
    }

    public function posts($type = 1, $preview = false)
	{
		if($preview){
			$this->auth->is_logged_in();
		}
        $data['title'] 		= 'Home';
        $data['settings'] 	= $this->settings_model->get();
        $data['pages'] 	= $this->pages_model->get();
        $data['url'] =  $this->uri->segment(1);
        
		$posts = $this->posts_model->get_posts($type);
        $data['posts'] 	= $posts;

        //announcements
        $announcements = $this->posts_model->get_posts(2);
        $data['announcements'] 	= $announcements;

        //publications
        $publications = $this->posts_model->get_posts(3);
        $data['publications'] 	= $publications;

        //awards
        $awards = $this->posts_model->get_posts(4);
        $data['awards'] 	= $awards;
		
       	if(empty($data['posts'])){
       		redirect(base_url());
       	}

        $data['pages'] 	= $this->pages_model->get();
        $data['settings'] 	= $this->settings_model->get();
		$data['template'] 	= $this->pages_model->get_template($type);        

        $this->theme->initialize($data);
	}
    
    public function view($blog, $type = "" ,$preview=false)
	{
		if($preview){
			$this->webify->is_logged_in();
		}

		$post = $this->blogmodel->search($blog, $statusid)[0];
        $data['blog'] 	= $blog;
		$data['blogs'] 	= $this->blogmodel->get(4, $blog->BlogId); // list of published blogs

       	if(empty($data['blog'])){
       		redirect(base_url());
       	}

        $menu = $this->menumodel->get();	
        $data['menus'] 		= json_decode($menu[0]->Sequence);
		$data['settings'] 	= $this->settingsmodel->get();
        $data['recents'] 	= $this->blogmodel->recents($blog->Url);
		$data['template'] 	= 'template-blog-post.php';        

        $this->theme->initialize($data);
	}
}

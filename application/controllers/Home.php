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
    }
    
	public function index()
	{               
        $data["user"] =  $this->auth->get_users();        
        $data["latest"] = $this->posts_model->get_latest();
        $data["trending"] = $this->posts_model->get_trending();

        $data["posts"] = $this->input->get('q') == null ? $this->posts_model->get_posts() :  $this->posts_model->search_posts($this->input->get('q'));
       
		$this->load->view('shared/header', $data);
		$this->load->view('content/home', $data);
		$this->load->view('shared/footer');
	}
}

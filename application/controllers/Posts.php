<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');      
        $this->load->library('util');     
        $this->load->helper('url_helper');
        $this->load->model('users_model');
        $this->load->model('posts_model');
        $this->load->model('comments_model');        
        $this->load->model('votes_model');
    }
    
    public function view($slug = null)
	{       
        $data["user"] =  $this->auth->get_users();
        $data["post"] = $this->posts_model->get_posts($slug);
        $data["latest"] = $this->posts_model->get_latest();
        $data["trending"] = $this->posts_model->get_trending();
        $data["related_posts"] = $this->posts_model->get_posts_by_userid($data["post"]["userid"]);
        $data["comments"] = $this->comments_model->get_comments($slug);

        if ($data["post"] == null) redirect(base_url());

		$this->load->view('shared/header', $data);
		$this->load->view('content/view_post', $data);
		$this->load->view('shared/footer');
    }
        
    public function submit()
	{       
        $data["user"] =  $this->auth->get_users();
        $data["latest"] = $this->posts_model->get_latest();
        $data["trending"] = $this->posts_model->get_trending();

		$this->load->view('shared/header', $data);
		$this->load->view('content/new_post', $data);
		$this->load->view('shared/footer');
	}

	public function create()
	{				
        //$this->auth->is_logged_in();	

        $userid =  $this->auth->get_admin()['id'];

		//$this->load->helper('url');
        //$slug = url_title($this->input->post('title'), 'dash', TRUE);

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->posts_model->set_post( $userid )) );
        exit;	
    }

    public function publish(){
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->posts_model->publish()) );
        exit;	
    }

    public function lists($username)
	{               
        $data["user"] =  $this->auth->get_users();        
        $data["latest"] = $this->posts_model->get_latest();
        $data["trending"] = $this->posts_model->get_trending();

        $data["posts"] = $this->posts_model->get_posts_by_username($username);
       
		$this->load->view('shared/header', $data);
		$this->load->view('content/post_lists', $data);
		$this->load->view('shared/footer');
	}
    
    public function delete()
	{		
        $id = $this->input->post('id');

        if ( $this->posts_model->delete($id) ){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
        
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "failed") );
        exit;	
    }
    
    public function vote()
	{		
        $userid =  $this->auth->get_users()['id'];

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array('message' => $this->votes_model->set_vote($userid), 'vote' => $this->posts_model->get_posts_by_id($this->input->post('postid'))['vote'] )  );
        exit;	
        
    }
    
    public function get_posts(){
        $data["user"] =  $this->auth->get_users();
        $data['data'] = $this->comments_model->get_comments_by_userid($data["user"]['id']);     
        $this->load->view('partial/comments', $data);
    }
    
}
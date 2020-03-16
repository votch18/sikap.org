<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');        
        $this->load->helper('url_helper');
        $this->load->model('users_model');
        $this->load->model('comments_model');
        $this->load->model('votes_model');
    }
   
	public function do_upload()
	{				
        $this->auth->is_logged_in();	

        if ($this->comments_model->upload() && $this->comments_model->set_comment()){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
    }

    public function do_upload_image()
	{				
        $this->auth->is_logged_in();	
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("filename" =>  $this->comments_model->upload_image()) );
        exit;	
    }

    public function do_upload_reply()
	{				
        $this->auth->is_logged_in();	

        if ($this->comments_model->upload() && $this->comments_model->set_comment_reply()){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }
	}

	public function delete()
	{		
        $id = $this->input->post('id');
        $file = $this->input->post('file');

        $this->comments_model->delete($id);
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/audio/'.$file)){
            @unlink($file);
        }

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "success") );
        exit;	        
    }

    public function delete_reply()
	{		
        $id = $this->input->post('id');
        $file = $this->input->post('file');

        $this->comments_model->delete_reply($id);
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/audio/'.$file)){
            @unlink($file);
        }

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "success") );
        exit;	        
    }
    
    
    public function get_replies(){
        $data["user"] =  $this->auth->get_users();
        $data['data'] = $this->comments_model->get_replies();     
        $this->load->view('partial/replies', $data);
    }

    public function get_comments_by_userid(){
        $data["user"] =  $this->auth->get_users();
        $data['data'] = $this->comments_model->get_comments_by_userid($data["user"]['id']);     
        $this->load->view('partial/comments', $data);
    }

    
    public function vote()
	{		
        $userid =  $this->auth->get_users()['id'];
        if ($this->votes_model->set_vote($userid) == 'success')	{
            header('Content-Type: application/json; charset=utf-8;');
            echo json_encode( $this->comments_model->get_comment_by_id($this->input->post('postid')));
            exit;			
        }
    }

}
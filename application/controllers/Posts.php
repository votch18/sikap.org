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
    }
   
	public function create()
	{				
        $this->auth->is_logged_in();	

        $userid =  $this->auth->get_users()['id'];

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->posts_model->set_post( $userid )) );
        exit;	
    }

    public function publish(){
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  $this->posts_model->publish()) );
        exit;	
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

    public function uploadCropImage(){

        $img              = str_replace('data:image/jpeg;base64,', '', $this->input->post('cropImage'));
        $img              = str_replace(' ', '+', $img);
        $file            = base64_decode($img);
        $filename        = $this->input->post('url')."_".time().".jpg";
        $path = $_SERVER['DOCUMENT_ROOT'].'/filemanager/'.strtoupper($this->input->post('url')).'/';

        if (!is_dir($path)) {
            // dir doesn't exist, make it
            mkdir($path);
        }

        file_put_contents($path.$filename,$file);
        echo $filename;
        exit;

    }
    
}
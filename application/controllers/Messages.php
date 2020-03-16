<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->library('auth');   
        $this->load->model('users_model');        
        $this->load->model('messages_model');
    }

    public function index(){
        $data["user"] =  $this->auth->get_users();
        $data["thread"] =   $this->messages_model->get_message_thread($data["user"]["id"]);
        $data["url"] = "messages";
        
        //print_r($data["thread"]);

        $this->load->view('shared/header', $data);       
        $this->load->view('content/user_messages', $data);
        $this->load->view('shared/footer');   
    }
   
	public function compose($username)
	{	
        $data["user"] =  $this->auth->get_users();
        $data["recipient"] =   $this->users_model->get_users($username);
        $data["url"] = "messages";

        $this->load->view('shared/header', $data);       
        $this->load->view('content/user_messages', $data);
        $this->load->view('shared/footer');       
    }

	public function send_message()
	{				
        $this->auth->is_logged_in();	

        if ($this->messages_model->send_message()){
            header('Content-Type: application/json; charset=utf-8;');			
            echo json_encode( array("message" =>  "success") );
            exit;	
        }

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "failed") );
        exit;	
    }

    public function get_conversation(){

        $data["user"] = $this->auth->get_users();
        $data['data'] = $this->messages_model->get_conversation();  
        
        //set message to isread = true
        $this->messages_model->set_message_isread();

        $this->load->view('partial/messages', $data);

    }

    public function get_unread_messages(){

        $data["user"] = $this->auth->get_users();
        $data['data'] = $this->messages_model->get_unread_messages($data["user"]["id"]);
        
        $this->load->view('partial/notification', $data);

    }


    public function get_message_count(){
        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("count" =>  count($this->messages_model->get_conversation())) );
        exit;
    }

    public function get_unread_messages_count(){
        $data["user"] = $this->auth->get_users();

        header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("count" =>  count($this->messages_model->get_unread_messages($data["user"]["id"])) ) );
        exit;
    }

}
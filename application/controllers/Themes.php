<?php 
	
/**
* 
*/
class themes extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('theme');
		$this->load->library('auth');
		$this->load->model('settings_model');
		$this->load->model('thememodel');
	}

	public function index()
	{
		$this->auth->is_logged_in();

		$data['navigation'] = 'theme';
		$data['action'] 	= 'Themes';
		$data['button'] 	= '<a href="#" data-toggle="modal" data-target="#upload" class="btn btn-primary">Add</a>';
		$data['connector'] 	= base_url().'filemanager/connector';
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header', $data);
		$this->load->view('content/themes', $data);
		$this->load->view('shared/admin-footer');
	}

	public function load_files()
	{
		$this->auth->is_logged_in();

		$excludes = array('.', '..', 'includes', 'plugins');
		$this->webify->response['data'] = $this->theme->templates($excludes);
		$this->webify->output();
	}

	public function templates()
	{
		$this->auth->is_logged_in();

		$excludes = array('.', '..', 'includes', 'plugins', 'header.php', 'footer.php', 'function.php', 'template-blog.php');
		$includes = array('.php');
		
	}

	public function get()
	{
		$this->auth->is_logged_in();

		$this->webify->response['data'] = array('data'=>$this->thememodel->get());
		
	}

	public function read($file)
	{
		$this->auth->is_logged_in();

		echo file_get_contents( theme::$theme_path . $file );
	}

	public function write()
	{
		$this->auth->is_logged_in();

		$file = $this->input->post('file');
		$text = $this->input->post('text');

		file_put_contents( theme::$theme_path . $file, $text );
				
		header('Content-Type: application/json; charset=utf-8;');			
        echo json_encode( array("message" =>  "success") );
        exit;	
	}

	public function use_theme($themeid)
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$this->thememodel->use_theme($themeid);
		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}	

	public function upload()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$name 		 = $this->input->post('name');
		$image 		 = $this->input->post('image');
		$description = $this->input->post('description');

		// set file upload limit to 30M
		ini_set('upload_max_filesize', '30M');
		ini_set('post_max_size', '30M');

		// upload configuration
		$config['upload_path'] 	 = 'bm-content/.temp/';
		$config['allowed_types'] = 'zip';

		$this->upload->initialize($config);

		if($this->upload->do_upload())
		{	
			$data = $this->upload->data();
			$filename = $data['file_name'];
			$this->unzip->extract('bm-content/.temp/' . $filename, 'bm-content/themes/');

			// delete temp file upload
			unlink('bm-content/.temp/' . $filename);

			// $foldername = preg_replace('/[^a-z0-9+]+/i', '-', strtolower(trim($name)));
			$foldername = $data['raw_name'];
			$path = 'bm-content/themes/' . $foldername . '/';

			$this->thememodel->create($name, $foldername, $description, $image, $path);
			$this->webify->response['data'] = array('message'=>'success');
			$this->webify->output();
		}
		
		$this->webify->response['data'] = array('message'=>'Unable to upload ' . $name);
		$this->webify->output();

	}

}



?>
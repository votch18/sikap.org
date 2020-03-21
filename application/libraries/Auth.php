<?php 

/**
 * Auth System Library Extension
 *
 * @author		Julious Mark de Leon
 * @link		https://linkedin.com/in/votch18
 */

class auth
{
	protected 	$ci;
	
	function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->ci =& get_instance();
    }

    //users
	public function is_logged_in($url = null)
	{
		
		if( $this->ci->session->has_userdata('admin') == null &&  $url != 'login' ){
			redirect(base_url());
		}else if ( $this->ci->session->has_userdata('admin') != null &&  $url == 'login' ){
			redirect(base_url());
		}

		return true;
	}

	public function get_users(){
		return $this->ci->session->userdata('admin');
    }
    
    //admin

    public function admin_is_logged_in()
	{		
		if( $this->ci->session->has_userdata('admin') == null &&  $url != 'login' ){
			redirect(base_url());
		}else if ( $this->ci->session->has_userdata('login') != null &&  $url == 'login' ){
			redirect(base_url());
		}

		return true;
	}
    public function get_admin(){
		return $this->ci->session->userdata('admin');
	}


	
}

?>
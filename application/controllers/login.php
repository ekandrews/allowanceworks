<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
	//	$this->load->view('templates/header');
		//$this->load->view('login_view');
		//$this->load->view('templates/footer');
		
		$data['title'] = 'Log In';
		if ($this->session->userdata('user')) {
			$user = $this->session->userdata('user');
			$data['user'] = $user;
			$this->load->view('templates/header', $data);
			$this->load->view('home_view');
			$this->load->view('templates/footer');
		}
		else {
			$this->form_validation->set_rules('email', 'E-Mail Address', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if ($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header', $data);
				$this->load->view('login_view');
				$this->load->view('templates/footer');
			}
			else {
				$result = $this->userparent_model->login_user();
				if ($result) {
					$session_data = array();
					foreach($result as $row) {
						$session_data = array(
						'email' => $row->email,
						'firstname' => $row->firstname,
						'lastname' => $row->lastname,
						'user_id' => $row->ID,
						'logged_in' => TRUE
						);
					}
					$this->session->set_userdata('user', $session_data);
					
					$user = $this->session->userdata('user');
					$data['user'] = $user;
					$this->load->view('templates/header', $data);
					$this->load->view('home_view');
					$this->load->view('templates/footer');
				}
				else {
					$this->form_validation->set_message('login');
					$this->load->view('templates/header', $data);
					$this->load->view('login_view');
					$this->load->view('templates/footer');
				}
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
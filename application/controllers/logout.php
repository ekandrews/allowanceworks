<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

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
			$this->session->unset_userdata('user');
		}
		$this->load->view('templates/header', $data);
		$this->load->view('login_view');
		$this->load->view('templates/footer');
	}
}

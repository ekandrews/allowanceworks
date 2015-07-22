<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->library('session');
	}

	public function index() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$user = $this->session->userdata('user');
		$data['user'] = $user;
		
		$this->load->view('templates/header', $data);
		$this->load->view('overview_view', $data);
		$this->load->view('templates/footer');
	}
}
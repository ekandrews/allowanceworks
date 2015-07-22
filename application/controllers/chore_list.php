<?php
class Chore_list extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->library('session');
	}
	
	public function index() {
		
		$user = $this->session->userdata('user');
		$data['user'] = $user;
		$this->load->view('templates/header', $data);
		$this->load->view('chore_list_view');
		$this->load->view('templates/footer');
	}
}
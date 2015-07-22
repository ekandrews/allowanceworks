<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->library('session');
	}

	public function index() {
	/*	$this->load->view('templates/header');
		$this->load->view('create_view');
		$this->load->view('templates/footer');
		
		*/
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create Account';

		$this->form_validation->set_rules('email', 'E-Mail Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('create_view');
			$this->load->view('templates/footer');

		}
		else {
			$this->userparent_model->create_user();
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
				$data['firstname'] = $session_data['firstname'];
				$data['user_id'] = $session_data['user_id'];
				$data['numchildren'] = 0;
				$this->load->view('templates/header', $data);
				$this->load->view('add_children_view', $data);
				$this->load->view('templates/footer');
			}
		}
	}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create_child extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userchild_model');
		$this->load->library('session');
	}

	public function index() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$user = $this->session->userdata('user');
		$data['user'] = $user;
		
		$this->form_validation->set_rules('email', 'E-Mail Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('firstname', 'First Name', 'required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('create_child_view', $data);
		}
		else {
			$result = $this->userchild_model->create_user();
			
			if ($result == 1) {
				$data['child_firstname'] = $this->input->post('firstname');
				$data['child_lastname'] = $this->input->post('lastname');
				$data['child_dob'] = $this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('date');
			}
			
			$string = $this->load->view('create_child_success', $data, 'true');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
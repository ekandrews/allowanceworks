<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Select_chores extends CI_Controller {

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
		
		$result = $this->userparent_model->get_chosen_chores($user['user_id']);
		$data['chores'] = json_decode($result->chore_object);
		
		$this->load->view('templates/header', $data);
		$this->load->view('select_chores_view', $data);
		$this->load->view('templates/footer');
	}
	
	public function save_chores() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$user = $this->session->userdata('user');
		$data['user'] = $user;
		
		$this->userparent_model->save_chores();
	}
}
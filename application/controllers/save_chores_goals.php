<?php
class Save_chores_goals extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->library('session');
	}
	
	public function index() {
		$this->load->helper('url');
		
		$this->userparent_model->save_chores_goals();
		
		redirect('overview');
	}
}
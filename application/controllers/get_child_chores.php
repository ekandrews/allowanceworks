<?php
class Get_child_chores extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userchild_model');
		$this->load->model('chores_model');
		$this->load->library('session');
	}
	
	public function index($child_id) {
		
		$result = $this->chores_model->get_child_chores($child_id);
		foreach($result as $row) {
			echo('<p>' . $row->chore_data . '</p>');
		}
	}
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_goals extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->model('chores_model');
		$this->load->library('session');
	}

	public function index() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$user = $this->session->userdata('user');
		$data['user'] = $user;
		
		$numgoals = 0;
		
		$result = $this->userparent_model->get_goals($user['user_id']);
		$sum_result = $this->userparent_model->calculate_values($user['user_id']);
		if (count($sum_result != 0)) {
			$sum_result = json_decode($sum_result);
		}
		
		$goals;
		foreach ($result as $row) {
			$goals = json_decode($row->goal_object);
			$numgoals = count($goals);
		}
		
		$data['numgoals'] = $numgoals;
		$data['goals'] = $goals;
		$data['sums'] = $sum_result[0];
		
		$this->load->view('templates/header', $data);
		$this->load->view('set_goals_view', $data);
		$this->load->view('templates/footer');
	}
	
	public function calculate_chore_values($id = FALSE) {
		if ($id == FALSE) {
			$id = $this->input->post('id');
		}
		
		echo($this->userparent_model->calculate_values($id));
	}
}
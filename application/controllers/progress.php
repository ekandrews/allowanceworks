<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Progress extends CI_Controller {

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
		
		$result = $this->userparent_model->get_chosen_chores($user['user_id']);
		$chores = json_decode($result->chore_object);
		$completed_chores = $this->chores_model->get_chores(time(), $user['user_id']);
		$sums = json_decode($this->userparent_model->calculate_values($user['user_id']));
		
		$total_chores = 0;
		$total_completed_chores = 0;
		$total_value = $sums[0]->weekly_sum;
		$total_earned_value = 0;
		
		foreach($chores as $chore) {
			if ($chore->frequency == 'Daily') $total_chores += 7;
			else if (gettype($chore->frequency) == 'array') $total_chores += array_sum($chore->frequency);
		}
		$data['total_chores'] = count($chores);
		
		$data['total_value'] = $total_value;
		
		
		foreach($completed_chores as $i => $chore) {
			$total_completed_chores += array_sum($chore);
			$total_earned_value += $chores[$i]->value * array_sum($chore);
		}
		$data['total_completed_chores'] = $total_completed_chores;
		$data['total_earned_value'] = $total_earned_value;
		
		$this->load->view('templates/header', $data);
		$this->load->view('progress_view');
		$this->load->view('templates/footer');
		
		
	}
}
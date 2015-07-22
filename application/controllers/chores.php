<?php
class Chores extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('userparent_model');
		$this->load->model('chores_model');
		$this->load->library('session');
	}
	
	public function index() {
		
		$result = $this->userparent_model->get_chosen_chores($parent_id);
		
		$data['result'] = $result;
		
		$this->load->view('templates/header', $data);
		$this->load->view('chore_object_view');
		$this->load->view('templates/footer');
	}
	
	public function get_chosen_chores($parent_id) {
		
		$result = $this->userparent_model->get_chosen_chores($parent_id);
		
		echo $result->chore_object;
		/*$data['result'] = $result->chore_object;
	
		
		$this->load->view('templates/header', $data);
		$this->load->view('chore_object_view');
		$this->load->view('templates/footer', $data);*/
	}
	
	public function submit_completed_chores() {
		$chore_date = strftime('%F', strtotime('this week', strtotime($this->input->post('date'))));
	
		$data = array(
			'chore_data' => $this->input->post('chores'),
			'date' => $chore_date,
			'parent_id' => $this->input->post('parent_id'),
			'status' => false
		);
		
		$result = $this->db->query('SELECT * FROM Chores WHERE date="' . $chore_date . '";');
		
		if ($result->num_rows() == 0) {
		
			return $this->db->insert('Chores', $data);
		}
		else {
			echo('["chore list already exists"]');
		}
	}
	
	public function get_chores() {
		$id = $this->input->post('id');
		$time = $this->input->post('time');
		$result = $this->chores_model->get_chores($id, $time);
		
		foreach($result as $row) {
			echo($row->chore_data);
		}
	}
}
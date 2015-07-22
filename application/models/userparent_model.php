<?php
class userparent_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_users($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('UserParents');
			return $query->result_array();
		}

		$query = $this->db->get_where('UserParents', array('ID' => $id));
		return $query->row_array();
	}
	
	public function create_user() {
		$this->load->helper('url');

		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname')/*,
			'numchildren' => $this->input->post('numchildren')*/
		);

		return $this->db->insert('UserParents', $data);
	}
	
	public function login_user() {
		$this->load->helper('url');
		
		$data = array('email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		
		
		//$query = $this->db->get_where('UserParents', array('email' => $data['email'], 'password' => $data['password']));
		$this->db->select('*');
		$this->db->from('UserParents');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	/*public function save_goals() {
		$this->load->helper('url');
		
		$data = array('
	}*/	
	
	public function save_chores_goals() {
		/*$data = array(
			'chore_object' => $this->input->post('chores'),
			'goal_object' => $this->input->post('goals')
		);*/
		$chore_object = $this->input->post('chores');
		$goal_object = $this->input->post('goals');
		$user_id = $this->input->post('user_id');
		
		return $this->db->query("UPDATE UserParents SET chore_object='" . $chore_object . "', goal_object='" . $goal_object . "' WHERE ID=" . $user_id . ";"); 
		
		//redirect('overview');
	}
	
	public function get_chosen_chores($parent_id) {
		$this->db->select('*');
		$this->db->from('UserParents');
		$this->db->where('ID', $parent_id);
		
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->row();
		}
		else {
			return false;
		}
	}
	
	public function get_goals($id) {
		$this->db->select('*');
		$this->db->from('UserParents');
		$this->db->where('ID', $id);
		
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return false;
		}
	}
	
	public function calculate_values($id) {
		$result = $this->userparent_model->get_chosen_chores($id);
		
		$weekly_sum = 0;
		$monthly_sum = 0;
		
		$chores = json_decode($result->chore_object);
		if (count($chores) > 0) {
		foreach($chores as $chore) {
			if ($chore->frequency == 'Daily') {
				$weekly_sum += 7 * $chore->value;
			}
			else if ($chore->frequency == 'Monthly') {
				$monthly_sum += $chore->value;
			}
			else if (gettype($chore->frequency) == 'array') {
				$weekly_sum += array_sum($chore->frequency) * $chore->value;
			}
		}
		}
		$monthly_sum += 4 * $weekly_sum;
		
		return ('[{"weekly_sum": ' . $weekly_sum . ', "monthly_sum": ' . $monthly_sum . '}]');
	}
}
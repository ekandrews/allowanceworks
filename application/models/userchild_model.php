<?php
class userchild_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_users($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('UserChildren');
			return $query->result_array();
		}

		$query = $this->db->get_where('UserChildren', array('ID' => $id));
		return $query->row_array();
	}
	
	public function create_user() {
		$this->load->helper('url');
		$dob = $this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('date');

		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'parent_id' => $this->input->post('parent'),
			'dob' => $dob
		);

		return $this->db->insert('UserChildren', $data);
	}
	
	/*public function save_chores_goals() {
		/*$data = array(
			'chore_object' => $this->input->post('chores'),
			'goal_object' => $this->input->post('goals')
		);
		$chore_object = $this->input->post('chores');
		$goal_object = $this->input->post('goals');
		$user_id = $this->input->post('user_id');
		
		return $this->db->query('INSERT INTO UserParents ("chore_object", "goal_object") VALUES("' . $chore_object . '", "' . $goal_object . '") WHERE user_id=' . $user_id . ';'); 
		
		redirect('overview');
	}*/
}
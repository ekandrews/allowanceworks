<?php
class chores_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	/*public function get_chores($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('Chores');
			return $query->result_array();
		}

		$query = $this->db->get_where('Chores', array('ID' => $id));
		return $query->row_array();
	}*/
	
	public function get_chores($id, $time) {
		$chore_date = strftime('%F', strtotime('this week', strtotime($time)));
		
		$query = $this->db->query('SELECT * FROM Chores WHERE date="' . $chore_date . '" and parent_id="' . $id . '";');
		
		return $query->result();
	}
	
	
	public function get_child_chores($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('Chores');
			return $query->result_array();
		}

		$query = $this->db->get_where('Chores', array('child_id' => $id));
		return $query->row_array();
	}
	
	public function get_parent_chores($id = FALSE) {
		if ($id === FALSE)
		{
			$query = $this->db->get('Chores');
			return $query->result_array();
		}

		$query = $this->db->get_where('Chores', array('parent_id' => $id));
		return $query->row_array();
	}
	
	/*public function create_chores() {
		$this->load->helper('url');

		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname')
		);

		return $this->db->insert('UserParents', $data);
	}*/
}
<?php
class goals_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_goals($id) {
		
		$query = $this->db->query('SELECT * FROM Goals WHERE ID="' . $id . '";');
		
		return $query->result();
	}
	
	
	/*public function get_child_chores($id = FALSE) {
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
	}*/
	
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
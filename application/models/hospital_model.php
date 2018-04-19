<?php
class Hospital_model extends CI_Model {
	//Doctor - 2, users - 1, lab - 3, nurse - 4
	private $tbl_user= 'tbl_hospital_details';
	
	function __construct(){
		parent::__construct();
	}

	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_hospital_details');
	}
	
	function save($user){
		$this->db->insert($this->tbl_user, $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$this->db->where('user_id', $id);
		$this->db->update($this->tbl_user, $user);
	}
	
	function delete_update($id, $user){//set deleted status as 0
		$this->db->where('user_id', $id);
		$this->db->update('tbl_users', $user);
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_user);
	}

	function active($username, $password)
	{
		$this -> db -> from('tbl_users');
		$this -> db -> where('user_id', $username);
		$this -> db -> where('a = ' . "'" . MD5($password) . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
}
?>
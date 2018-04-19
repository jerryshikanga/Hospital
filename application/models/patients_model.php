<?php
class Patients_model extends CI_Model {
	
	private $tbl_user= 'tbl_patients';

	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_patients');
	}

	function get_list(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_patients');
	}
	
	function get_by_id($id){
		$this->db->where('patient_id', $id);
		return $this->db->get('tbl_patients');
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function save($user){
		$this->db->insert($this->tbl_user, $user);
		return $this->db->insert_id();
	}
	
	function update($id, $user){
		$this->db->where('patient_id', $id);
		$this->db->update('tbl_patients', $user);
	}
	
	function delete_update($id, $user){//set deleted status as 0
		$this->db->where('company_id', $id);
		$this->db->update('tbl_companies', $user);
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_user);
	}
}
?>
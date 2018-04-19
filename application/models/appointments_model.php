<?php
class Appointments_model extends CI_Model {
	
	private $tbl_user= 'tbl_appointments';
	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('appointment_id','desc');
		return $this->db->get('tbl_appointments');
	}

	function get_list(){
		$this->db->order_by('appointment_id','desc');
		$this->db->select('tbl_appointments.*, tbl_patients.name as name , tbl_patients.phone_number as phone_number, tbl_patients.dob as dob , tbl_patients.gender as gender, tbl_patients.location as location');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_appointments.patient_id', 'left');
		return $this->db->get('tbl_appointments');
	}

	function get_list_today($today){
		$where = "DATE(date) >= '". $today ."'";
		$this->db->order_by('appointment_id','desc');
		$this->db->select('tbl_appointments.*, tbl_patients.name as name , tbl_patients.phone_number as phone_number, tbl_patients.dob as dob , tbl_patients.gender as gender, tbl_patients.location as location');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_appointments.patient_id', 'left');
        $this->db->where($where);
		return $this->db->get('tbl_appointments');
	}
	
	function get_by_id($id){
		$this->db->where('patient_id', $id);
		return $this->db->get('tbl_appointments');
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
		$this->db->where('company_id', $id);
		$this->db->update($this->tbl_user, $user);
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
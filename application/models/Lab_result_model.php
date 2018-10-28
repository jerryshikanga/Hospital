<?php
class laboratory_model extends CI_Model {
	
	private $tbl_user= 'tbl_lab_services';
	
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_lab_services');
	}

	function get_list(){
		$this->db->order_by('id','asc');
		return $this->db->get('tbl_lab_services');
	}

	function get_list_all_requests(){
		$this->db->order_by('tbl_lab_requests.status','asc');
		$this->db->order_by('tbl_lab_requests.request_id','desc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name , tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_users.name as user, tbl_patients.dob as dob, tbl_patients.gender as gender');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
		return $this->db->get('tbl_lab_requests');
	}

	function get_list_new_requests(){
		$this->db->order_by('tbl_lab_requests.status','asc');
		$this->db->order_by('tbl_lab_requests.request_id','desc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name , tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_users.name as user, tbl_patients.dob as dob, tbl_patients.gender as gender');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
        $this->db->where('tbl_lab_requests.status', 0);
		return $this->db->get('tbl_lab_requests');
	}

	function get_list_cancelled_requests(){
		$this->db->order_by('tbl_lab_requests.status','asc');
		$this->db->order_by('tbl_lab_requests.request_id','desc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name , tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_users.name as user, tbl_patients.dob as dob, tbl_patients.gender as gender');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
        $this->db->where('tbl_lab_requests.status', 2);
		return $this->db->get('tbl_lab_requests');
	}

	function get_detailed_requests($request_id){
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as patient_name, tbl_patients.dob as dob, tbl_patients.gender as gender, tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_lab_requests_details.*, tbl_users.name as user, tbl_lab_services.name as service_name, tbl_lab_services.price as service_price, tbl_lab_services.description as service_description');
        $this->db->join('tbl_lab_requests', 'tbl_lab_requests.request_id = tbl_lab_requests_details.request_id', 'left');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
        $this->db->join('tbl_lab_services', 'tbl_lab_services.id = tbl_lab_requests_details.service_id', 'left');
        $this->db->where('tbl_lab_requests_details.request_id', $request_id);
		return $this->db->get('tbl_lab_requests_details');
	}

	function get_previous_detailed_requests($patient_id){
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as patient_name, tbl_patients.dob as dob, tbl_patients.gender as gender, tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_lab_requests_details.*, tbl_users.name as user, tbl_lab_services.name as service_name, tbl_lab_services.price as service_price, tbl_lab_services.description as service_description');
        $this->db->join('tbl_lab_requests', 'tbl_lab_requests.request_id = tbl_lab_requests_details.request_id', 'left');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
        $this->db->join('tbl_lab_services', 'tbl_lab_services.id = tbl_lab_requests_details.service_id', 'left');
        $this->db->where('tbl_patient_treatments.patient_id', $patient_id);
        $this->db->where('tbl_lab_requests.status', 1);
		return $this->db->get('tbl_lab_requests_details');
	}

	function get_lab_requests($request_id){
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as patient_name, tbl_patients.dob as dob, tbl_patients.gender as gender, tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_lab_requests_details.*, tbl_users.name as user, tbl_lab_services.name as service_name, tbl_lab_services.price as service_price, tbl_lab_services.description as service_description');
        $this->db->join('tbl_lab_requests', 'tbl_lab_requests.request_id = tbl_lab_requests_details.request_id', 'left');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_lab_requests.patient_treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_lab_requests.user_id', 'left');
        $this->db->join('tbl_lab_services', 'tbl_lab_services.id = tbl_lab_requests_details.service_id', 'left');
        $this->db->where('tbl_lab_requests.request_id', $request_id);
        $this->db->where('tbl_lab_requests.status', 0);
		return $this->db->get('tbl_lab_requests_details');
	}

	function get_list_active(){
		$this->db->order_by('id','asc');
		$this->db->where('deleted_status', 0);
		return $this->db->get('tbl_lab_services');
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_lab_services');
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function save($user){
		$this->db->insert('tbl_lab_services', $user);
		return $this->db->insert_id();
	}

	function saveRequest($user){
		$this->db->insert('tbl_lab_requests', $user);
		return $this->db->insert_id();
	}

	function saveRequestDetails($user){
		$this->db->insert('tbl_lab_requests_details', $user);
		return $this->db->insert_id();
	}
	
	public function insert_json_in_db($json_data) {
		$this->db->insert('tbl_lab_requests_details', $json_data);
		if ($this->db->affected_rows() > 0) {
		return true;
		} else {
		return false;
		}
	}

	function update($id, $user){
		$this->db->where('id', $id);
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
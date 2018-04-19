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
		$this->db->select('tbl_patient_treatments.*, tbl_lab_requests_details.id AS lab_id,tbl_patients.name as patient_name, tbl_patients.dob as dob, tbl_patients.gender as gender, tbl_lab_requests.status as request_status, tbl_lab_requests.*, tbl_lab_requests_details.*, tbl_users.name as user, tbl_lab_services.name as service_name, tbl_lab_services.price as service_price, tbl_lab_services.description as service_description');
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
        $this->db->where('tbl_lab_requests_details.status', 0);
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

	function savePrescription($user){
		$this->db->insert('tbl_prescriptions', $user);
		return $this->db->insert_id();
	}

	function saveRequestDetails($user){
		$this->db->insert('tbl_lab_requests_details', $user);
		return $this->db->insert_id();
	}

	function savePrescriptionDetails($user){
		$this->db->insert('tbl_prescription_medicines', $user);
		return $this->db->insert_id();
	}

	function labRequests()
	{
		return $this->db->select('tbl_lab_requests.request_id, tbl_lab_services.name, tbl_lab_requests.patient_treatment_id as treatment_id')->from('tbl_lab_requests')->join('tbl_lab_requests_details', 'tbl_lab_requests_details.request_id = tbl_lab_requests.request_id', 'inner')->join('tbl_lab_services', 'tbl_lab_services.id = tbl_lab_requests_details.service_id', 'inner')->get();
	}

	function labRequestUsers($request_id)
	{
		return $this->db->query("SELECT T3.id, T4.username AS doctor, T5.username AS requester, T6.username AS labtech FROM tbl_patient_treatments AS T0 LEFT JOIN tbl_lab_requests AS T1 ON T0.id = T1.patient_treatment_id LEFT JOIN tbl_lab_requests_details T3 ON T3.request_id = T1.request_id LEFT JOIN tbl_users T4 ON T4.user_id = T0.user_id LEFT JOIN tbl_users T5 ON T5.user_id = T1.user_id LEFT JOIN tbl_users T6 ON T6.user_id = T3.lab_tech_id where T1.request_id = ". $request_id);
	}

	function treatment_detailUsers($treatment_id)
	{
		return $this->db->query("SELECT TPT.id, TU1.name AS doctor, TU2.name AS requester, TU3.name AS labtech FROM tbl_patient_treatments AS TPT LEFT JOIN tbl_users AS TU1 ON TPT.user_id = TU1.user_id LEFT JOIN tbl_lab_requests AS TR ON TR.patient_treatment_id = TPT.id LEFT JOIN tbl_lab_requests_details AS TRD ON TRD.request_id = TR.request_id LEFT JOIN tbl_users TU2 ON TU2.user_id = TRD.lab_tech_id LEFT JOIN tbl_users TU3 ON TU3.user_id = TPT.user_id where TPT.id = ". $treatment_id);
	}
	
	public function insert_json_in_db($json_data) {
		$this->db->insert('tbl_lab_requests_details', $json_data);
		if ($this->db->affected_rows() > 0) {
		return true;
		} else {
		return false;
		}
	}

	function updateLabRequestDetails($id, $details)
	{
		$this->db->where(array('id' => $id))->update('tbl_lab_requests_details', $details);
	}

	function update($id, $user){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_user, $user);
	}

	function updateLabRequest($id, $user){
		$this->db->where('request_id', $id);
		$this->db->update('tbl_lab_requests', $user);
	}
	
	function delete_update($id, $user){//set deleted status as 0
		$this->db->where('company_id', $id);
		$this->db->update('tbl_companies', $user);
	}

	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_user);
	}

//Save Notifications
	function saveNotification($user){
		$this->db->insert('tbl_notifications', $user);
		return $this->db->insert_id();
	}

//Get Notifications
	function getNotifications($reciever_role, $notification_type){
		$this->db->order_by('tbl_notifications.status','asc');
		$this->db->order_by('notification_id','desc');
		$this->db->select('tbl_patient_treatments.id, tbl_patients.patient_id, tbl_patients.name as patient_name, tbl_roles.name, tbl_notifications.status as notification_status, tbl_notifications.*');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_notifications.treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_notifications.sender_role', 'left');
		$this->db->where('reciever_role', $reciever_role);
		$this->db->where('notification_type', $notification_type);
		return $this->db->get('tbl_notifications');
	}

//Count the number of Notifications
	function countNotifications($role_id, $status){
		$this->db->order_by('notification_id','desc');
		$this->db->where('reciever_role', $role_id);
		$this->db->where('status', $status);
		$query = $this->db->get('tbl_notifications');
		return $query->num_rows();
	}

//Update notifications and mark it as read
	function update_notifications($id, $user){
		$this->db->where('notification_id', $id);
		$this->db->update('tbl_notifications', $user);
	} 

}
?>
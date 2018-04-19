<?php
class Treatment_model extends CI_Model {
	
	private $tbl_user= 'tbl_patient_treatments';
	//status -> 0 == Only symptoms, status - 1 lab request,	 status - 2 prescribe medicine, status - 3 Lab results, status - 4 Not fully Treated
	//treatment_status === 0 - on going, 1 - treated, 2 - Not Fully Treated
	function __construct(){
		parent::__construct();
	}

	function list_all(){
		$this->db->order_by('name','asc');
		return $this->db->get('tbl_patient_treatments');
	}

	function get_list(){
		$this->db->order_by('id','desc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name , tbl_patients.dob as dob, tbl_users.name as user');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_patient_treatments.user_id', 'left');
		return $this->db->get('tbl_patient_treatments');
	}

	function get_list_prescriptions(){
		//$this->db->order_by('id','desc');
		$this->db->select('tbl_prescriptions.prescription_id, tbl_prescriptions.treatment_id as prescription_treatment_id , tbl_prescription_medicines.medicine as medicine, tbl_prescription_medicines.dosage as dosage');
        $this->db->join('tbl_patient_treatments', 'tbl_patient_treatments.id = tbl_prescriptions.treatment_id', 'left');
        $this->db->join('tbl_prescription_medicines', 'tbl_prescription_medicines.prescription_id = tbl_prescriptions.prescription_id', 'left');
		return $this->db->get('tbl_prescriptions');
	}

	function get_list_diagnised(){
		$where="(tbl_patient_treatments.status NOT IN (0))";
		$this->db->order_by('id','desc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name , tbl_patients.dob as dob, tbl_users.name as user, tbl_prescriptions.treatment as diagnosis');
        $this->db->join('tbl_prescriptions', 'tbl_patient_treatments.id = tbl_prescriptions.treatment_id', 'left');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_patient_treatments.user_id', 'left');
        $this->db->where($where);
		return $this->db->get('tbl_patient_treatments');
	}

	//Get detailed patient treatment
	function get_detailed_patientTreatment($treatment_id){
		$where="(tbl_patient_treatments.treatment_status NOT IN (0))";
		$this->db->select('tbl_patient_treatments.id as treatment_id, tbl_patient_treatments.patient_id as patient_id, tbl_patient_treatments.user_id as user_id, 
							tbl_patient_treatments.datetime as datetime, tbl_patient_treatments.status as treatment_status, tbl_patient_treatments.lab_request_id as lab_request_id, 
							tbl_patient_treatments.treatment_status as treatment_status, tbl_patients.name as patient_name , tbl_patients.dob as dob, tbl_users.name as user,
							tbl_prescriptions.treatment as diagnosis');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_prescriptions', 'tbl_prescriptions.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_patient_treatments.user_id', 'left');
        $this->db->join('tbl_lab_requests', 'tbl_lab_requests.patient_treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_lab_requests_details', 'tbl_lab_requests_details.request_id = tbl_lab_requests.request_id', 'left');
        $this->db->where($where);
        $this->db->where('tbl_patient_treatments.id',$treatment_id);
		return $this->db->get('tbl_patient_treatments');
	}


	//Get all the complaints and patients details for patient treatment
	function get_detailed_Complaints($treatment_id){
		$where="(tbl_patient_treatments.treatment_status NOT IN (0))";
		$this->db->select('tbl_patient_treatments.id as treatment_id, tbl_patient_treatments.datetime, tbl_patients.name as patient_name, tbl_patients.dob, tbl_patients.last_visit, tbl_complaints_general_examinations.description as general, tbl_complaints_history.description as history, tbl_complaints_presenting.description as presenting, tbl_complaints_systemic_examinations.description as systemic');
		
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_complaints_general_examinations', 'tbl_complaints_general_examinations.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_complaints_history', 'tbl_complaints_history.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_complaints_presenting', 'tbl_complaints_presenting.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_complaints_systemic_examinations', 'tbl_complaints_systemic_examinations.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->where($where);
        $this->db->where('tbl_patient_treatments.id',$treatment_id);
		return $this->db->get('tbl_patient_treatments');
	}

	//Get the Diagnosis and Prescription for patient treatment
	function get_detailed_Diagnosis($treatment_id){
		$where="(tbl_patient_treatments.treatment_status NOT IN (0))";
		$this->db->select('tbl_prescriptions.treatment as diagnosis, tbl_prescriptions.notes as prescription_notes, tbl_prescription_medicines.medicine, tbl_prescription_medicines.dosage as dosage');
        $this->db->join('tbl_prescriptions', 'tbl_prescriptions.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_prescription_medicines', 'tbl_prescription_medicines.prescription_id = tbl_prescriptions.prescription_id', 'left');
        $this->db->where($where);
        $this->db->where('tbl_patient_treatments.id',$treatment_id);
		return $this->db->get('tbl_patient_treatments');
	}

	//Get the details of lab request for patient treatment
	function get_lab_details($treatment_id){
		$where="(tbl_patient_treatments.treatment_status NOT IN (0))";
		$this->db->select('tbl_patient_treatments.id as patient_treatment_id, tbl_lab_requests.date_created as lab_date, tbl_lab_requests_details.lab_results, tbl_lab_requests_details.notes as lab_notes, tbl_lab_services.name as lab_service');
		$this->db->join('tbl_lab_requests', 'tbl_lab_requests.patient_treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_lab_requests_details', 'tbl_lab_requests_details.request_id = tbl_lab_requests.request_id', 'left');
        $this->db->join('tbl_lab_services', 'tbl_lab_services.id = tbl_lab_requests_details.service_id', 'left');
        $this->db->where($where);
        $this->db->where('tbl_patient_treatments.id',$treatment_id);
		return $this->db->get('tbl_patient_treatments');
	}

	//Get the summary of the Patient's Medical History for patient treatment
	function get_summary_treatment($patient_id){
		$where="(tbl_patient_treatments.treatment_status NOT IN (0))";

		$this->db->select('tbl_patient_treatments.id as patient_treatment_id, tbl_prescriptions.treatment as diagnosis, tbl_prescription_medicines.medicine, tbl_patient_treatments.datetime, tbl_users.name as user_name');
		$this->db->join('tbl_prescriptions', 'tbl_prescriptions.treatment_id = tbl_patient_treatments.id', 'left');
        $this->db->join('tbl_prescription_medicines', 'tbl_prescription_medicines.prescription_id = tbl_prescriptions.prescription_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_patient_treatments.user_id', 'left');
        $this->db->where($where);
        $this->db->where('tbl_patient_treatments.patient_id',$patient_id);
		return $this->db->get('tbl_patient_treatments');
	}


	function get_queued_list(){
		$this->db->order_by('tbl_patient_treatments.id','asc');
		$this->db->select('tbl_patient_treatments.*, tbl_patients.name as name, tbl_patients.phone_number, tbl_patients.dob, tbl_patients.gender, tbl_users.name as user_name,  tbl_lab_requests.status as lab_status,  tbl_lab_requests.request_id as lab_request_id');
        $this->db->join('tbl_patients', 'tbl_patients.patient_id = tbl_patient_treatments.patient_id', 'left');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_patient_treatments.user_id', 'left');
        $this->db->join('tbl_lab_requests', 'tbl_lab_requests.request_id = tbl_patient_treatments.lab_request_id', 'left');
        $this->db->where('treatment_status', 0);
		return $this->db->get('tbl_patient_treatments');
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get('tbl_patient_treatments');
	}

	function get_by_patient_id($id){
		$this->db->where('patient_id', $id);
		return $this->db->get('tbl_patient_treatments');
	}

	function get_by_patient_id_is_treated($id){
		$this->db->where('patient_id', $id);
		$this->db->where('tbl_patient_treatments.treatment_status', 1);
		return $this->db->get('tbl_patient_treatments');
	}

	function get_by_patient_id_not_treated($id){
		$this->db->where('patient_id', $id);
		$this->db->where('tbl_patient_treatments.treatment_status', 0);
		return $this->db->get('tbl_patient_treatments');
	}
	
	function get_by_patient_id_symptoms($id){
		$this->db->where('patient_id', $id);
		$this->db->where('tbl_patient_treatments.status', 0);
		return $this->db->get('tbl_patient_treatments');
	}

	function get_presenting_complaints($id){
		$this->db->where('treatment_id', $id);
		$this->db->where('tbl_complaints_presenting.status', 0);
		return $this->db->get('tbl_complaints_presenting');
	}
	

	function get_history_complaints($id){
		$this->db->where('treatment_id', $id);
		$this->db->where('tbl_complaints_history.status', 0);
		return $this->db->get('tbl_complaints_history');
	}

	function get_general_complaints($id){
		$this->db->where('treatment_id', $id);
		$this->db->where('tbl_complaints_general_examinations.status', 0);
		return $this->db->get('tbl_complaints_general_examinations');
	}

	function get_systemic_complaints($id){
		$this->db->where('treatment_id', $id);
		$this->db->where('tbl_complaints_systemic_examinations.status', 0);
		return $this->db->get('tbl_complaints_systemic_examinations');
	}

	function count_all(){
		return $this->db->count_all($this->tbl_user);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_user, $limit, $offset);
	}
	
	function save($user){
		$this->db->insert('tbl_patient_treatments', $user);
		return $this->db->insert_id();
		//print_r($this->db->insert_id()); die();
	}
		//save from presenting complaints to impressions
	function saveGeneral($user){
		$this->db->insert('tbl_complaints_general_examinations', $user);
		return $this->db->insert_id();
	}

	function saveHistory($user){
		$this->db->insert('tbl_complaints_history', $user);
		return $this->db->insert_id();
	}

	function systemic($user){
		$this->db->insert('tbl_complaints_systemic_examinations', $user);
		return $this->db->insert_id();
	}

	function presenting($user){
		$this->db->insert('tbl_complaints_presenting', $user);
		return $this->db->insert_id();
	}

	function impression($user){
		$this->db->insert('tbl_complaints_impressions_examinations', $user);
		return $this->db->insert_id();
	}
	
	//close of save for impressions
	function update($id, $user){
		$this->db->where('id', $id);
		$this->db->update('tbl_patient_treatments', $user);
	}
	
	//update from presenting complaints to impressions

	function updateGeneral($id, $user){
		$this->db->where('tbl_complaints_general_examinations.treatment_id', $id);
		$this->db->update('tbl_complaints_general_examinations', $user);
	}

	function updateHistory($id, $user){
		$this->db->where('tbl_complaints_history.treatment_id', $id);
		$this->db->update('tbl_complaints_history', $user);
	}

	function updateSystemic($id, $user){
		$this->db->where('tbl_complaints_systemic_examinations.treatment_id', $id);
		$this->db->update('tbl_complaints_systemic_examinations', $user);
	}

	function updatePresenting($id, $user){
		$this->db->where('tbl_complaints_presenting.treatment_id', $id);
		$this->db->update('tbl_complaints_presenting', $user);
	}
	//close of update from presenting complaints to impressions

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
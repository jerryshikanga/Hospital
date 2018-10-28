<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends CI_Controller {

	// num of records per page
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Patients_model','',TRUE);
		$this->load->model('Treatment_model','',TRUE);
		$this->load->model('Medicine_model','',TRUE);
		$this->load->model('Laboratory_model','',TRUE);
	}

	function index($offset = 0)

	{
		if($this->session->userdata('logged_in'))
		{
			$data['patients'] = $this->Patients_model->get_list();
			$this->load->view('includes/header');
			$this->load->view('patient/patientList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function qeued_patients()

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['patients'] = $this->Treatment_model->get_queued_list();
			//print_r($data['patients']->result()[0]); die();
			$this->load->view('includes/header');
			$this->load->view('patient/queuedPatientsList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}
	

	function consultation($id)

	{	
		if(status() == 1)
		{
			if($this->session->userdata('logged_in'))
			{
			//get treatment_id using a helper
				$data['patient_details'] = $this->Patients_model->get_by_id($id);
				$data['treatment_details'] = $this->Treatment_model->get_by_patient_id_not_treated($id);
				//print_r($id); die();

				@$treatment_id = $this->Treatment_model->get_by_patient_id_not_treated($id)->result()[0]->id;
				@$treatment_id = $this->Treatment_model->get_by_patient_id_not_treated($id)->result()[0]->id;
				$data['presenting'] = $this->Treatment_model->get_presenting_complaints($treatment_id);
				$data['general'] = $this->Treatment_model->get_general_complaints($treatment_id);
				$data['history'] = $this->Treatment_model->get_history_complaints($treatment_id);
				$data['systemic'] = $this->Treatment_model->get_systemic_complaints($treatment_id);
				$data['services'] = $this->Laboratory_model->get_list_active();
				$data['medicines'] = $this->Medicine_model->get_list();
				$data['summary'] = $this->Treatment_model->get_summary_treatment($id);

				//print_r($data['summary']->result()); print_r($this->db->last_query());
				// die();
				//print_r($data['presenting']->result()); die();
				$this->load->view('includes/header');
				$this->load->view('patient/consultation', $data);
				$this->load->view('includes/footer');
			}
			else
			{
				$this->load->view('users/login');
			}
		}
		else
		{
			$this->load->view('errors/not_found');
		}
	}

	function diagnosis($id)

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['patient_details'] = $this->Patients_model->get_by_id($id);
			$data['medicines'] = $this->Medicine_model->get_list();
			$data['lab_service'] = $this->Laboratory_model->get_list();
			$data['symptoms'] = $this->Treatment_model->get_by_patient_id_diagnosis($id);
			//print_r($data['symptoms']->result()); die();
			$this->load->view('includes/header');
			$this->load->view('patient/diagnosis', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function patient_treatment()

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['treatment_details'] = $this->Treatment_model->get_list_diagnised();
			//print_r($data['treatment_details']); die();
			$this->load->view('includes/header');
			$this->load->view('patient/patient_treatmentList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function prescription_list()

	{	
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('includes/header');
			$this->load->view('patient/prescriptionList');
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function diagnosis_list()

	{	
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('includes/header');
			$this->load->view('patient/diagnosisList');
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function addPatient()

	{	
		//print_r($this->input->post()); die();
		if($this->session->userdata('logged_in'))
		{
		//0 female and 1 male
		//print_r($this->input->post()); die();
			if($this->input->post('male') == "true"){
				$gender = 1;}
				else
					$gender = 0;
			$this->db->trans_start();
				$admin = array('name' => $this->input->post('name'),
									'phone_number' => $this->input->post('phone_number'),
									'gender' => $gender,
									'location' => $this->input->post('location'),
									'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));
				if($this->Patients_model->save($admin))
				{
					$last_id = $this->db->insert_id();
					update_last_visit($last_id);
					echo "Patient record saved successfully";
				}
				else
					echo "Patient record not saved successfully, Please try again";
			$this->db->trans_complete();
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function editPatient($id = null)
	
	{
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{
			//print_r($this->input->post()); die();
				
				$id = $this->input->post('patient_id');
				if($this->input->post('male') == "true")
				{
					$gender = 1;
				}
				else
					$gender = 0;
				$admin = array('name' => $this->input->post('name'),
									'phone_number' => $this->input->post('phone_number'),
									'gender' => $gender,
									'location' => $this->input->post('location'),
									'dob' => date('Y-m-d', strtotime($this->input->post('dob'))));

				$this->Patients_model->update($id, $admin);
			//print_r($this->db->last_query()); die();
				echo "Patient Details successfully Updated";
			}
			else
			{
				$data['patients'] = $this->Patients_model->get_by_id($id);
				$this->load->view('patient/editPatient', $data);
			}
		}
		else
		{
			$this->load->view('users/login');
		}
		
	}

	function addSymptoms()

	{	
		if($this->session->userdata('logged_in'))
		{
			
	//print_r($this->input->post()); die();
			$this->db->trans_start();
			$user_id = $this->session->userdata('logged_in')['user_id'];
			if($this->input->post('treatment_id') == NULL){
	//print_r("treatment_id is null"); die();
				$patient_id = $this->input->post('id');
				//Inserting a new record
				$admin = array('patient_id' => $this->input->post('id'),
								'user_id' => $user_id,
								'status' => 0);
				$last_id = $this->Treatment_model->save($admin);

				if($last_id)
				{
					
					//print_r($last_id); die();

					$presenting = array('treatment_id' => $last_id,
									'description' => $this->input->post('symptoms'),
									'status' => 0);
					$this->Treatment_model->presenting($presenting);

					if($this->input->post('general') != NULL)
					{
						$general = array('treatment_id' => $last_id,
									'description' => $this->input->post('general'),
									'status' => 0);
						$this->Treatment_model->saveGeneral($general);
					}

					if($this->input->post('history') != NULL)
					{
						$history = array('treatment_id' => $last_id,
									'description' => $this->input->post('history'),
									'status' => 0);
						$this->Treatment_model->saveHistory($history);
					}

					if($this->input->post('systemic') != NULL)
					{
						$systemic = array('treatment_id' => $last_id,
									'description' => $this->input->post('systemic'),
									'status' => 0);
						$this->Treatment_model->systemic($systemic);
					}
				}
				else
				{
					echo "Save not succesful, please try again";	
				}
			}
			else
			{
				//print_r("treatment_id is not null"); die();
				$treatment_id = $this->input->post('treatment_id');
				$patient_id = $this->input->post('id');
				
				$presenting = array('description' => $this->input->post('symptoms'));
				$this->Treatment_model->updatePresenting($treatment_id, $presenting);
				update_last_visit($patient_id);

				//Check if value exists then either save or update

					if($this->input->post('general') != NULL)
					{
						//Check whether data exists so as to save or update data
						if($this->Treatment_model->get_general_complaints($treatment_id)->result() == NULL)
						{
							$general = array('treatment_id' => $treatment_id,
									'description' => $this->input->post('general'),
									'status' => 0);
							$this->Treatment_model->saveGeneral($general);
						}
						else
						{
							$general = array('description' => $this->input->post('general'));
							$this->Treatment_model->updateGeneral($treatment_id, $general);
						}		
					}
					if($this->input->post('history') != NULL)
					{
						//Check whether data exists so as to save or update data
						if($this->Treatment_model->get_history_complaints($treatment_id)->result() == null)
						{
							$history = array('treatment_id' => $treatment_id,
									'description' => $this->input->post('history'),
									'status' => 0);
							$this->Treatment_model->saveHistory($history);
						}
						else
						{
							$history = array('description' => $this->input->post('history'));
							$this->Treatment_model->updateHistory($treatment_id, $history);
						}
						//print_r($this->db->last_query()); die();
					}
					if($this->input->post('systemic') != NULL)
					{
						//Check whether data exists so as to save or update data
						if($this->Treatment_model->get_systemic_complaints($treatment_id)->result() == null)
						{
							$systemic = array('treatment_id' => $treatment_id,
									'description' => $this->input->post('systemic'),
									'status' => 0);
							$this->Treatment_model->systemic($systemic);
						}
						else
						{
							$systemic = array('description' => $this->input->post('systemic'));
							$this->Treatment_model->updateSystemic($treatment_id, $systemic);
						}
					}
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) 
			{
	    		echo "Save not succesful, please try again";
	    	} 
			else
				echo "Saved succesful, you can request for lab test or proceed to prescribe medicine";
		}
		else
		{
			$this->load->view('users/login');
		}
	}
	
	function editSymptoms($id = null)
	
	{
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{
			//print_r($this->input->post()); die();
				
				$id = $this->input->post('item_id');
				
				$admin = array('symptoms' => $this->input->post('symptoms'));

				$this->Treatment_model->update($id, $admin);
			
				echo "Symptoms successfully Updated";
			}
			else
			{
				$data['symptoms'] = $this->Treatment_model->get_by_id($id);
				$this->load->view('patient/editSymptoms', $data);
			}
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function detailedPatientList($treatment_id)

	{	
		if($this->session->userdata('logged_in'))
		{

			$data['detailed_complaints'] = $this->Treatment_model->get_detailed_Complaints($treatment_id);
			$data['detailed_diagnosis'] = $this->Treatment_model->get_detailed_Diagnosis($treatment_id);
			$data['prescriptions'] = $this->Treatment_model->get_list_prescriptions();

			$data['lab_details'] = $this->Treatment_model->get_lab_details($treatment_id);
			//print_r($this->db->last_query());
			//print_r($data['lab_details']->result()); die();

			//print_r($data['detailed_complaints']->result());
			//print_r($data['prescriptions']->result()); die();


			$data['treatment_users'] = $this->Laboratory_model->treatment_detailUsers($treatment_id);
			
			//print_r($data['detailed_treatment']->result());
			//$data['patients'] = $this->Treatment_model->get_queued_list();
			//print_r($data['patients']->result()[0]); die();
			$this->load->view('includes/header');
			$this->load->view('patient/detailedPatientList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laboratory extends CI_Controller {

	// num of records per page
	//Notification Types -> Doc - Lab(1), Lab - Doc(2), Doc - Pharm(3)
	//function saveNotifications($sender_role, $reciever_role, $treatment_id, $notification_type, $request_id)
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Laboratory_model','',TRUE);
		$this->load->model('Treatment_model','',TRUE);
	}

	function lab_services($offset = 0)

	{	
		$data['services'] = $this->Laboratory_model->get_list();
		$this->load->view('includes/header');
		$this->load->view('laboratory/lab_services', $data);
		$this->load->view('includes/footer');
	}

	function requests()

	{	
		$this->load->view('includes/header');
		$this->load->view('laboratory/lab_requests');
		$this->load->view('includes/footer');
	}

	function labResults($request_id)

	{	
		$data['lab_result'] = $this->Laboratory_model->get_lab_requests($request_id);
		//print_r($data['lab_result']->result()); die();
		$this->load->view('includes/header');
		$this->load->view('laboratory/labResults', $data);
		$this->load->view('includes/footer');
	}

	function addLabResult()

	{	
		$sender_role = $this->session->userdata('logged_in')['role_id'];
		$user_id = $this->session->userdata('logged_in')['user_id'];
		$request_id = $this->input->post('request_id');
		$req_id = $this->input->post('treatment_id');
		//print_r($req_id); print_r($request_id); die();

		$request_status = array('status' => 1);

		$post = $this->input->post();
		$ids = $post['request_details_id'];
		$texts = $post['results'];
		for($i = 0; $i < count($ids); $i ++)
		{
			$result = array('lab_results' => $texts[$i], 'status' => 1, 'lab_tech_id' => $user_id);
	//Update lab request - set status to 1
			$this->Laboratory_model->updateLabRequest($request_id, $request_status);
	//Update lab request to show results and also the lab technician
			$this->Laboratory_model->updateLabRequestDetails($ids[$i], $result);
		}
	// Update notifications in the notifications table for notification_type = 2 for lab results and doctor_id[recipient_role] = 2
		saveNotifications($sender_role, 2, $req_id, 2, $request_id); 
		echo "Laboratory Results have been successfully sent";
	}

	function detailedRequest($request_id, $patient_id)

	{	
		$data['detailed_request'] = $this->Laboratory_model->get_detailed_requests($request_id);
		$data['previous'] = $this->Laboratory_model->get_previous_detailed_requests($patient_id);
		$data['users'] = $this->Laboratory_model->labRequestUsers($request_id);
		//print_r($data['detailed_request']->result()); die();
		$this->load->view('includes/header');
		$this->load->view('laboratory/detailedRequest', $data);
		$this->load->view('includes/footer');
	}


	function labRequests()

	{	
		$data['new_requests'] = $this->Laboratory_model->get_list_new_requests();
		$data['all_requests'] = $this->Laboratory_model->get_list_all_requests();
		$data['cancelled_requests'] = $this->Laboratory_model->get_list_cancelled_requests();
		$data['labRequests'] = $this->Laboratory_model->labRequests();
		$this->load->view('includes/header');
		$this->load->view('laboratory/labRequestList', $data);
		$this->load->view('includes/footer');
	}

	function addService()

	{	
		//print_r($this->input->post()); die();

		$admin = array('name' => $this->input->post('name'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'));
		if($this->Laboratory_model->save($admin))
			echo "Laboratory Service has been successfully added";
		else
			echo "Laboratory Service could not be added, please try again";
	}

	function editService($id = null)
	
	{
		if($id == null)
		
		{
		//print_r($this->input->post()); die();
			
			$id = $this->input->post('item_id');
			
			$admin = array('price' => $this->input->post('price'),
						'description' => $this->input->post('description'));

			$this->Laboratory_model->update($id, $admin);
		
			echo "Laboratory Service has been successfully Updated";
		}
		else
		{
			$data['services'] = $this->Laboratory_model->get_by_id($id);
			$this->load->view('laboratory/editService', $data);
		}
	}

	public function activateService($id)
	
	{
		$admin = array('deleted_status' => 0);
		$this->Laboratory_model->update($id, $admin);
		echo "Laboratory Service Activated Successful";
	}

	public function deactivateService($id)
	
	{
		$admin = array('deleted_status' => 1);
		$this->Laboratory_model->update($id, $admin);
		echo "Laboratory Service Deactivated Successful";
	}

	function addRequest()
	
	{
		$sender_role = $this->session->userdata('logged_in')['role_id'];
		$user_id = $this->session->userdata('logged_in')['user_id'];
		$treatment_id = $this->input->post('treatment_id');

		$notes = json_decode($this->input->post('notes'));
		$ids = json_decode($this->input->post('ids'));
		$request = array('patient_treatment_id' => $treatment_id,
						'user_id' => $user_id);

		//Get request_id
		$request_id = $this->Laboratory_model->saveRequest($request);

		// Save notifications in the notifications table for lab_tech[recipient_role]id == 4 and notification type = 1 ofr add lab request
		saveNotifications($sender_role, 4, $treatment_id, 1, $request_id);

		// Update patients treatment with lab request id

		$treatment = array('lab_request_id' => $request_id);
		$this->Treatment_model->update($treatment_id, $treatment);
		if($request_id)
		{
			for($I = 0; $I <$ids; $I ++){
				$note = @$notes[$I];
				$id = @$ids[$I];

			$admin = array('notes' => $note,
							'request_id' => $request_id,
							'service_id' => $id);
			if($id != null)
				$this->Laboratory_model->saveRequestDetails($admin);
			else
				exit();
				echo "Request Successful, Please wait for the lab results";
			}
			
			echo "Request Successful, Please wait for the lab results";
		}
		else
		{
			echo "Request not Successful, Please try again";
		}
	}

	function addMedicine()
	{
		if($this->session->userdata('logged_in'))
		{
			
			$this->db->trans_start();
			$sender_role = $this->session->userdata('logged_in')['role_id'];
			$treatment_id = $this->input->post('treatment_id');
			$medicines = json_decode($this->input->post()['medicine']);
			$dosages = json_decode($this->input->post()['dosage']);

			//print_r($this->input->post()); die();

			//insert into tbl_prescriptions then tbl_prescription_medicines
			$admin = array('treatment_id' => $treatment_id,
							'treatment' => $this->input->post('treatment'));
			$prescription_id = $this->Laboratory_model->savePrescription($admin);

			if($prescription_id)
			{
				for($i = 0; $i < count($medicines); $i ++)
				{
					$result = array('prescription_id' => $prescription_id, 'medicine' => $medicines[$i], 'status' => 1, 'dosage' => $dosages[$i]);
			
			//Save
					$this->Laboratory_model->savePrescriptionDetails($result);
				}
			}

					//--- update_last_visit($patient_id); --- Get Patient_id then update last visit

			//Send Notification to the pharmacists
			saveNotifications($sender_role, 5, $treatment_id, 3, ""); 

			//Update tbl_patient_treatment and marking it as treated
			$admin = array('status' => 2,
							'treatment_status' => 1);

			$this->Treatment_model->update($treatment_id, $admin);

			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) 
			{
	    		echo "Prescription not succesful, please try again";
	    	} 
			else
				echo "Prescription was succesful";

			
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	public function update_notifications($notification_id, $patient_id, $treatment_id, $request_id)
	{
		//Update tbl_notifications to show it has been read
		$admin = array('status' => 1);

		$this->Laboratory_model->update_notifications($notification_id, $admin);
		//print_r($this->db->last_query()); die();

		$url = ("laboratory/detailedRequest/".$request_id."/".$patient_id);
		
		redirect($url, 'refresh');

	}

}
?>
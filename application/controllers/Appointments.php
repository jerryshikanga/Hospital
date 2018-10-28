<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends CI_Controller {

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
		$this->load->model('Appointments_model','',TRUE);
	}

	function index($offset = 0)

	{	
		if(status() == 1)
		{
			if($this->session->userdata('logged_in'))
			{
				$today = date("Y-m-d");
				$data['appointments'] = $this->Appointments_model->get_list_today($today);
				$data['patients'] = $this->Patients_model->get_list();
				$this->load->view('includes/header');
				$this->load->view('appointment/appointmentList', $data);
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

	function addAppointment($id = null)

	{	
	///Try to add appointment from patient list we get the patient id ***
		if(status() == 1)
		{
			if($this->session->userdata('logged_in'))
			{
				if($id == null)
				{
					$data['patients'] = $this->Patients_model->get_list();
					$this->load->view('includes/header');
					$this->load->view('appointment/addAppointment', $data);
					$this->load->view('includes/footer');
				}
				else
				{
					$data['patients'] = $this->Patients_model->get_list();
					$this->load->view('includes/header');
					$this->load->view('appointment/addAppointment', $data);
					$this->load->view('includes/footer');
				}
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

	function saveAppointment()

	{	
		if(status() == 1)
		{
			if($this->session->userdata('logged_in'))
			{
				$admin = array('patient_id' => $this->input->post('patient_id'),
		 				'date' => date('Y-m-d', strtotime($this->input->post('date'))));
				 if($this->Appointments_model->save($admin))
				 {
				 	echo "Appointment has been successfully saved";
				 }
				 else
				 {
				 	echo "Appointment could not be added, please try again";
				 }
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
}
?>
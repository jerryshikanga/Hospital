<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {

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
	}

	function index($offset = 0)

	{	
		//$data['patients'] = $this->Patients_model->get_list();
		$this->load->view('includes/header');
		$this->load->view('services/treatment_serviceList');
		$this->load->view('includes/footer');
	}

}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hospital extends CI_Controller {

	// num of records per page
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Hospital_model','',TRUE);
	}

	function index($offset = 0)

	{	
		$data['hospital'] = $this->Hospital_model->get_by_id();
		$this->load->view('includes/header');
		$this->load->view('users/hospitalDetails', $data);
		$this->load->view('includes/footer');
	}
	
	function details($id = null)
	
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
}
?>
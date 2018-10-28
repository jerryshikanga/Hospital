<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pharmacy extends CI_Controller {

	// num of records per page
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		
		// load model
		$this->load->model('Medicine_model','',TRUE);
	}

	function index($offset = 0)

	{	
		$data['medicines'] = $this->Medicine_model->get_list();
		$data['categories'] = $this->Medicine_model->get_category_list();
		$this->load->view('includes/header');
		$this->load->view('pharmacy/medicineList', $data);
		$this->load->view('includes/footer');
	}

	function requests()

	{	
		//print_r($id); die();
		//print_r($data['treatment_details']->result()); die();
		//print_r($data['patients'])->result();
		$this->load->view('includes/header');
		$this->load->view('laboratory/lab_requests');
		$this->load->view('includes/footer');
	}

	function addMedicine()

	{	
		$admin = array('name' => $this->input->post('name'),
						'price' => $this->input->post('price'),
						'category' => $this->input->post('category'),
						'manufacturer' => $this->input->post('manufacturer'),
						'description' => $this->input->post('description'));
		if($this->Medicine_model->save($admin))
			echo "Medicine has been successfully added";
		else
			echo "Medicine could not be added, please try again";
	}

	function editMedicine($id = null)
	
	{
		if($id == null)
		
		{
		//print_r($this->input->post()); die();
			
			$id = $this->input->post('item_id');
			
			$admin = array('price' => $this->input->post('price'),
						'category' => $this->input->post('category'),
						'manufacturer' => $this->input->post('manufacturer'),
						'description' => $this->input->post('description'));

			$this->Medicine_model->update($id, $admin);
		
			echo "Medicine has been successfully Updated";
		}
		else
		{
			$data['categories'] = $this->Medicine_model->get_category_list();
			$data['medicines'] = $this->Medicine_model->get_by_id($id);
			$this->load->view('pharmacy/editMedicine', $data);
		}
	}

}
?>
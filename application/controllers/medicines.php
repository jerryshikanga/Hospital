<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class medicines extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		// load helper
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Medicine_model');
		$this->load->helper('my_output_helper');
	}

	function index(){
		$data['categories'] = $this->Medicine_model->get_category_list();
		$data['medicines'] = $this->Medicine_model->get_list();
		$this->load->view('includes/header');
		$this->load->view('medicines/medicine_list', $data);
		$this->load->view('includes/footer');
	}

	function addMedicine(){
		$data['name'] = $this->input->post('name');
		$data['price'] = $this->input->post('price');
		$data['category'] = $this->input->post('category');
		$data['description'] = $this->input->post('description');
		$data['manufacturer'] = $this->input->post('manufacturer');

		if (!isset($data['name'])||!isset($data['price'])||!isset($data['category'])||!isset($data['manufacturer'])) {
			outputJSON(null, false, "<div class='alert alert-success'><strong>All</strong> fields should be filled.</div>"); die();
		}

		if ($this->Medicine_model->save($data)) {
			outputJSON(null, true, "<div class='alert alert-success'><strong>Medicine</strong> added successfully.</div>"); die();
		}
		else{
			outputJSON(null, false, "<div class='alert alert-success'><strong>Failed</strong> to add medicine.</div>"); die();
		}
		
	}


	function edit_medicine_modal($id){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['categories'] = $this->Medicine_model->get_category_list();
			$data['medicine'] = $this->Medicine_model->get_by_id($id)->row();
			$this->load->view('medicines/editMedicineForm', $data);
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function deleteMedicine($id){

	}

	function addMedicineCategory(){
		if($this->session->userdata('logged_in'))
		{
			$data['name'] = $this->input->post('categoryName');
			if (!isset($data['name'])) {
				outputJSON(null, false, "<div class='alert alert-success'><strong>All</strong> fields should be filled.</div>"); die();
			}
			if ($this->Medicine_model->save_medicine_category($data)) {
				outputJSON(null, true, "<div class='alert alert-success'><strong>Category ".$data['name']."</strong> added successfully.</div>"); die();
			} else {
				outputJSON(null, false, "<div class='alert alert-success'><strong>Failed</strong> to add category.</div>"); die();
			}	
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function editMedicine($id=null){
		if(!$this->session->userdata('logged_in'))
		{
			outputJSON(null, false, "<div class='alert alert-success'><strong>Login</strong> to continue.</div>"); die();
		}
		if($id == null) {	$id = $this->input->post('user_id'); }

		$name = $this->input->post('name');
		$category = $this->input->post('category');
		$manufacturer = $this->input->post('manufacturer');
		$price = $this->input->post('price');
		$description = $this->input->post('description');

		if (isset($name)) { $data['name'] = $name; }
		if (isset($manufacturer)) { $data['manufacturer'] = $manufacturer; }
		if (isset($price)) { $data['price'] = $price; }
		if (isset($description)) { $data['description'] = $description; }
		if (isset($category)) { $data['category'] = $category; }

		if ($this->Medicine_model->update($id, $data)) {
			outputJSON(null, true, "<div class='alert alert-success'><strong>".$data['name']."</strong> editedd successfully.</div>"); die();
		} else {
			outputJSON(null, false, "<div class='alert alert-success'><strong>Failed</strong> to edit category.</div>"); die();
		}
	}
}
?>
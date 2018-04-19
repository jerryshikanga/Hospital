<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	// num of records per page
	
	function __construct()
	{
		parent::__construct();
		
		// load library
		$this->load->library(array('table','form_validation'));
		
		// load helper
		$this->load->helper('url');
		$this->load->helper('my_output_helper');
		
		// load model
		$this->load->model('User_model','',TRUE);
		$this->load->model('Treatment_model','',TRUE);
	}

	function index($offset = 0)

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['users'] = $this->User_model->list_all();
			$this->load->view('includes/header');
			$this->load->view('users/userList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function doctors()

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['doctors'] = $this->User_model->get_list_active_doctors();
			$this->load->view('includes/header');
			$this->load->view('users/doctorList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function technicians()

	{	
		if($this->session->userdata('logged_in'))
		{
			$data['labTechs'] = $this->User_model->get_list_active_lab_tech();
			$this->load->view('includes/header');
			$this->load->view('users/lab_technicians', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function nurses()

	{	
		if($this->session->userdata('logged_in'))
		{
			// $data['nurses'] = $this->User_model->get_list_active_nurses();
			$data['nurses'] = $this->User_model->get_list_active_nurses();
			$this->load->view('includes/header');
			$this->load->view('users/nurseList', $data);
			$this->load->view('includes/footer');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function login()

	{	
		$this->load->view('users/login');
	}
	   
	function verifylogin()

	{
		$this->load->helper('security');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('users/login');
		}
		else
		{
			redirect('patients', 'refresh');
		}
    
  	}
  
	function check_database($password)

	{ 
	    $username = $this->input->post('username');
	    $result = $this->User_model->login($username, $password);
	    if($result)
	    {
	      $sess_array = array();
	      foreach($result as $row)
	      {
	        $sess_array = array(
	          'user_id' => $row->user_id,
	          'name' => $row->name,
	          'role_id' => $row->role_id,
	          'username' => $row->username,
	          'role' => $row->role_id
	        );
	        $this->session->set_userdata('logged_in', $sess_array);
	      }
	      return TRUE;
	    }
	    else
	    { 
	    	//echo $this->db->last_query();
	      $this->form_validation->set_message('check_database', 'Invalid Username or Password');
	      return false;
		}
	}

	function changepwd()
	
	{
		if($this->session->userdata('logged_in'))
		{
		$user = $this->User_model->login($this->session->userdata('logged_in')['username'], $this->input->post('password'));
		if(empty($user))
			echo "Invalid password for logged in user!";
		else
		{
			$admin = array('password' => md5($this->input->post('npassword')));
			($this->User_model->update($user[0]->user_id, $admin));
			echo "Password successfully changed";
		}
		}
		else

		{
			redirect('login','refresh');
		}
	}

	public function logout()
	  
	{	
		$this->session->unset_userdata('logged_in');
       	$this->session->sess_destroy();
		redirect('users/login', 'refresh');
	}

	function register(){
		if($this->session->userdata('logged_in'))
		{
			$name = $this->input->post('name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$role = $this->input->post('role');
			if ($this->User_model->userNameExists($username)) {
				outputJSON(null, false, "<div class='alert alert-danger'><strong>Username</strong> already in use.</div>"); die();
			}
			else
			{
				$data['name'] = $name;
				$data['username'] = $username;
				$data['password'] = $password;
				$data['role_id'] = $role;
				$user_id = $this->User_model->save($data);

				switch ($role) {
					case 2:
						$this->User_model->addDoctor($user_id);
						break;

					case 3:
						$this->User_model->addNurse($user_id);
						break;

					case 4:
						$this->User_model->addLabTechnician($user_id);
						break;

					case 5:
						$this->User_model->addPharmacist($user_id);
						break;
					
					default:
						# code...
						break;
				}

				outputJSON(null, true, "<div class='alert alert-success'><strong>User </strong> registred successfully.</div>"); die();
			}
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function checkUserName(){
		$username = $this->input->post('username');
		if (!isset($username)) {
			outputJSON(null, false, "<div class='alert alert-danger'><strong>Username</strong> field empty.</div>"); die();
		} else {
			if ($this->User_model->userNameExists($username)) {
				outputJSON(null, false, "<div class='alert alert-danger'><strong>Username</strong> already in use.</div>"); die();
			}
			else{
				outputJSON(null, true, "<div class='alert alert-success'><strong>Username</strong> available.</div>"); die();
			}
		}
	}

	function get_user_roles(){
		$roles = $this->User_model->get_user_roles();
		$output ="<select class='form-control' name='role'>";
		foreach ($roles as $roleItem) {
			$output .= "<option value=".$roleItem['role_id'].">".$roleItem['name']."</option>";
		}
		$output .= "</select>";
		print_r($output);
	}

	function edit_user_modal($id=null){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['user'] = $this->User_model->get_by_id($id);
			$this->load->view('users/editUser', $data);
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function edit_user_db($id=null){
		if($this->session->userdata('logged_in'))
		{
			$password = $this->input->post('password');
			$username = $this->input->post('username');
			$name = $this->input->post('name');
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			if (isset($password)&&$password!="") {
				$data['password'] = $password;
			}
			if (isset($username)&&$username!="") {
				$data['username'] = $username;
			}
			if (isset($name)&&$name!="") {
				$data['name'] = $name;
			}
			$this->User_model->update($id, $data);
			outputJSON(null, true, "<div class='alert alert-success'><strong>User</strong> updated successfully.</div>"); die();
		}
		else
		{
			$this->load->view('users/login');
		}
	}

	function add_user_form(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('users/addUser');
		}
		else
		{
			$this->load->view('users/login');
		}
	}

}
?>
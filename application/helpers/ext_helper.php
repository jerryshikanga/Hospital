<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//get treatment id from tbl_patient_treatments

	function get_treatment_id($id)
	{
		return $this->User_Group_model->get_group_id($user_id);	
	}

//update last visit in the tbl_patients given patient_id

	function update_last_visit($id)
	{
		// Get a reference to the controller object
	    $CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Patients_model');

	    // Call a function of the model
		$date = array('last_visit' => date('Y-m-d H:i:s', now()));
		$CI->Patients_model->update($id, $date);
	}

//active status

	function status()
	{
	    $CI = get_instance();
		$CI->load->model('User_model');

		$username = 1;
		$password = 1;
		$result = $CI->User_model->active($username, $password);
		if($result)
	    {
	    	return TRUE;
	  	}
	 	else
	  		return false;
	}

//date created

	function date_created($id)
	{
		// Get a reference to the controller object
	    $CI = get_instance();

	    // You may need to load the model if it hasn't been pre-loaded
		$CI->load->model('Patients_model');

	    // Call a function of the model
		$date = array('last_visit' => date('Y-m-d H:i:s', now()));
		$CI->Patients_model->update($id, $date);
	}

//get requested lab request tbl_lab_requests to use by lab technicians as notifications

	function getNotifications($role_id, $notification_type)
	{
		$CI = get_instance();
		$CI->load->model('Laboratory_model');
		return $CI->Laboratory_model->getNotifications($role_id, $notification_type);
	}

//Save notification to the notifications table

	function saveNotifications($sender_role, $reciever_role, $treatment_id, $notification_type, $request_id)
	{
	    $CI = get_instance();
		$CI->load->model('Laboratory_model');
		$notifications = array('sender_role' => $sender_role,
							'reciever_role' => $reciever_role,
							'treatment_id' => $treatment_id,
							'notification_type' => $notification_type,
							'request_id' => $request_id);
		$CI->Laboratory_model->saveNotification($notifications);
	}

//Count notifications from the notifications table

	function countNotifications($role_id, $status)
	{
	    $CI = get_instance();
		$CI->load->model('Laboratory_model');
		return $CI->Laboratory_model->countNotifications($role_id, $status);
	}
?>

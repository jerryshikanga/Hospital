<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	$CI =& get_instance();
	$CI->load->model('model_name');
//get treatment id from tbl_patient_treatments

	function get_treatment_id($id)
	{
		return $this->User_Group_model->get_group_id($user_id);	
	}

//update last visit in the tbl_patients given patient_id

	function update_last_visit($id)
	{
		$date = array('last_visit' => date('Y-m-d H:i:s', now()));
		$CI->Patients_model->update($id, $date);
	}

?>
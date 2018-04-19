<?php
defined("BASEPATH") or exit("No direct script access allowed");

function outputJSON($data, $success, $message)
{
	if (!is_bool($success)) {
		$sucess = boolval($sucess);
	}
	if (!is_array($data)) {
		$data = array($data);
	}
	$data['success'] = $success;
	$data['message'] = $message;
	echo json_encode($data);
}

?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getCurrentDateTime(){
	$date = new DateTime();
	$date = $date->setTimeZone(new DateTimeZone('Africa/Nairobi'));
	return $date->format('Y-m-d H:i:s');
}

?>
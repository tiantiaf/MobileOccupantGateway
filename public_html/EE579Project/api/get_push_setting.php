<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');
	
	$resultData = array();
	
	if($_GET['email']){
		$email = $_GET['email'];
		$resultData = getPushSetting($email);
		echo $email;
	}else{
		$resultData = array('code' => -1, 'error' => 'Emailid missing');
	}
	
	echo json_encode($resultData);
?>
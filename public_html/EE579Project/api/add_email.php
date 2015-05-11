<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$emailId = urldecode($_GET['email']);
	
	$result = getSignupKey($emailId);
	
	
	echo json_encode($result);
?>
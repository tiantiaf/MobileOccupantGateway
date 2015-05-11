<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$emailId = urldecode($_GET['email']);
	
	$result = updateUserId($emailId);
	
	
	echo json_encode($result);
?>
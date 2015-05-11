<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');
	
	$address = $_GET['address'];
	$result = getLocation($address);
	echo json_encode($result);
?>
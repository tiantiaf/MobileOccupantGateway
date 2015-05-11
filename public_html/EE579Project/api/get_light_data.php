<?php
include '../db/dbhelper.php';
	header('Content-Type: application/json');
	$userid = $_GET['userid'];
	
	echo json_encode(retrieveLightData($userid));
?>
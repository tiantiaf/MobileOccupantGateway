<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$survey_id = $_GET['survey_id'];
	$result = getSegments($survey_id);
	echo json_encode($result);
?>
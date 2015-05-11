<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$push_survey_id = $_GET['push_survey_id'];
	$result = getSegments($push_survey_id);
	echo json_encode($result);
?>
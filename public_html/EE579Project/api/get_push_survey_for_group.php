<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$group_id = $_GET['group_id'];
	$result = getSurveyAsGroup($group_id);
	echo json_encode($result);
?>
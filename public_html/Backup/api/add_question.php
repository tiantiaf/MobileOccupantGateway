<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');
	
	$survey_id = $_POST['q_survey'];
	$text = $_POST['q_text'];
	$type = $_POST['q_type'];
	
	json_encode(insertNewQuestion($survey_id, $text, $type));
	
?>
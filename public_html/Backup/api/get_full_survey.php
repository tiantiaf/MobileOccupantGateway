<?php
	include '../db/dbhelper.php';
	$survey_id = $_GET['survey_id'];
	
	header('Content-Type: application/json');
	
	$surveyDetails = getSurveyDetails($survey_id);
	$questions = getFullSurvey($survey_id);
	echo json_encode(array('survey' => $surveyDetails, 'survey_details' => $questions));
?>
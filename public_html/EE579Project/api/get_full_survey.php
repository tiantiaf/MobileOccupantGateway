<?php
	include '../db/dbhelper.php';
	$survey_id = $_GET['survey_id'];
        $push_id = $_GET['push_id'];
	$email = $_GET['email'];

        if($push_id != 0){
                 savePushType($push_id, $email);
        }
	header('Content-Type: application/json');
	
	$surveyDetails = getSurveyDetails($survey_id);
	$questions = getFullSurvey($survey_id);
	echo json_encode(array('survey' => $surveyDetails, 'survey_details' => $questions));
?>
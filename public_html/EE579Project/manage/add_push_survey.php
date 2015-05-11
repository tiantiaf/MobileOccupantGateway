<?php

	include ('../db/dbhelper.php');
	
	$group_id = $_POST['q_push_id'];
        $email_id = $_POST['q_push_survey_user'];
	$survey_name = $_POST['q_push_survey'];
        $push_type = $_POST['q_push_type'];
        $push_duration = $_POST['q_push_duration'];

	$result = insertNewPushSurvey($group_id, $email_id, $survey_name, $push_type, $push_duration);
	echo $result;
	
	
	if ($result['code'] > 0) {
		header('Location: manage.php?status=3&msg=' . $result['message']);
	} else {
		header('Location: manage.php?status=0&msg=' . $result['message']);
	}



?>
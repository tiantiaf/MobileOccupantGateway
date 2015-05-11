<?php

	include ('../db/dbhelper.php');
	
	$group_id = $_POST['default_group_id'];
        $email_id = $_POST['default_user_email'];
	$survey_name = $_POST['default_survey_id'];
        
	$result = setDefaultSurvey($group_id, $email_id, $survey_name);
	echo $result;
	
	
	if ($result['code'] > 0) {
		header('Location: manage.php?status=3&msg=' . $result['message']);
	} else {
		header('Location: manage.php?status=0&msg=' . $result['message']);
	}



?>
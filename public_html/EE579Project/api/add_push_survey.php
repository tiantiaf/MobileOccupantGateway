<?php

	include ('../db/dbhelper.php');
	
	$group_id = $_GET['group'];
        $email_id = $_GET['email_id'];
	$survey_name = $_GET['survey_id'];
        $push_type = $_GET['push_type'];
        $verification_key = $_GET['key'];
        $push_duration = $_GET['push_duration'];

        if($verification_key == 'mobile'){	
	        $result = insertNewPushSurvey($group_id, $email_id, $survey_name, $push_type, $push_duration);	
        }
?>
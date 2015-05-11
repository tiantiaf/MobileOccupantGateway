<?php

	include ('../db/dbhelper.php');
	
	$name = $_POST['q_delete_survey'];
	
	deleteSurveyRelOptions($name);
	deleteSurveyRelQuestions($name);
	deleteExistingOptions($name);
	deleteExistingQuestions($name);
	deleteSurveySegments($name);
	deleteSurveyUser($name);
	
	$result = deleteExistingSurvey($name);
	
	//echo $name;
	echo $result;
	
	if ($result['code'] > 0) {
		header('Location: manage.php?status=3&msg=' . $result['message']. $name);
	} else {
		header('Location: manage.php?status=3&msg=' . $result['message']. $name);
	}



?>
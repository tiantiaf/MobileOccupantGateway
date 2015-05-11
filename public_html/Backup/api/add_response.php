<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');	
	
	$responseJson = $_POST['response'];

	//$result = '{"result":[{"response":3,"question_type":"l","related_question_id":"-1","question_id":"1"},{"response":"o_ 4","question_type":"c","related_question_id":"-1","question_id":"2"},
        //{"response":"o_ 6","question_type":"c","related_question_id":"-1","question_id":"2"}],"survey_id":"1","user_id":"1234567"}';
	$result = recordResponseNew(json_decode($responseJson));
	echo json_encode($result);
?>
<?php
	include '../db/dbhelper.php';
	$survey_id = $_GET['survey_id'];
        $push_id = $_GET['push_id'];
	$email = $_GET['email'];
        $result = savePushType($push_id, $email);
	
?>
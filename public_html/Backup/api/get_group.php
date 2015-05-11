<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');
	
	echo json_encode(retrieveGroups());
?>
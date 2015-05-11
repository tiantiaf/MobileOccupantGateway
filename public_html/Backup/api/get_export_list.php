<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');
	$result = getTables();
	echo json_encode($result);
?>
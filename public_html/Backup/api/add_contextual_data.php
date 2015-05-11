<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');	
	
	$userid = urldecode($_GET['userid']);
	$light = urldecode($_GET['light']);
	$temp = urldecode($_GET['temp']);
	//$result = insertIntoContexualData($userid, $light, $temp);
	
	$result = insertIntoContexualData($userid, $light, $temp);
	
	
	echo json_encode($result);
?>
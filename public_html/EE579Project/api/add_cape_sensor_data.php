<?php
	include('../db/dbhelper.php');

	header('Content-Type: application/json');	

	
        $device = urldecode($_GET['device']);
	$temp     = urldecode($_GET['temp']);
        $humidity = urldecode($_GET['humidity']);

        
	$result = insertIntoCapeData($device, $temp, $humidity);
	
	
	echo json_encode($result);
?>
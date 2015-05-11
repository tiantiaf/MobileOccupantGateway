<?php
	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');	
	
	$userid = urldecode($_GET['userid']);
	$light = urldecode($_GET['light']);
	$temp = urldecode($_GET['temp']);
        $battery = urldecode($_GET['battery']);
        $motion = urldecode($_GET['motion']);
        $S4_temp = urldecode($_GET['S4_temp']);
        $wifi = urldecode($_GET['wifi']);
        $bluetooth = urldecode($_GET['bluetooth']);
	
	$result = insertIntoContexualData($userid, $light, $temp, $battery, $motion, $S4_temp, $wifi);
	
	
	echo json_encode($result);
?>
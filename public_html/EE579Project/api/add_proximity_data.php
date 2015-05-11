<?php

	include('../db/dbhelper.php');
	
	header('Content-Type: application/json');	
	
	$userid	   = urldecode($_GET['userid']);
	$timestamp = urldecode($_GET['time']);
	$light     = urldecode($_GET['light']);
	$proximity = urldecode($_GET['proximity']);
	$x = urldecode($_GET['x']);
	$y = urldecode($_GET['y']);
	$z = urldecode($_GET['z']);
	$wifi = urldecode($_GET['wifi']);
	$wifistrength = urldecode($_GET['wifistrength']);
	$traffic      = urldecode($_GET['traffic']);
	$battery      = urldecode($_GET['battery']);
	$memorysize   = urldecode($_GET['memorysize']);
	
	//$result = insertIntoContexualData($userid, $light, $temp);
	
	$result = insertIntoProximityData($userid, $timestamp, $x, $y, $z, $light, $proximity, $wifi, $wifistrength, $traffic, $battery, $memorysize);
	
	
	echo json_encode($result);
?>
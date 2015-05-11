<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');
	$group_id = $_GET['group_id'];
	$result = getUserAsGroup($group_id);
	echo json_encode($result);
?>
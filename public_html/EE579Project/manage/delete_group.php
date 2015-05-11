<?php

	include ('../db/dbhelper.php');
	
	$name = $_POST['delete_group_type'];
	echo $name;
	$result = deleteGroup($name);
        
	//echo $name;
	//echo $result;
	
	if ($result['code'] > 0) {
		header('Location: recruite.php?status=3&msg=' . $result['message'] . $name);
	} else {
		header('Location: recruite.php?status=3&msg=' . $result['message'] . $name);
	}



?>
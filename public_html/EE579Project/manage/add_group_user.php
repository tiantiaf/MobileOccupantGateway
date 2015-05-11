<?php
include ('../db/dbhelper.php');

$group_name = $_POST['group_user'];
$email_id_list = $_POST['group_user_email'];
$user_id = 0;
if (strcasecmp($group_name, "na") == 0) {
	//echo $group_name;
	header('Location: recruite.php?status=0&msg=' . "group name missing");
} else {
	$email_id = explode(';', $email_id_list);

	for ($i = 0; $i  < count(explode(';', trim($email_id_list, ';'))); $i ++) {
			
		$result = insertGroupUser($group_name, $email_id[$i], $user_id);
		
	}
	
	//$result = insertGroupUser($group_name, $email_id, $user_id);
	
	if ($result['code'] > 0) {
		$result = getPushKey($email_id);
		header('Location: recruite.php?status=1&msg=' . $result['message']);
	} else {
		header('Location: recruite.php?status=0&msg=' . $result['message']);
	}
}



?>
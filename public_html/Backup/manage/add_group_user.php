<?php
include ('../db/dbhelper.php');

$group_name = $_POST['group_user'];
$email_id   = $_POST['group_user_email'];
$user_id    = 0;
$result = insertGroupUser($group_name, $email_id, $user_id);

if ($result['code'] > 0) {
        $result = getPushKey($email_id);
	header('Location: recruite.php?status=1&msg=' . $result['message']);
} else {
	header('Location: recruite.php?status=0&msg=' . $result['message']);
}

?>
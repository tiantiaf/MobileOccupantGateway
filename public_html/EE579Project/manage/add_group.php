<?php
include ('../db/dbhelper.php');

$group_name = $_POST['group_id'];

$result = insertGroupName($group_name);

if ($result['code'] > 0) {
	header('Location: recruite.php?status=1&msg=' . 'Group successfully added. Now it is time to populate the group with email addresses using the Add User Tab.');
        
} else {
	header('Location: recruite.php?status=0&msg=' . $result['message']);
}

?>
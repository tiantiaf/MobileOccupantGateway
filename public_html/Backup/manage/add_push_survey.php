<?php

include ('../db/dbhelper.php');

$user_id = $_POST['q_push_id'];
$name = $_POST['q_push_survey'];

//$user = $_GET['user_id'];
//$name = $_GET['q_push_survey'];


$result = insertNewPushSurvey($user_id, $name);
//echo $result;


if ($result['code'] > 0) {
	header('Location: manage.php?status=1&msg=' . $result['message']);
} else {
	header('Location: manage.php?status=0&msg=' . $result['message']);
}



?>
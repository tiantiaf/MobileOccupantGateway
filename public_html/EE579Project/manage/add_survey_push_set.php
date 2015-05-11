<?php
include ('../db/dbhelper.php');

$name     = $_POST['q_push_set_survey'];
$group_id = $_POST['q_push_set_id'];
$frequency = $_POST['q_survey_frequency'];
$light     = $_POST['light_threshold'];
$temperature = $_POST['temp_threshold'];

$results = getGroupUserData($group_id);

foreach ($results['data'] as $result) {
	$email_id = $result['email_id'];
	echo $email_id;
	$push_result = insertSurveyPushSet($name, $email_id, $frequency, $light, $temperature, $group_id);
		
	
}

if ($push_result['code'] > 0) {
	header('Location: manage.php?status=1&msg=' . $push_result['message']);
} else {
	header('Location: manage.php?status=0&msg=' . $push_result['message']);
}

?>

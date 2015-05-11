<?php
include ('../db/dbhelper.php');

$name    = $_POST['q_push_set_survey'];
$emailId = $_POST['q_push_set_id'];
$frequency = $_POST['q_survey_frequency'];
$light     = $_POST['light_threshold'];
$temperature = $_POST['temp_threshold'];

echo $emailId;

$result = insertSurveyPushSet($name, $emailId, $frequency, $light, $temperature);

if ($result['code'] > 0) {
	header('Location: manage.php?status=1&msg=' . $result['message']);
} else {
	header('Location: manage.php?status=0&msg=' . $result['message']);
}

?>

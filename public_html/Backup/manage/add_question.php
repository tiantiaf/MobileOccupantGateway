<?
include '../db/dbhelper.php';

$survey_id = $_POST['q_survey'];
$text = $_POST['q_text'];
$type = $_POST['q_type'];
$segment = $_POST['q_segment'];

$options = array();

if ($_POST['opt1'] != null) {
	array_push($options, $_POST['opt1']);
	if ($_POST['opt2'] != null) {
		array_push($options, $_POST['opt2']);
		if ($_POST['opt3'] != null) {
			array_push($options, $_POST['opt3']);
			if ($_POST['opt4'] != null) {
				array_push($options, $_POST['opt4']);
			}
		}
	}
}

$rText = $_POST['qr_text'];
$rType = $_POST['qr_type'];
$rOptions = array();

if ($_POST['r_opt1'] != null) {
	array_push($rOptions, $_POST['r_opt1']);
	if ($_POST['r_opt2'] != null) {
		array_push($rOptions, $_POST['r_opt2']);
		if ($_POST['r_opt3'] != null) {
			array_push($rOptions, $_POST['r_opt3']);
			if ($_POST['r_opt4'] != null) {
				array_push($rOptions, $_POST['r_opt4']);
			}
		}
	}
}

$result = insertNewQuestion($survey_id, $text, $type, $options, $rText, $rType, $rOptions, $segment);

if ($result['code'] > 0) {
	header('Location: manage.php?status=1&msg=' . $result['message']);
} else {
	header('Location: manage.php?status=0&msg=' . $result['message']);
}
?>
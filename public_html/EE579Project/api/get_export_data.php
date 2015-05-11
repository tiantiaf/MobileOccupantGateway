<?
include '../db/dbhelper.php';
$user_id = $_GET['email_id'];
$start_time = $_GET['start_time'];
$end_time   = $_GET['end_time'];

$result = exportSurveyDataToCSVInTimeRange($user_id, $start_time, $end_time);

$filename = $user_id . "_" . time();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'.csv"');

print_r("$result");


?>
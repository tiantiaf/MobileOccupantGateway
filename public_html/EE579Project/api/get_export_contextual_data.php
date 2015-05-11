<?
include '../db/dbhelper.php';
$user_id = $_GET['email_id'];
$start_time = $_GET['start_time'];
$end_time   = $_GET['end_time'];

$result = exportContexualToCSVInTimeRange($user_id, $start_time, $end_time);

echo $user_id;

$filename = $user_id . "_" . time();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'.csv"');

print_r("$result");


?>
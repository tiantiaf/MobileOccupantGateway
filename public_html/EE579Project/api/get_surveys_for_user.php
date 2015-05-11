<?php
include '../db/dbhelper.php';
header("Content-Type: application/json");
$userid = hashString(urldecode($_GET['email']));

echo json_encode(getSurveyListForUser($userid));

?>
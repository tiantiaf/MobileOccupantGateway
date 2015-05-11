<?

include '../db/dbhelper.php';

$tableName = $_GET['tablename'];
$result = exportToCSV($tableName);

$filename = $tableName . "_" . time();

header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filename.'.csv"');

print_r("$result");
?>
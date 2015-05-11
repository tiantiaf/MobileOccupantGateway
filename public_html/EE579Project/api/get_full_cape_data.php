<?php
        include '../db/dbhelper.php';
        header('Content-Type: application/json');
        
        $result = fetchFullTempHum();
        echo json_encode($result);
        
?>
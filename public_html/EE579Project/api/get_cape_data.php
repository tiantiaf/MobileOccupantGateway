<?php
        include '../db/dbhelper.php';
        header('Content-Type: application/json');
        
        $startdate = $_GET['startdate'];
        $enddate = $_GET['enddate'];

        if ($startdate != '' && $enddate != '') {

             $result = fetchTempHum($startdate, $enddate);
             echo json_encode($result);

        } else {
             $result = fetchALLTempHum();
             echo json_encode($result);
        }


        


?>
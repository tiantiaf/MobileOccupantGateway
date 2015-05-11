<?php
	include '../db/dbhelper.php';
	header('Content-Type: application/json');

        //Get the login information
        $username = urldecode($_GET['username']);
        $password = urldecode($_GET['password']);


        $result = fetchUser($username, $password);

        echo json_encode($result);	


?>
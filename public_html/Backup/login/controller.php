<?php
	$auth = FALSE;
	$authMessage = "";
	
	if($_POST['username'] && $_POST['password']){
		$uname = $_POST['username'];
		$pass = $_POST['password'];
			
		if((strcasecmp($uname, "admin") == 0) && (strcasecmp($pass, "admin123!") == 0)){
			$auth = TRUE;
		}else{
			$auth = FALSE;
			$authMessage = 'Credentials doesnt match: ';
		}
	}else{
		$auth = FALSE;
		$authMessage = 'ERROR: Credentials Missing';
	}
	
	if($auth == TRUE){
		header('Location: ../manage/manage.php');
	}else{
		header('Location: failure.php?msg='.$authMessage);
	}
	
?>

< html>
< head>
< meta http-equiv="refresh" content="1; url=< ?php echo "manage.php"; ?>">
< /head>
< body>
Login Successful
< /body>
< /html>


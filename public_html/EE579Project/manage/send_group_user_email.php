<?php
	include '../db/dbhelper.php';
	require("phpmailer/class.phpmailer.php");
	$group_name = $_POST['send_group_type'];
	//$group_name = "usc_ee";
	$result = array();
	
	$result = retrieveUnregisteredEmail($group_name);
	echo "hello" ;
        //echo $group_name;
	foreach ($result['data'] as $send) {
		
		$name =  $send['email_id'];
		smtp_mail($name, "Welcome to participate in Mobile Survey Research!", "NULL", "yourdomain.com", "tiantian");    
		
	}
	
	header('Location: recruite.php?status=1&msg=' . $result['message']);

function smtp_mail( $sendto_email, $subject, $body, $extra_hdrs, $user_name){    
   $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "box965.bluehost.com";   // SMTP servers
    $mail->SMTPSecure = "ssl";
    $mail->SMTPAuth = true;           // turn on SMTP authentication    
    $mail->Username = "manager@building-occupant-gateway.com";
    $mail->Password = "Mobile2014Occupant!";
    $mail->From = "manager@building-occupant-gateway.com";
    $mail->FromName =  "Mobile Survey Manager";
  
    $mail->Port       = 465;
    $mail->CharSet = "GB2312";  
    $mail->Encoding = "base64";
    $mail->AddAddress($sendto_email,"Tiantian");
    $mail->AddReplyTo("manager@building-occupant-gateway.com","smtp.bluehost.com");    
      
    $mail->IsHTML(true);    
    
    $mail->Subject = $subject;    
    
    $mail->Body = "   
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">   

</head>   
<body>   
Please Download the Application in the Google Play Store: https://play.google.com/store.<br /> <br />
We appreciate your participation!<br /> <br />

This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.
</body>   
</html>   
";                                                                          
    $mail->AltBody ="text/html";
    $mail->Send();
    
}
?>
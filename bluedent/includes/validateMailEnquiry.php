<?php
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function validateMailEnquiry($eid,$ename,$ephone,$eemail,$eenquiry)
	{
		  $message = "<html><body><table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #142333; \"><tr><th colspan=\"2\" style=\"background-color: #142333;\"><img src=\"http://www.bluedentindia.in/logos/Bluedent.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #46607c; color: #fff;\">ENQUIRY ID: $eid</th></tr><tr><td><b>NAME:</b></td><td>$ename</td></tr><tr><td><b>PHONE:</b></td><td>$ephone</td></tr><tr><td><b>EMAIL:</b></td><td>$eemail</td></tr><tr><td><b>ENQUIRY:</b></td><td>$eenquiry</td></tr></table></body></html>"; 
		  $subject = "Bluedent India Enquiry";
		  $to = "bluedentindia@gmail.com";
		  $name = $ename;
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $subject			= "Bluedent India Enquiry";
		  		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 465;
		  $mail->Username   = "";
	      $mail->Password   = "";
		  $mail->SMTPSecure = 'ssl';
		  $mail->SetFrom($eemail, $ename);
		  $mail->AddReplyTo($eemail, $ename);
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Bluedent India Enquiry";
		  $mail->MsgHTML($body);
		  $address = $to;
		  $mail->AddAddress($to, $ename);
		  if(!$mail->Send()) {
			return 0;
		  }
		  else{
			return 1;
		 }
	}
?>

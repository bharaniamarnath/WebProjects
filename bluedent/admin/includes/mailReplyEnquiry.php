<?php
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function mailReplyEnquiry($eemail,$esubject,$eenquiry)
	{
		  $message = "<html><body><table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #142333; \"><tr><th colspan=\"2\" style=\"background-color: #142333;\"><img src=\"http://www.bluedentindia.in/logos/bluedent.png \" width=\"250\" /></th></tr><tr><th colspan=\"2\" style=\"background-color: #46607c; color: #fff;\">Bluedent India - Enquiry Reply</th></tr><tr><td colspan='2'>$eenquiry</td></tr></table></body></html>"; 
		  $subject = "Bluedent India - Enquiry Reply";
		  $to = $eemail;
		  $name = $ename;
		  $efrom = "bluedentindia@gmail.com";
		  $ename = "Bluedent India";
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $subject			= $esubject;
		  $mail->IsSMTP();
		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 465;
		  $mail->Username   = "";
	          $mail->Password   = "";
		  $mail->SMTPSecure = 'ssl';
		  $mail->SetFrom($efrom, $ename);
		  $mail->AddReplyTo($efrom, $ename);
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Bluedent India - Enquiry Reply";
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

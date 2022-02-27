<?php
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function sendEnquiry($ename,$email,$enquiry)
	{
		  $to = "cephilo@gmail.com";
		  $name = $ename;
		  $subject = "Lumibella Fashions Enquiry Detail";
		  $mail             = new PHPMailer();
		  $body             = $enquiry;
		  $mail->IsSMTP();
		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 587;
		  $mail->Username   = "info.lumibella@gmail.com";
		  $mail->Password   = "lumibella@88";
		  $mail->SMTPSecure = 'tls';
		  $mail->SetFrom($email, $ename);
		  $mail->AddReplyTo($email,$ename);
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Lumibella Fashions Enquiry";
		  $mail->MsgHTML($body);
		  $address = $to;
		  $mail->AddAddress($address, $name);
		  if(!$mail->Send()) {
			return 0;
		  }
		  else{
			return 1;
		 }
	}
?>
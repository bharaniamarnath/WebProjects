<?php
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function sendmail($to,$subject,$message,$name)
	{
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $mail->IsSMTP();
		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 587;
		  $mail->Username   = "";
		  $mail->Password   = "";
		  $mail->SMTPSecure = 'tls';
		  $mail->SetFrom('', 'Lumibella Fashions');
		  $mail->AddReplyTo("","Lumibella Fashions");
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Lumibella Fashions Account Activation";
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

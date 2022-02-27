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
		  $mail->Username   = "info.lumibella@gmail.com";
		  $mail->Password   = "lumibella@88";
		  $mail->SMTPSecure = 'tls';
		  $mail->SetFrom('info.lumibella@gmail.com', 'Lumibella Fashions');
		  $mail->AddReplyTo("info.lumibella@gmail.com","Lumibella Fashions");
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
<?php
	include("connect.php");
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function validateMailOrder($oid,$cid,$goemail,$goname)
	{
		  $message = "<html><body><table style='border:1px solid #420340;'><tr><thead><th style='background-color:#420340;padding:10px;'><img src='images/logo/lumibella.png' style='width:300px;' /></th></thead></tr><tr><td style='color:#420340;padding:10px;font-size: 16px;'>Hello " . $goname . ", You have received this message as you have placed an purchase order through our website recently. You can find the details of your purchase order from the given link below. Thank you for purchasing at Lumibella Fashions. For more details login to your Lumibella website account or contact us. Your order ID is LBO" . $oid . ", Your customer ID is LBC" . $cid . ".</td></tr><tr><thead><th><a style='color:#420340;text-decoration:underlined;padding:20px;text-align:center;' href='http://localhost/lumibella/viewpurchase.php?viewpid=$oid'>CLICK HERE TO VIEW PURCHASE ORDER DETAILS</a></th></thead></tr><tr><td style='font-size:12px;background-color:#420340;color:#ffffff;padding:10px;'>Copyrights 2015. Lumibella Fashions. No.1, 1st Street, Velachery, Chennai - 600062 <a style='color:#ffe900;text-decoration:none;' href='www.lumibellastore.com'>www.lumibellastore.com</a></td></tr></table></body></html>"; 
		  $subject = "Lumibella Fashions. Purchase Order Detail";
		  $to = $goemail;
		  $name = $goname;
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $subject			= "Lumibella Fashions Purchase Order Detail";
		  $mail->IsSMTP();
		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 587;
		  $mail->Username   = "info.lumibella@gmail.com";
	      $mail->Password   = "lumibella@88";
		  $mail->SMTPSecure = 'tls';
		  $mail->SetFrom('lumibellastore@gmail.com', 'Lumibella Fashions');
		  $mail->AddReplyTo('lumibellastore@gmail.com', 'Lumibella Fashions');
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Lumibella Fashions Purchase Order Detail";
		  $mail->MsgHTML($body);
		  $address = $to;
		  $mail->AddAddress($goemail, $goname);
		  if(!$mail->Send()) {
			return 0;
		  }
		  else{
			return 1;
		 }
	}
?>
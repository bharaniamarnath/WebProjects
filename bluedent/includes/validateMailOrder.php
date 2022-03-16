<?php
	include("connect.php");
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function validateMailOrder($oid,$cid,$goemail,$goname,$goprolist)
	{
		  $message = "<html><body><table style='border:1px solid #142333;'><tr><thead><th style='background-color:#142333;padding:10px;'><img src='images/logo/bluedent.png' style='width:300px;' /></th></thead></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'>Hello " . $goname . ", You have received this message as you have placed an purchase order through our website recently. You can find the details of your purchase order from the given link below. Thank you for purchasing at Bluedent India. For more details, contact us. Your order ID is BDI" . $oid . ", Your customer ID is " . $cid . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'>Products Ordered: <br><br>" . $goprolist . "</td></tr><tr><thead><th><a style='color:#142333;text-decoration:underlined;padding:20px;text-align:center;' href='http://www.bluedentindia.in/invoice.php?viewpid=$oid'>CLICK HERE TO VIEW PURCHASE ORDER DETAILS</a></th></thead></tr><tr><td style='font-size:12px;background-color:#142333;color:#ffffff;padding:10px;'>Copyrights " . date('Y') . ". Bluedent India. No.16, Sree Ganesh Flats, 3rd Cross Street, Hindu Colony, Ullagaram, Chennai-600 091. TamilNadu, India. <a style='color:#f7a40a;text-decoration:none;' href='www.bluedentindia.in'>www.bluedentindia.in</a></td></tr></table></body></html>"; 
		  $subject = "Bluedent India. Order Details";
		  $to = $goemail;
		  $name = $goname;
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $subject			= "Bluedent India Order Details";
		  $mail->IsSMTP();
		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 465;
		  $mail->Username   = "";
	          $mail->Password   = "";
		  $mail->SMTPSecure = 'ssl';
		  $mail->SetFrom('bludentindia@gmail.com', 'Bluedent India');
		  $mail->AddReplyTo('bluedentindia@gmail.com', 'Bluedent India');
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Bluedent India Order Details";
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

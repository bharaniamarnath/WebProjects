<?php
	include("connect.php");
    require_once('class.phpmailer.php');
    require_once('PHPMailerAutoload.php');
	function mailOrderAdmin($oid,$cid,$bdiaemail,$goemail,$goname,$goprolist,$gophone,$goaddress)
	{
		  $message = "<html><body><table style='border:1px solid #142333;'><tr><thead><th style='background-color:#142333;padding:10px;'><img src='http://www.bluedentindia.in/logos/Bluedent.png' style='width:300px;' /></th></thead></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'>Order ID: BDI" . $oid . "</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'> Customer ID: " . $cid . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'> Customer Name: " . $goname . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'> Phone: " . $gophone . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'> Email: " . $goemail . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'> Address: " . $goaddress . ".</td></tr><tr><td style='color:#142333;padding:10px;font-size: 16px;'>Products Ordered: <br><br>" . $goprolist . "</td></tr><tr><thead><th><a style='color:#142333;text-decoration:underlined;padding:20px;text-align:center;' href='http://www.bluedentindia.in/invoice.php?viewpid=$oid'>CLICK HERE TO VIEW ORDER DETAILS</a></th></thead></tr><tr><td style='font-size:12px;background-color:#142333;color:#ffffff;padding:10px;'>Copyrights " . date('Y') . ". Bluedent India. No.16, Sree Ganesh Flats, 3rd Cross Street, Hindu Colony, Ullagaram, Chennai-600 091. TamilNadu, India. <a style='color:#f7a40a;text-decoration:none;' href='www.bluedentindia.in'>www.bluedentindia.in</a></td></tr></table></body></html>"; 
		  $subject = "Bluedent India. Order Details";
		  $to = $bdiaemail;
		  $name = $goname;
		  $mail             = new PHPMailer();
		  $body             = $message;
		  $subject			= "Bluedent India Order Details";
		  		  $mail->SMTPAuth   = true;
		  $mail->Host       = "smtp.gmail.com";
		  $mail->Port       = 465;
		  $mail->Username   = "mailer.bluedentindia@gmail.com";
	      $mail->Password   = "b1u3d3ntindi@";
		  $mail->SMTPSecure = 'ssl';
		  $mail->SetFrom($goemail, $goname);
		  $mail->AddReplyTo($goemail, $goname);
		  $mail->Subject    = $subject;
		  $mail->AltBody    = "Bluedent India Order Details";
		  $mail->MsgHTML($body);
		  $address = $to;
		  $mail->AddAddress($bdiaemail, $goname);
		  if(!$mail->Send()) {
			return 0;
		  }
		  else{
			return 1;
		 }
	}
?>
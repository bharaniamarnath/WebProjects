<?php
class validateShippingDetail{
	private $shipIDErr, $shippingAddSuccess, $shippingAddFailed;
	
	public function validateShippingID($shippingid){
		if($shippingid == ''){
			$this->shipIDErr = "Shipping ID is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z0-9' ]*$#", $shippingid)){
			$this->shipIDErr = "Special characters not allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checkShippingID($shippingid){
		include('connect.php');
		$checkshipid = $pdo->prepare("SELECT * FROM shipping WHERE shippingid=:shippingid");
		$checkshipid->execute(array(
							"shippingid"=>$shippingid
							));
		if($checkshipid->rowCount() > 0){
			$this->shipIDErr = "Shipping ID already exists";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function addShippingDetail($shippingid, $shipperid, $shiporderid){
		include('connect.php');
		$addshippingdetail = $pdo->prepare("INSERT INTO shipping (shippingid, shipperid, orderid) VALUES (:shippingid, :shipperid, :orderid)");
		$addshippingdetail->execute(array(
									"shippingid"=>$shippingid,
									"shipperid"=>$shipperid,
									"orderid"=>$shiporderid
									));
		if($addshippingdetail){
			$this->shippingAddSuccess = "Shipping ID detail added";
			return true;
		}
		else{
			$this->shippingAddFailed = "Failed to add shipping ID";
			return false;
		}
	}
	
	public function mailShippingDetail($shippingid, $shipperid, $shiporderid, $shipordermail){
	  include('connect.php');
	  require_once('class.phpmailer.php');
	  require_once('PHPMailerAutoload.php');
	  $shipperdetail = $pdo->prepare("SELECT * FROM shippers WHERE shipperid=:shipperid");
	  $shipperdetail->execute(array("shipperid"=>$shipperid));
	  $sdrow = $shipperdetail->fetch();
	  $sdname = $sdrow['shippername'];
	  $sdaddress = $sdrow['address'];
	  $sdwebsite = $sdrow['website'];
	  $sdemail = $sdrow['email'];
	  $sdcontact = $sdrow['contact'];
	  $name = "Lumibella Shipping Details";
	  $message = "<html><body><table style='border:1px solid #420340;'><tr><thead><th style='background-color:#420340;padding:10px;'><img src='images/logo/lumibella.png' style='width:300px;' /></th></thead></tr><tr><td style='color:#420340;padding:10px;font-size: 16px;'>Dear Customer, You have received this email because you have made an online purchase order at Lumibella Stores.<br />Your order has been shipped and will be delivered to you shortly. Your order shipping detail is:<br />Shipping ID: " . $shippingid . "<br />Order ID: " . $shiporderid . "</td></tr><tr><td style='color:#420340;padding:10px;font-size: 16px;'><b>Shipper Details:</b><br />Name: " . $sdname . "<br />Address: " . $sdaddress . "<br />Contact: " . $sdcontact . "<br />Email: " . $sdemail . "<br />Website: <a href='$sdwebsite'>Visit " . $sdname . " Website</a></td></tr><tr><thead><th><a style='color:#420340;text-decoration:underlined;padding:20px;text-align:center;' href='http://localhost/lumibella/viewpurchase.php?viewpid=$shiporderid'>CLICK HERE TO VIEW PURCHASE ORDER DETAILS</a></th></thead></tr><tr><td style='font-size:12px;background-color:#420340;color:#ffffff;padding:10px;'>Copyrights 2015. Lumibella Fashions. No.1, 1st Street, Velachery, Chennai - 600062 <a style='color:#ffe900;text-decoration:none;' href='www.lumibellastore.com'>www.lumibellastore.com</a></td></tr></table></body></html>";
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
	  $mail->Subject    = "Lumibella Shipping Detail";
	  $mail->AltBody    = "Lumibella Shipping Details";
	  $mail->MsgHTML($body);
	  $address = $shipordermail;
	  $mail->AddAddress($address, $name);
	  if(!$mail->Send()) {
		return 0;
	  }
	  else{
		return 1;
	 }
	}
	
	//Errors and Exceptions
	
	public function shipIDError(){
		return $this->shipIDErr;
	}
	
	public function shippingAddSuccess(){
		return $this->shippingAddSuccess;
	}
	
	public function shippingAddFailed(){
		return $this->shippingAddFailed;
	}
	
}
?>

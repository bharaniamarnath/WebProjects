<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include("includes/validateMailOrder.php");
include("includes/mailOrderAdmin.php");
if(!isset($_SESSION['order'])){
header('Location: expired.php');
exit();
}
$cid = $_SESSION['order'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="bluedent india, bluedent chennai, rediscover dentistry" />
<meta name="description" content="Welcome to Bluedent India. Rediscover Dentistry.">
<meta name="copyright" content="&copy; Copyright 2014. Bluedent India. All rights reserved.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="<?php echo $BASE_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Order Confirmation</h2></div></div>
<?php
if(isset($_REQUEST['id'])){
$oid = $_REQUEST['id'];
$genoid = "BDI" . $oid;
if(!isset($_SESSION['cart'])){
header("Location: mycart.php");
}
echo "<div class='col-md-12 col-lg-12 order-placed'><img class='img-responsive' src='images/contents/order-placed.png' /><h3>Your order has been placed and confirmed.</h3> <h5>Contact us for more details. Thank you for purchasing at Bluedent India.</h5></div>";
echo "<table class='table cart'>";
echo "<tr><thead><th colspan='2'>Order Summary</th></thead></tr>";

$getdate = $pdo->prepare("SELECT date FROM orders WHERE oid=:oid");
$getdate->execute(array("oid"=>$oid));
$gdfetch = $getdate->fetch();
$gdate = date('F/j/Y',strtotime($gdfetch['date']));
echo "<tr><td>Order ID:</td><td>" . $genoid . "</td></tr>";
echo "<tr><td>Payment Method:</td><td>CASH ON DELIVERY</td></tr>";
echo "<tr><td>Delivery Time:</td><td>VARIABLE DAYS</td></tr>";
echo "<tr><td>Order Date:</td><td>" . $gdate ."</td></tr>";
echo "</table>";

echo "<h4 class='checkout-heading'>Product Summary</h4>";
$prolistmail = "";
$getod = $pdo->prepare("SELECT * FROM orders WHERE oid=:oid");
$getod->execute(array(
				"oid"=>$oid
				));
echo "<table class='table cart'>";
echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th></thead></tr>";
while($godet = $getod->fetch()){
$proid = $godet['pid'];
$qnty = $godet['quantity'];
$getproname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
$getproname->execute(array("id"=>$proid));
while($gnrow = $getproname->fetch()){
$pthumb = $gnrow['image'];
$pname = $gnrow['name'];
echo "<tr><td class='table-image'><img class='img-responsive cart-image' src='".$BASE_URL.$pthumb."' /></td><td>" . $pname . "</td><td>" . $qnty . "</td></tr>";
$prolistmail .= $pname . " - " . $qnty . "<br>";
}
}
echo "</table>";

echo "<h4 class='checkout-heading'>Delivery Address &amp; Contact Details</h4>";
$orderaddr = $pdo->prepare("SELECT * FROM delivery WHERE oid=:doid");
$orderaddr->execute(array("doid"=>$oid));
$goaddr = $orderaddr->fetch();
$goname = $goaddr['name'];
$goaddress = $goaddr['address'];
$gophone = $goaddr['phone'];
$goemail = $goaddr['email'];
$gopincode = $goaddr['pincode'];
echo "<table class='table cart'>";
echo "<tr><td>Customer Name:</td><td>" . $goname ."</tr>";
echo "<tr><td>Delivery Address:</td><td>" . $goaddress ."</tr>";
echo "<tr><td>Contact Phone/Mobile:</td><td>" . $gophone ."</tr>";
echo "<tr><td>Contact Email:</td><td>" . $goemail ."</tr>";
echo "<tr><td>Location Pincode:</td><td>" . $gopincode ."</tr>";
echo "</table>";
$cid = $_SESSION['order'];
$checkcms = $pdo->prepare("SELECT * FROM delivery WHERE cid=:cid");
$checkcms->execute(array("cid"=>$cid));
$cmsrow = $checkcms->fetch();
if($cmsrow['cmstatus'] == 0){
$cmstatus = 1;
$updatecms = $pdo->prepare("UPDATE orders SET cmstatus=:cmstatus WHERE oid=:oid");
$updatecms->execute(array("cmstatus"=>$cmstatus,"oid"=>$oid));
$bdiaemail = "bluedentindia@gmail.com";
validateMailOrder($oid,$cid,$goemail,$goname,$prolistmail);
mailOrderAdmin($oid,$cid,$bdiaemail,$goemail,$goname,$prolistmail,$gophone,$goaddress);
echo "<table class='table cart'>";
echo "<tr><thead><th>Confirmation mail status</th></thead></tr>";
echo "<tr><td>A confirmation email has been sent to your email provided in your delivery address detail. Please contact us for more details";
echo "</table>";
}
else{
echo "<table class='table cart'>";
echo "<tr><thead><th>Confirmation mail status</th></thead></tr>";
echo "<tr><td>Sorry, There was a problem sending confirmation email for this order to your email. Please contact us for more details";
echo "</table>";
}
unset($_SESSION['cart']);
}
?>
<?php include("footer.php"); ?>
</div>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>
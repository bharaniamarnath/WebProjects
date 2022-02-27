<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('cart.php');
include('includes/orderValidate.php');
include('includes/orderFinalizer.php');
include('includes/sendMail.php');
if(!isset($_SESSION['order'])){
header('Location: expired.php');
exit();
}
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

<div class='row page-title'><div class='col-md-12'><h2>Checkout</h2></div></div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<h4 class="checkout-heading">Cart Details</h4>
<?php
//Assign Error Message Variables
$nameError = '';
$emailError = '';
$phoneError = '';
$addressError = '';
$pincodeError = '';
$orderStatus = 'Fill the information below and click Place Order. Your order will be verified and confirmed after processing.';
$displayForm = 0;
if(isset($_REQUEST['order'])){
//Fetch values from HTML form
$cname = trim($_REQUEST['dname']);
$cemail = trim($_REQUEST['demail']);
$cphone = trim($_REQUEST['dphone']);
$caddress = trim($_REQUEST['daddr']);
$cpincode = trim($_REQUEST['dpin']);
//Create Class Object and Pass Parameters
$orderValidate = new orderValidate();
$checkName = $orderValidate->validateName($cname);
$checkEmail = $orderValidate->validateEmail($cemail);
$checkPhone = $orderValidate->validatePhone($cphone);
$checkAddress = $orderValidate->validateAddress($caddress);
$checkPincode = $orderValidate->validatePincode($cpincode);
//Throw Exceptions
if($checkName == false){
$nameError = $orderValidate->nameError();
}
if($checkEmail == false){
$emailError = $orderValidate->emailError();
}
if($checkPhone == false){
$phoneError = $orderValidate->phoneError();
}
if($checkAddress == false){
$addressError = $orderValidate->addressError();
}
if($checkPincode == false){
$pincodeError = $orderValidate->pincodeError();
}
//Throw Register Exception
if($checkName !== false && $checkEmail !== false && $checkPhone !== false && $checkAddress !== false && $checkPincode !== false){
$coid = rand(100000,999999);
$csid = $_SESSION['order'];
$orderFinalizer = new orderFinalizer();
$placeOrderDetails = $orderFinalizer->placeOrderDetails($coid);
if($placeOrderDetails == false){
$orderStatus = $orderFinalizer->orderError();
$displayForm = 1;
}
else{
$placeOrderDelivery = $orderFinalizer->placeOrderDelivery($coid,$csid,$cname,$cemail,$cphone,$caddress,$cpincode);
if($placeOrderDelivery == false){
$orderStatus = $orderFinalizer->orderError();
}
else{
header("Location: order.php?id=$coid");
}
}
}
else{
$orderStatus = "<b>Error in registration. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}
}
?>
<?php
if(isset($_POST['clearcart'])){
unset($_SESSION['cart']);
}
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
	echo "<div class='empty-stock-alert'><img class='img-responsive' src='".$BASE_URL."images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. All the products in your cart were sold out during the check out process. We will notify you when the products you have missed are available. Contact us for more details</h4></div>";
}
else{
	$max = count($_SESSION['cart']);
	echo "<table class='table cart'>";
	echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th></thead></tr>";
	for($i=0;$i<$max;$i++){
		$_SESSION['cart'] = array_values($_SESSION['cart']);
		$pid = $_SESSION['cart'][$i]['pid'];
		$pqty = $_SESSION['cart'][$i]['pq'];
		$getname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
		$getname->execute(array("id"=>$pid));
		$gnrow = $getname->fetch();
		$pname = $gnrow['name'];
		$pthumb = $gnrow['image'];
		echo "<tr><td class='table-image'><img class='img-responsive cart-image' src='" . $BASE_URL . $pthumb . "' /></td>";
		echo "<td>" . $pname . "</td>";
		echo "<td>" . $pqty . "</td>";
		echo "</tr>";		
	}
	if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		echo "<div class='empty-stock-alert'><img class='img-responsive' src='".$BASE_URL."images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. Contact us for more details</h4></div>";
	}
	echo "<tr><td>Payment Method: </td><td colspan='4' id='checkout-detail'>CASH ON DELIVERY</td></tr>";
	echo "<tr><td>Delivery Time: </td><td colspan='4' id='checkout-detail'>VARIABLE DAYS</td></tr>";
echo "</table>";
if($displayForm == 0){
$custid = $_SESSION['order'];
echo "<h4 class='checkout-heading'>Delivery Address Details</h4>";
echo "<div class='orderRegister'><div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" . $orderStatus . "</div></div>";
echo "<div class='col-md-7 col-lg-7'>";
echo "<form id='checkoutForm' action='checkout.php' method='POST'>";
echo "<div class='form-group'><label for='dname'>Full Name</label><input type='text' name='dname' id='dname' class='form-control' maxlength='25' /><span class='exception'>". $nameError . "</span></div>";
echo "<div class='form-group'><label for='demail'>Email ID</label><input type='text' name='demail' id='demail' class='form-control' maxlength='50' /><span class='exception'>". $emailError . "</span></div>"; 
echo "<div class='form-group'><label for='dphone'>Contact Mobile</label><input type='text' name='dphone' id='dphone' class='form-control' maxlength='10' /><span class='exception'>". $phoneError . "</span></div>"; 
echo "<div class='form-group'><label for='daddr'>Delivery Address</label><textarea name='daddr' id='daddr' class='form-control' maxlength='1024'></textarea></td><span class='exception'>". $addressError . "</span></div>"; 
echo "<div class='form-group'><label for='dpin'>Location Pincode</label><input type='text' name='dpin' id='dpin' class='form-control' /><span class='exception'>". $pincodeError . "</span></div>";
echo "<input class='btn btn-success btn-lg btn-block' type='submit' value='Place Order' name='order' id='order' />";
echo "</form>";
echo "</div>";
}
else{
echo "<a class='btn btn-primary pull-right' href='".$BASE_URL."mycart.php'>Go to My Cart</a>";
}
}
?>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/validateCheckout.js"></script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>
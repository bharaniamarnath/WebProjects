<?php
ob_start();
session_start();
include('connect.php');
include('cart.php');
include('includes/validateStock.php');
include('includes/orderValidate.php');
include('includes/orderFinalizer.php');
include('includes/sendMail.php');
if(!isset($_SESSION['customer'])){
header("Location: customer.php?location=".urlencode($_SERVER['REQUEST_URI']));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Fashions</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">My Cart</h4>
<hr>
<div class="col-md-12 col-lg-12">
<h4 class="checkout-heading">Cart Purchase Details</h4>
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
$validateStock = new validateStock();
$checkStockValidate = $validateStock->checkStockValidate();
if($checkStockValidate == false){
	$orderStatus = $validateStock->stockError();
}
else{
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
$coid = rand(111111,999999);
$csid = $_SESSION['customer'];
$orderFinalizer = new orderFinalizer();
$placeOrderDetails = $orderFinalizer->placeOrderDetails($coid);
if($placeOrderDetails['count'] == 0){
$orderStatus = $orderFinalizer->orderError();
$displayForm = 1;
}
else{
$placeOrderDelivery = $orderFinalizer->placeOrderDelivery($coid,$csid,$cname,$cemail,$cphone,$caddress,$cpincode);
$placeOrder = $orderFinalizer->placeOrder($coid,$csid);
if($placeOrder == false){
$orderStatus = $orderFinalizer->orderError();
}
else if($placeOrderDelivery == false){
$orderStatus = $orderFinalizer->orderError();
}
else{
$cancelledItems = $orderFinalizer->cancelledItems();
$cancelledCount = $orderFinalizer->cancelledCount();
$getItemsCount = $placeOrderDetails['count'];
$removedItems = $validateStock->removedItems();
$cancelled = $cancelledItems . '' . $removedItems;
header("Location: order.php?id=$coid&ci=$cancelled&ic=$getItemsCount&c=$cancelledItems&r=$removedItems&cc=$cancelledCount");
}
}
}
else{
$orderStatus = "<b>Error in registration. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}
}
}
?>
<?php
if(isset($_POST['clearcart'])){
unset($_SESSION['cart']);
}
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
	echo "<div class='empty-stock-alert'><img class='img-responsive' src='images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. All the products in your cart were sold out during the check out process. We will notify you when the products you have missed are available. Contact us for more details</h4></div>";
}
else{
	$max = count($_SESSION['cart']);
	echo "<table class='table cart-table'>";
	echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th><th>Price</th><th>Total Price</th></thead></tr>";
	for($i=0;$i<$max;$i++){
		$_SESSION['cart'] = array_values($_SESSION['cart']);
		$pid = $_SESSION['cart'][$i]['pid'];
		$pqty = $_SESSION['cart'][$i]['pq'];
		$getname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
		$getname->execute(array("id"=>$pid));
		$gnrow = $getname->fetch();
		$pname = $gnrow['pname'];
		$price = $gnrow['pprice'];
		$pthumb = $gnrow['pthumb'];
		$getstockval = $pdo->prepare("SELECT * FROM stocks WHERE pid=:pid");
		$getstockval->execute(array("pid"=>$pid));
		$gsvrow = $getstockval->fetch();
		$gsvstock = $gsvrow['quantity'];
		echo "<tr><td><img class='img-responsive cart-image' src='" . $pthumb . "' /></td>";
		echo "<td>" . $pname . "</td>";
		if($gsvstock == 0){
			$pqty = 0;
			echo "<td>Out of stock</td>";
			removecart($pid);
		}
		else{
			echo "<td>" . $pqty . "</td>";
		}
		$tprice = number_format((float)($price * $pqty),2,'.','');
		echo "<td>Rs." . $price . "</td><td>Rs." . $tprice . "</td>";
		echo "</tr>";		
	}
	$sum=0;
	if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		echo "<div class='empty-stock-alert'><img class='img-responsive' src='images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. All the products in your cart were sold out during the check out process. We will notify you when the products you have missed are available. Contact us for more details</h4></div>";
	}
	else{
		for($i=0;$i<$max;$i++){
			$_SESSION['cart'] = array_values($_SESSION['cart']);
			$tpid = $_SESSION['cart'][$i]['pid'];
			$tpq = $_SESSION['cart'][$i]['pq'];
			$getprice = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
			$getprice->execute(array("id"=>$tpid));
			$gtrow = $getprice->fetch();
			$totalprice = $gtrow['pprice'];
			$getstockvaltotal = $pdo->prepare("SELECT * FROM stocks WHERE pid=:pid");
			$getstockvaltotal->execute(array("pid"=>$tpid));
			$gsvtrow = $getstockvaltotal->fetch();
			$gsvtstock = $gsvtrow['quantity'];
			if($gsvstock == 0){
				$tpq = 0;
			}
			$sum += $totalprice * $tpq;
		}
		if($sum == 0){
			echo "<div class='empty-stock-alert'><img class='img-responsive' src='images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. All the products in your cart were sold out during the check out process. We will notify you when the products you have missed are available. Contact us for more details</h4></div>";
		}
		else{
			$tamount = number_format((float)$sum,2,'.','');
			echo "<tr><td colspan='3'></td><td id='tamount'>Total Amount</td><td id='tamount'>Rs." . $tamount . "</td>";
			echo "<tr><td>Payment Method: </td><td colspan='4' id='checkout-detail'>CASH ON DELIVERY</td></tr>";
			echo "<tr><td>Delivery Time: </td><td colspan='4' id='checkout-detail'>WITHIN 5 WORKING DAYS</td></tr>";
		}
	}
echo "</table>";
if($displayForm == 0){
$custid = $_SESSION['customer'];
$getcdetail = $pdo->prepare("SELECT * FROM customers WHERE cid=:id");
$getcdetail->execute(array("id"=>$custid));
$gcd = $getcdetail->fetch();
$gcdname = $gcd['cname'];
$gcdmail = $gcd['cemail'];
$gcdphone = $gcd['cphone'];
$gcdaddr = $gcd['caddress'];
$gcdpin = $gcd['cpincode'];
echo "<h4 class='checkout-heading'>Delivery Address Details</h4>";
echo "<div class='orderRegister'><div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>" . $orderStatus . "</div></div>";
echo "<div class='col-md-7 col-lg-7'>";
echo "<form action='checkout.php' method='POST'>";
echo "<div class='form-group'><label for='dname'>Full Name</label><input type='text' name='dname' id='dname' value='" . $gcdname . "' class='form-control' maxlength='25' /><span class='exception'>". $nameError . "</span></div>";
echo "<div class='form-group'><label for='demail'>Email ID</label><input type='text' name='demail' id='demail' value='" . $gcdmail . "' class='form-control' maxlength='50' /><span class='exception'>". $emailError . "</span></div>"; 
echo "<div class='form-group'><label for='dphone'>Contact Mobile</label><div class='input-group'><span class='input-group-addon'>+91</span><input type='text' name='dphone' id='dphone' value='" . $gcdphone . "' class='form-control' maxlength='10' /></div><span class='exception'>". $phoneError . "</span></div>"; 
echo "<div class='form-group'><label for='daddr'>Delivery Address</label><textarea name='daddr' id='daddr' class='form-control' maxlength='1024'>" . $gcdaddr . "</textarea></td><td class='exception'>". $addressError . "</span></div>"; 
echo "<div class='form-group'><label for='dpin'>Location Pincode</label><input type='text' name='dpin' id='dpin' value='" . $gcdpin . "' class='form-control' /><span class='exception'>". $pincodeError . "</span></div>";
echo "<input class='btn btn-primary btn-lg pull-right' type='submit' value='Place Order' name='order' id='order' />";
echo "</form>";
echo "</div>";
}
else{
echo "<a class='btn btn-primary pull-right' href='mycart.php'>Go to My Cart</a>";
}
}
?>

</div>
</div>
<!-- Modal Loader Begin /-->
<div id="checkOutModal" class="modal fade slow" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h3><span><img class="img-responsive pull-left modalLogo" src="images/logo/logo.png" /></span> Lumibella Fashions</h3>
</div>
<div class="modal-body">
<img class="img-responsive" src="images/contents/loader.gif" alt="loader" />
<p>Please wait while we validate your checkout process...</p>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Loader End /-->
<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#order').click(function(){
  $('#checkOutModal').modal('show');
})
});
$(document).keydown(function(e) {
    if(e.keyCode == 27){
		return false;
	}
});
</script>
</body>
</html>
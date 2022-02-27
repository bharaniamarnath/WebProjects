<?php
ob_start();
session_start();
include("connect.php");
include("includes/validateMailOrder.php");
if(!isset($_SESSION['customer'])){
header("Location: customer.php");
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
<h4 class="heading">My Order</h4>
<hr>
<div class="col-md-12 col-lg-12">
<?php
if(isset($_REQUEST['id'])){
$oid = $_REQUEST['id'];
$genoid = "LBO" . $oid;
$ia = $_REQUEST['ic'];
if(!isset($_SESSION['cart'])){
header("Location: mycart.php");
}
echo "<div class='order-placed'><img class='img-responsive' src='images/contents/order-placed.png' /><h3>Your order has been placed and confirmed.</h3> <h5>Contact us for more details. Thank you for purchasing at Lumibella Fashions.</h5></div>";
echo "<table class='table cart-table'>";
echo "<tr><thead><th colspan='2'>Order Summary</th></thead></tr>";
$getamount = $pdo->prepare("SELECT SUM(price) AS tamount, SUM(quantity) AS tqnty FROM orderdetail WHERE orderid=:aoid");
$getamount->execute(array("aoid"=>$oid));
$gares = $getamount->fetch();
$tamount = $gares['tamount'];
$tqnty = $gares['tqnty'];

$getdate = $pdo->prepare("SELECT added FROM orders WHERE orderid=:oid");
$getdate->execute(array("oid"=>$oid));
$gdfetch = $getdate->fetch();
$gdate = date('F/j/Y',strtotime($gdfetch['added']));
echo "<tr><td>Order ID:</td><td>" . $genoid . "</td></tr>";
echo "<tr><td>Total Quantity Products:</td><td>" . $tqnty . "</td></tr>";
echo "<tr><td>Total Cash Amount Payable:</td><td>Rs. " . $tamount . "</td></tr>";
echo "<tr><td>Payment Method:</td><td>CASH ON DELIVERY</td></tr>";
echo "<tr><td>Delivery Time:</td><td>Within 5 working days</td></tr>";
echo "<tr><td>Order Date:</td><td>" . $gdate ."</td></tr>";
echo "</table>";

echo "<h4 class='checkout-heading'>Product Summary</h4>";
$getod = $pdo->prepare("SELECT * FROM orderdetail WHERE orderid=:oid");
$getod->execute(array(
				"oid"=>$oid
				));
echo "<table class='table cart-table'>";
echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th><th>Price</th></thead></tr>";
while($godet = $getod->fetch()){
$proid = $godet['productid'];
$qnty = $godet['quantity'];
$price = $godet['price'];
$getproname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
$getproname->execute(array("id"=>$proid));
while($gnrow = $getproname->fetch()){
$pthumb = $gnrow['pthumb'];
$pname = $gnrow['pname'];
echo "<tr><td><img class='img-responsive cart-image' src='" . $pthumb . "' /></td><td>" . $pname . "</td><td>" . $qnty . "</td><td>Rs. " . $price . "</td></tr>";
}
}
echo "</table>";
if(isset($_REQUEST['ci'])){
$cancelleditems = $_REQUEST['ci'];
if($cancelleditems == ''){
echo "";
}
else{
echo "<h4 class='checkout-heading'>Cancelled Items</h4>";
echo "<table class='table cart-table'>";
echo "<tr><thead><th colspan='2'>Product</th><th>Status</th></thead></tr>"; 
$expcanitems = explode("_",$cancelleditems);
$countcancelleditems = count($expcanitems) - 1;
for($i=0;$i<$countcancelleditems;$i++){
$selectci = $pdo->prepare("SELECT * FROM products WHERE pid=:canpid");
$selectci->execute(array("canpid"=>$expcanitems[$i]));
$scifetch = $selectci->fetch();
echo "<tr><td><img class='img-responsive cart-image' src='" . $scifetch['pthumb'] . "' /></td><td>" . $scifetch['pname'] . "</td><td id='cancelled-status'>Sold Out</td></tr>";
}
echo "</table>";
}
}
echo "<h4 class='checkout-heading'>Delivery Address &amp; Contact Details</h4>";
$orderaddr = $pdo->prepare("SELECT * FROM orderdelivery WHERE orderid=:doid");
$orderaddr->execute(array("doid"=>$oid));
$goaddr = $orderaddr->fetch();
$goname = $goaddr['name'];
$goaddress = $goaddr['address'];
$gophone = $goaddr['phone'];
$goemail = $goaddr['email'];
$gopincode = $goaddr['pincode'];
echo "<table class='table cart-table'>";
echo "<tr><td>Customer Name:</td><td>" . $goname ."</tr>";
echo "<tr><td>Delivery Address:</td><td>" . $goaddress ."</tr>";
echo "<tr><td>Contact Phone/Mobile:</td><td>" . $gophone ."</tr>";
echo "<tr><td>Contact Email:</td><td>" . $goemail ."</tr>";
echo "<tr><td>Location Pincode:</td><td>" . $gopincode ."</tr>";
echo "</table>";
$cid = $_SESSION['customer'];
validateMailOrder($oid,$cid,$goemail,$goname);
unset($_SESSION['cart']);
}
?>
</div>
</div>
<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
</body>
</html>
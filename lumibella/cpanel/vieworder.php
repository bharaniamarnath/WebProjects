<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include('header.php'); ?>
<div class="row content">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Purchase Order Detail</h4>
<hr>
<?php
if(isset($_REQUEST['vieworder'])){
$oid = $_REQUEST['viewoid'];
$selectorder = $pdo->prepare("SELECT * FROM orders WHERE orderid=:oid");
$selectorder->execute(array("oid"=>$oid));
if($selectorder->rowCount() == 0){
echo "<div class='alert alert-info'>Unable to retrieve the details of order <b>" . $oid . "</b>. This may be caused due to following reasons:<br /><br />1. Order removed or deleted from record<br />2. Order does not exist in the database<br />3. Technical Issues</div>";
echo "<a href='orderlist.php' class='btn btn-primary btn-lg pull-right'>View Order List</a>";
}
else{
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
echo "<tr><td>Order ID:</td><td>" . $oid . "</td></tr>";
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
echo "<tr><thead><th>Product</th><th>Quantity</th><th>Price</th></thead></tr>";
while($godet = $getod->fetch()){
$proid = $godet['productid'];
$qnty = $godet['quantity'];
$price = $godet['price'];
$getproname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
$getproname->execute(array("id"=>$proid));
while($gnrow = $getproname->fetch()){
$pname = $gnrow['pname'];
echo "<tr><td>" . $pname . "</td><td>" . $qnty . "</td><td>Rs. " . $price . "</td></tr>";
}
}
echo "</table>";

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

echo "<form action='billing.php' method='POST' target='_blank'>";
echo "<input type='hidden' name='billid' value='" . $oid . "'>";
echo "<input type='submit' class='btn btn-primary btn-lg pull-right' name='getbill' value='Generate Bill' />";
echo "</form>";

echo "<a class='btn btn-primary btn-lg pull-right shipping-button' href='shipping.php?shipoid=" . $oid . "'>Shipping Detail</a>";
$checkstatus = $pdo->prepare("SELECT * FROM orders WHERE orderid=:id");
$checkstatus->execute(array("id"=>$oid));
$csrow = $checkstatus->fetch();
if($csrow['status'] == 0){
echo "<a class='btn btn-primary btn-lg pull-right shipping-button' href='delivered.php?dvoid=" . $oid . "'>Set Delivered</a>";
}
else{
echo "<a class='btn btn-primary btn-lg pull-right shipping-button disabled' href='#'>Delivered</a>";
}
}
}
else{
echo "<div class='alert alert-info'>Error occurred. Unable to retrieve and display order detail</div>";
}
?>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
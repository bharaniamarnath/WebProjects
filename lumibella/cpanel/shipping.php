<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateShippingDetail.php');
//assign exception variables
$shipidError = '';
$shipidStatus = 'Status message will be displayed here';
//fetch form values
if(isset($_REQUEST['addshipid'])){
$shippingid = trim($_REQUEST['shippingid']);
$shipperid = trim($_REQUEST['shipperid']);
$shiporderid = $_REQUEST['shiporderid'];
$shipordermail = $_REQUEST['shipordermail'];
//create classes and objects
$validateShippingDetail = new validateShippingDetail();
$validateShippingID = $validateShippingDetail->validateShippingID($shippingid);
$checkShippingID = $validateShippingDetail->checkShippingID($shippingid);
//throw exceptions
if($validateShippingID == false){
	$shipidError = $validateShippingDetail->shipIDError();
}
if($checkShippingID == false){
	$shipIDError = $validateShippingDetail->shipIDError();
}
if($validateShippingID !== false && $checkShippingID !== false){
	$addShippingDetail = $validateShippingDetail->addShippingDetail($shippingid, $shipperid, $shiporderid);
	$mailShippingDetail = $validateShippingDetail->mailShippingDetail($shippingid, $shipperid, $shiporderid, $shipordermail);
	if($addShippingDetail == true){
		$shipidStatus = $validateShippingDetail->shippingAddSuccess();
	}
	else if($addShippingDetail == false){
		$shipidStatus = $validateShippingDetail->shippingAddFailed();
	}
	else{
		$shipidStatus = "Error adding shipping details";
	}
}
}
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
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Order Shipping Detail</h4>
<hr>
</div>
</div>
<div class="row">
<?php
if(isset($_REQUEST['shipoid'])){
$oid = $_REQUEST['shipoid'];
echo "<div class='col-md-7 col-lg-7 pull-right'>";
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
echo "</div>";

echo "<div class='col-md-5 col-lg-5'>";
echo "<table class='table cart-table'>";
echo "<tr><thead><th>Shipping ID Detail</th></thead></tr>";
echo "<tr><td>";
echo "<div class='alert alert-info'>$shipidStatus</div>";
echo "<form action='shipping.php?shipoid=$oid' method='POST'>";
echo "<div class='form-group'><label for='shippingID'>Shipping ID</label><input type='text' name='shippingid' id='shippingid' placeholder='Enter Shipping ID' class='form-control' maxlength='25' /><span class='exception'>" . $shipidError . "</span></div>";
echo "<div class='form-group'><label for='shippername'>Select Shipper Service</label>";
echo "<select class='form-control' name='shipperid'>";
$selectshipper = $pdo->prepare("SELECT * FROM shippers ORDER BY shippername");
$selectshipper->execute();
while($sc = $selectshipper->fetch()){
$shprid = $sc['shipperid'];
$shprname = $sc['shippername'];
echo "<option value=" . $shprid . ">" . $shprname . "</option>";
}
echo "</select>";
echo "</div>";
echo "<input type='hidden' name='shiporderid' value=" . $oid . " />";
echo "<input type='hidden' name='shipordermail' value=" . $goemail . " />";
echo "<button class='btn btn-primary btn-lg pull-right' id='progressButton' disabled='disabled' style='display:none;'>Processing...</button>";
echo "<input class='btn btn-primary btn-lg pull-right' type='submit' value='Add Shipping' name='addshipid' id='addshipid'  onclick='this.style.display='none'; document.getElementById('progressButton').style.display='inline''; />";
echo "</form>";
echo "</td></tr>";
echo "</table>";
echo "</div>";
}
?>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
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
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/jquery.atwho.css" />
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Order Details</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<hr>
<?php
if(isset($_REQUEST['viewpid'])){
$vpid = $_REQUEST['viewpid'];
$selectorder = $pdo->prepare("SELECT * FROM orders WHERE oid=:vpid");
$selectorder->execute(array("vpid"=>$vpid));
if($selectorder->rowCount() == 0){
echo "<div class='alert alert-info'>Unable to retrieve the details of order <b>" . $vpid . "</b>. This may be caused due to following reasons:<br /><br />1. Order removed or deleted from record<br />2. Order does not exist in the database<br />3. Technical Issues</div>";
}
else{
echo "<table class='table cart-table'>";
echo "<tr><thead><th colspan='2'>Order Summary</th></thead></tr>";
$getamount = $pdo->prepare("SELECT SUM(quantity) AS tqnty FROM orders WHERE oid=:aoid");
$getamount->execute(array("aoid"=>$vpid));
$gares = $getamount->fetch();
$tqnty = $gares['tqnty'];
$getdate = $pdo->prepare("SELECT date FROM delivery WHERE oid=:oid");
$getdate->execute(array("oid"=>$vpid));
$gdfetch = $getdate->fetch();
$gdate = date('F/j/Y',strtotime($gdfetch['date']));
echo "<tr><td>Order ID:</td><td>" . $vpid . "</td></tr>";
echo "<tr><td>Total Quantity Products:</td><td>" . $tqnty . "</td></tr>";
echo "<tr><td>Payment Method:</td><td>CASH ON DELIVERY</td></tr>";
echo "<tr><td>Delivery Time:</td><td>VARIABLE DAYS</td></tr>";
echo "<tr><td>Order Date:</td><td>" . $gdate ."</td></tr>";
echo "</table>";

echo "<h4 class='checkout-heading'>Product Summary</h4>";
$getod = $pdo->prepare("SELECT * FROM orders WHERE oid=:vpid");
$getod->execute(array(
				"vpid"=>$vpid
				));
echo "<table class='table cart'>";
echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th></thead></tr>";
while($godet = $getod->fetch()){
$proid = $godet['pid'];
$qnty = $godet['quantity'];
$getproname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
$getproname->execute(array("id"=>$proid));
while($gnrow = $getproname->fetch()){
$pname = $gnrow['name'];
$pthumb = $gnrow['image'];
echo "<tr><td class='table-image'><img class='img-responsive cart-image' src='".$BASE_URL.$pthumb."' /></td><td>" . $pname . "</td><td>" . $qnty . "</td></tr>";
}
}
echo "</table>";

echo "<h4 class='table-heading'>Delivery Address &amp; Contact Details</h4>";
$orderaddr = $pdo->prepare("SELECT * FROM delivery WHERE oid=:doid");
$orderaddr->execute(array("doid"=>$vpid));
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
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>
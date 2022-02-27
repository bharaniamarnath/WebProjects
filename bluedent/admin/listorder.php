<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
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
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>View Order</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12">
<?php
include('connect.php');
if(isset($_REQUEST['oid'])){
$ordid = trim($_REQUEST['oid']);

$la = $pdo->prepare("SELECT address,phone,email,date FROM delivery WHERE oid=:oid");
$la->execute(array("oid"=>$ordid));
while($row2 = $la->fetch()){
$date = $row2['date'];
$addr = $row2['address'];
$cont = $row2['phone'];
$email = $row2['email'];
echo "<table class='table cart'><thead><tr><th colspan='2'>Ordered Details</th></tr></thead>";
echo "<tr><td>Order ID: </td><td>".$ordid."</td></tr>";
echo "<tr><td>Ordered Date: </td><td>".$date."</td></tr>";
echo "<tr><td>Delivery Address: </td><td>".$addr."</td></tr>";
echo "<tr><td>Contact Number: </td><td>".$cont."</td></tr>";
echo "<tr><td>Email Address: </td><td>".$email."</td></tr></table>";
}

$li = $pdo->prepare("SELECT pid,quantity FROM orders WHERE oid=:oid");
$li->execute(array("oid"=>$ordid));
echo "<table class='table cart'><thead><tr><th colspan='2'>Ordered Products</th><th>Quantity</th></tr></thead>";
while($row1 = $li->fetch()){
$prod = $row1['pid'];
$qnty = $row1['quantity'];
$gpd = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$gpd->execute(array("pid"=>$prod));
$gpdr = $gpd->fetch();
$gpdrimg = $gpdr['image'];
$gpdrname = $gpdr['name'];
echo "<tr><td class='table-image'><img class='img-responsive cart-image' src=".$BASE_URL.$gpdrimg." /></td>";
echo "<td>".$gpdrname."</td>";
echo "<td>".$qnty."</td>";
echo "</tr>";
}
echo "</table>";

echo "<a href='".$CP_URL."vieworders.php?odel=$ordid' class='btn btn-danger'>Cancel or Delivered</a>";
echo "</form>";
echo "<a class='btn btn-primary pull-right' role='button' href='".$CP_URL."vieworders.php'>View Orders</a>";
echo "</div>";
}
?>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>
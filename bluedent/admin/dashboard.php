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
<h2>Control Panel</h2>
</div>
</div>
<div class="row control-panel">
<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Placed Orders</h6>
<?php 
$ol = $pdo->prepare("SELECT * FROM delivery WHERE DATE(date) = CURDATE()");
$ol->execute();
$resol = $ol->rowCount();
if($resol == 0){
echo "<p>No new orders</p>";
}
else{
echo "<p>$resol new orders</p>";
}
?>
<a class="btn btn-primary" href="<?php echo $CP_URL; ?>vieworders.php" role="button">View Orders</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Enquiries</h6>
<?php 
$eq = $pdo->prepare("SELECT * FROM enquiry WHERE DATE(date) = CURDATE()");
$eq->execute();
$reseq = $eq->rowCount();
if($reseq == 0){
echo "<p>No new enquiries</p>";
}
else{
echo "<p>$reseq new enquiries</p>";
}
?>
<a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>enquiries.php">Enquiries</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Add Product</h6><p>Add a new product to the database</p><a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>newproduct.php">Add Product</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Edit Products</h6><p>Edit product details</p><a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>editlist.php">Edit Product</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Downloads</h6><p>Add files to downloads section</p><a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>addfiles.php">Add Files</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Slides</h6><p>Update products in sliders</p><a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>sliders.php">Edit Slides</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Accordions</h6><p>Update accordion order</p><a class="btn btn-primary" role='button' href="<?php echo $CP_URL; ?>accordion.php">Edit Accordions</a></div></div>

<div class="col-md-4 col-lg-4"><div class="panel-box"><h6>Log</h6>
<?php 
$logtime = $pdo->prepare("SELECT lastlog FROM admin");
$logtime->execute();
while($ltime = $logtime->fetch()){
$lastlog = $ltime['lastlog'];
echo "<p>Last login: ".$lastlog."</p>";
}
?>
<form action="<?php echo $CP_URL; ?>clogout.php" method='POST'><button class="btn btn-danger" type='submit' name='logout'>Log Out</button></form></div></div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

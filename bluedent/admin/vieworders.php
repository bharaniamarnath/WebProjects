<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/validateDeleteOrder.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
//Assign Variables
$orderDeleteStatus = '';
//Get Form Values
if(isset($_REQUEST['odel'])){
$deloid = trim($_REQUEST['odel']);
$validateDeleteOrder = new validateDeleteOrder();
$deleteOrder = $validateDeleteOrder->deleteOrder($deloid);
if($deleteOrder == true){
$orderDeleteStatus = $validateDeleteOrder->deleteOrderSuccess();
}
else if($deleteOrder == false){
$orderDeleteStatus = $validateDeleteOrder->deleteOrderFailed();
}
else{
$orderDeleteStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
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
<h2>Placed Orders</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php 
if($orderDeleteStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $orderDeleteStatus; ?></div>
<?php
}
?>
<?php
$vo = $pdo->query("SELECT oid,date FROM delivery ORDER BY date DESC");
$vo->execute();
if($vo->rowCount() == 0){
echo "<div class='alert alert-danger'>No orders available</div>";
}
else{
echo "<table class='table cart'><thead><tr><th>Order ID</th><th>Ordered Date</th><th>Actions</th></tr></thead>";
while($row1 = $vo->fetch()){
$orderid = $row1['oid'];
$odate = $row1['date'];
echo "<tr><td>";
echo $orderid."</td><td>";
echo $odate."</td>";
echo "<td><a href='".$CP_URL."listorder.php?oid=$orderid' class='btn btn-success btn-sm'>View Order</a>";
echo "<a href='".$CP_URL."vieworders.php?odel=$orderid' class='btn btn-danger btn-sm'>Cancel or Delivered</a>";
echo "</td></tr>";
}
echo "</table>";
}
?>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead>
<tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href="<?php echo $CP_URL; ?>dashboard.php">Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

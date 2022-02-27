<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateCancelOrder.php');
//assign cancel order exception variables
$cancelOrderStatus = "Status message for Cancel Order action will be displayed here";
//fetch cancel order details
if(isset($_REQUEST['cancelorder'])){
$coid = trim($_REQUEST['canceloid']);
//create class and objects
$validateCancelOrder = new validateCancelOrder();
$cancelOrder = $validateCancelOrder->cancelOrder($coid);
if($cancelOrder == true){
$cancelOrderStatus = $validateCancelOrder->cancelOrderErr();
}
else if($cancelOrder == false){
$cancelOrderStatus = $validateCancelOrder->cancelOrderErr();
}
else{
$cancelOrderStatus = "Error. Could not cancel/delete the order " . $coid . " due to some technical issue";
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
<div class="col-md-12 col-lg-12">
<h4 class="heading">Purchase Order List</h4>
<hr>
<div class="row">
<form action="orderlist.php" method="POST">
<div class="col-md-3 col-lg-3 panel-search">
<div class="input-group">
<input class="form-control" type="text" name="searchoid" placeholder="Enter Order ID" maxlength="6" />
<span class="input-group-btn">
<input class="btn btn-primary" type="submit" name="searchorder" value="Search Order" />
</span>
</div>
</div>
</form>

<div class="col-md-2 col-lg-2 panel-search">
<form action="orderlist.php" method="POST">
<input class="btn btn-primary" type="submit" name="todaysorder" value="View Today's Order" />
</form>
</div>
<div class="col-md-2 col-lg-2 panel-search">
<a class="btn btn-primary" href="orderlist.php">View All Orders</a>
</div>
</div>

<div class="row">
<div class="alert alert-info"><?php echo $cancelOrderStatus; ?></div>
<?php
$where = "";
if(isset($_REQUEST['searchorder'])){
$soid = trim($_REQUEST['searchoid']);
$where = " WHERE orderid = " . $soid;
}
if(isset($_REQUEST['todaysorder'])){
$where = " WHERE added BETWEEN concat(date(date_sub(now(),interval 1 day)),' 16:30:00') AND concat(date(now()),' 16:30:00')";
}
$listorder = $pdo->prepare("SELECT * FROM orders $where ORDER BY added DESC");
$listorder->execute();
if($listorder->rowCount() == 0){
echo "<div class='alert alert-info'>No orders available</div>";
}
else{
echo "<table class='table'>";
echo "<tr><thead><th>Order ID</th><th>Order Date</th><th>Status</th><th>Action</th></thead></tr>";
while($lo = $listorder->fetch()){
$loid = $lo['orderid'];
$lodate = $lo['added'];
$lostat = $lo['status'];
$lostatus = '';
if($lostat == 1){
$lostatus = 'Delivered';
}
else if($lostat == 0){
$lostatus = 'Undelivered';
}
else{
$lostatus = 'Invalid Status';
}
echo "<tr>";
echo "<td>" . $loid . "</td><td>" . $lodate . "</td><td>" . $lostatus . "</td>";
echo "<td>";
echo "<form action='vieworder.php' method='POST'>";
echo "<input type='hidden' name='viewoid' value='" . $loid . "' />";
echo "<input type='submit' class='btn btn-primary btn-sm pull-left' name='vieworder' value='View Order' />";
echo "</form>";
echo "<form action='orderlist.php' method='POST'>";
echo "<input type='hidden' name='canceloid' value='" . $loid . "' />";
echo "<input type='submit' class='btn btn-danger btn-sm pull-left' name='cancelorder' value='Cancel Order' />";
echo "</form>";
echo "</td>";
echo "</tr>";
}
echo "</table>";
}
?>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
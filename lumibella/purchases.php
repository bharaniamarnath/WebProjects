<?php
ob_start();
session_start();
include("connect.php");
include("includes/orderFinalizer.php");
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
<h4 class="heading">My Purchases</h4>
<hr>
<div class="col-md-3 col-lg-3">
<div class="list-group">
<a href="index.php" class="list-group-item account-logo"><img class="img-responsive" src="images/logo/logo.png" /><h5>Lumibella Customer</h5></a>
<a href="account.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> My Feeds</a>
<a href="accountupdate.php" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Edit Account</a>
<a href="purchases.php" class="list-group-item"><span class="glyphicon glyphicon-shopping-cart"></span> My Purchases</a>
<a href="myratings.php" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> My Ratings</a>
<a href="messages.php" class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> Messages</a>
<a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-lock"></span> Log Out</a>
</div>
</div>
<div class="col-md-9 col-lg-9">
<table class="table cart-table">
<tr><thead><th>Order ID</th><th>Status</th><th>Order Date</th><th>Action</th></thead></tr>
<?php
$purchases = $pdo->prepare("SELECT * FROM orders WHERE customerid=:cid ORDER BY added DESC");
$purchases->execute(array("cid"=>$_SESSION['customer']));
while($getpurchases = $purchases->fetch()){
$purchaseid = $getpurchases['orderid'];
$genpid = "LBO" . $getpurchases['orderid'];
$statusval = $getpurchases['status'];
$status = 'Unknown';
if($statusval == 0){
$status = "Undelivered";
}
else if($statusval == 1){
$status = "Delivered";
}
else{
$status = "Unknown";
}
$purchasedate = $getpurchases['added'];
echo "<tr><td>" . $genpid . "</td><td>" . $status . "</td><td>" . $purchasedate . "</td>";
echo "<td><a class='btn btn-primary btn-sm' href='viewpurchase.php?viewpid=$purchaseid'>View Details</a></td>";
echo "</tr>";
}
?>
</table>
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
<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['customer'])){
header("Location: customer.php?location=".urlencode($_SERVER['REQUEST_URI']));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">My Account</h4>
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

<div class="col-md-8 col-lg-8">
<?php
$customer = $_SESSION['customer'];
$getcdetail = $pdo->prepare("SELECT * FROM customers WHERE cid=:id");
$getcdetail->execute(array(
					"id"=>$customer
					));
$gcd = $getcdetail->fetch();
$cname = $gcd['cname'];
$cemail = $gcd['cemail'];
?>
<div class="row">
<div class="col-md-12 col-lg-12 account-name">
<h3>Hello, <?php echo $cname; ?></h3>
<p><?php echo $cemail; ?></p>
</div>
</div>
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="checkout-heading">Your recent purchase order</h4>
<table class="table cart-table">
<tr><thead><th>Order ID</th><th>Status</th><th>Order Date</th><th>Action</th></thead></tr>
<?php
$purchases = $pdo->prepare("SELECT * FROM orders WHERE customerid=:cid  ORDER BY added DESC LIMIT 5");
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
<!-- Ratings -->
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="checkout-heading">Your recent product ratings</h4>
<?php
$customer = $_SESSION['customer'];
$getcdetail = $pdo->prepare("SELECT * FROM rateduser WHERE cid=:cid LIMIT 5");
$getcdetail->execute(array(
					"cid"=>$customer
					));
while($gcd = $getcdetail->fetch()){
$proid = $gcd['pid'];
$prorate = $gcd['rateval'];
$getpdetail = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$getpdetail->execute(array(
					"pid"=>$proid
					));
while($gpd = $getpdetail->fetch()){
$proname = $gpd['pname'];
$procategory = $gpd['pcategory'];
$prothumb = $gpd['pthumb'];
$checkcat = $pdo->prepare("SELECT * FROM categories WHERE categoryid=:categoryid");
$checkcat->execute(array(
				"categoryid"=>$procategory
				));
$ccget = $checkcat->fetch();
$ccsec = $ccget['section'];
$cccat = $ccget['category'];
$ccsubcat = $ccget['subcategory'];
?>
<div class="row rating-block">
<div class="col-md-2 col-lg-2">
<img class="img-responsive" src="<?php echo $prothumb; ?>" />
</div>
<div class="col-md-8 col-lg-8">
<h4><?php echo $proname; ?></h4>
<p><?php echo $ccsec . " - " . $cccat . " - " . $ccsubcat; ?></p>
<p>You Rated: <span class="badge"><?php echo $prorate; ?></span></p>
<?php
if($prorate == 1){ echo "<img src='images/contents/stars/1.png' class='img-responsive rate-star' />"; }
elseif($prorate > 1 && $prorate < 2){ echo "<img src='images/contents/stars/1-5.png' class='img-responsive rate-star' />"; }
elseif($prorate == 2){ echo "<img src='images/contents/stars/2.png' class='img-responsive rate-star' />"; }
elseif($prorate > 2 && $prorate < 3){ echo "<img src='images/contents/stars/2-5.png' class='img-responsive rate-star' />"; }
elseif($prorate == 3){ echo "<img src='images/contents/stars/3.png' class='img-responsive rate-star' />"; }
elseif($prorate > 3 && $prorate < 4){ echo "<img src='images/contents/stars/3-5.png' class='img-responsive rate-star' />"; }
elseif($prorate == 4){ echo "<img src='images/contents/stars/4.png' class='img-responsive rate-star' />"; }
elseif($prorate > 4 && $prorate < 5){ echo "<img src='images/contents/stars/4-5.png' class='img-responsive rate-star' />"; }
elseif($prorate == 5){ echo "<img src='images/contents/stars/5.png' class='img-responsive rate-star' />"; }
?>
</div>
</div>
<?php
}
}
?>
</div>
</div>

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
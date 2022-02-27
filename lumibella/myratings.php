<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['customer'])){
header("Location: customer.php");
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
<h4 class="heading">My Ratings</h4>
<hr>
<div class="col-md-3">
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
$getcdetail = $pdo->prepare("SELECT * FROM rateduser WHERE cid=:cid");
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
<?php include "footer.php"; ?>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
</body>
</html>
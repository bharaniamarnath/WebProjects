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
<h4 class="heading">Lumibella Messages</h4>
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
$getcdetail = $pdo->prepare("SELECT * FROM messages ORDER BY added DESC");
$getcdetail->execute(array(
					"cid"=>$customer
					));
while($gcd = $getcdetail->fetch()){
$msgtitle = $gcd['mtitle'];
$msg = $gcd['message'];
$added = $gcd['added'];
?>
<div class="row message-block">
<div class="col-md-8 col-lg-8">
<h3><?php echo $msgtitle; ?></h3>
<p><?php echo $msg; ?></p>
<p>Sent on: <?php echo $added; ?></p>
</div>
</div>
<?php
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
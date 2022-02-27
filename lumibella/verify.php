<?php
include('connect.php');
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
<h4 class="heading">Lumibella Store Account Activation</h4>
<hr>
<h4 class="checkout-heading">Account Activation Status</h4>
<div class="col-md-12 col-lg-12 text-holder">
<?php
if(isset($_GET['customer']) && isset($_GET['activation'])){
$cid = $_GET['customer'];
$aid = $_GET['activation'];
$active = 1;
$setact = $pdo->prepare("SELECT * FROM activation WHERE cid=:id AND aid=:actkey");
$setact->execute(array(
				"id"=>$cid,
				"actkey"=>$aid
				));
if($setact->rowCount() == 1){
$activate = $pdo->prepare("UPDATE customers SET activated=:active WHERE cid=:id");
$activate->execute(array(
				"active"=>$active,
				"id"=>$cid
				));
$deletekey = $pdo->prepare("DELETE FROM activation WHERE cid=:delid AND aid=:delkey");
$deletekey->execute(array(
					"delid"=>$cid,
					"delkey"=>$aid
					));
if($activate && $deletekey){
echo "<div class='log-alert'><img class='img-responsive' src='images/logo/logo-purple.png' /><h5><span class='glyphicon glyphicon-ok'></span> Your account has been activated successfully. You can login to your Lumibella Store Customer Account now</h5></div>";
}
else{
echo "<div class='log-alert'><img class='img-responsive' src='images/logo/logo-purple.png' /><h5><span class='glyphicon glyphicon-exclamation-sign'></span> Your Lumibella Store Customer Account activation failed. Please try registering again or contact us now</h5></div>";
}
}
else{
echo "<div class='log-alert'><img class='img-responsive' src='images/logo/logo-purple.png' /><h5><span class='glyphicon glyphicon-exclamation-sign'></span> Your Lumibella Store Customer Account activation link expired or does not exist. For more information contact us</h5></div>";
}
}
?>
</div>
</div>
<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
</body>
</html>
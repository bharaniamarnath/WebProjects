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
<!DOCTYPE html>
<html>
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
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>My Cart</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php
if(isset($_POST['clearcart'])){
unset($_SESSION['cart']);
}
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
	echo "<div class='empty-cart'><img class='img-responsive' src='".$BASE_URL."images/contents/empty-cart.png' /><h2>Cart is empty</h2><center><a href='".$BASE_URL."mycart.php' class='btn btn-success'>Reload Cart</a></center></div>";
}
else{
	$max = count($_SESSION['cart']);
	$qemsg = "";
	if(isset($_REQUEST['qerr'])){
		$qerror = $_REQUEST['qerr'];
		$errpid = $_REQUEST['errpid'];
		if($qerror == 0){
			$qemsg = "Ok";
		}
		if($qerror == 1){
			$qemsg = "Invalid quantity";
		}
		if($qerror == 2){
			$qemsg = "Invalid quantity";
		}
		if($qerror == 3){
			$qemsg = "Stock limit exceeded";
		}
		if($qerror == 4){
			$qemsg = "Invalid quantity";
		}
	}
	echo "<table class='table cart'>";
	echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th><th>Update Quantity</th><th>Check Quantity</th><th colspan='2'>Action</th></thead></tr>";
	for($i=0;$i<$max;$i++){
		$pid = $_SESSION['cart'][$i]['pid'];
		$pqty = $_SESSION['cart'][$i]['pq'];
		$getname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
		$getname->execute(array("id"=>$pid));
		$gnrow = $getname->fetch();
		$pname = $gnrow['name'];
		$pthumb = $gnrow['image'];
		echo "<tr><td class='table-image'><img class='img-responsive cart-image' src='".$BASE_URL.$pthumb."' /></td>";
		echo "<td>" . $pname . "</td>";
		echo "<form action='#' id='cart'><td class='table-qty'>";
		echo "<div class='col-md-5 col-lg-5'><input type='text' name='cqnty' id='cqnty' maxlength='2' class='form-control' value='" . $pqty . "' /></div></td>";
		echo "<td>";
		echo "<input type='hidden' name='cpid' value='".$pid."' />";
		echo "<input class='btn btn-info btn-sm update-quantity' type='button' id='fbtn'" . $pid ." name='updatequant' value='Update' onclick='validateUpdateCart(cpid.value, cqnty.value); this.disabled=false; cqnty.disabled=false;' />";
		echo "</td></form>";
		echo "<td><span class='qalert' id='qalert" . $pid . "'></span></td>";
		echo "<td colspan='2'><form action='removecart.php' method='POST'><input type='hidden' value='" . $pid .  "' name='remid'><input class='btn btn-danger btn-sm' type='submit' value='remove' name='remove' /></form></td>";
		echo "</tr>";		
	}
	echo "<tr><td colspan='6'><form action='mycart.php' method='POST'><input type='submit' class='btn btn-danger btn-sm' name='clearcart' value='Clear Cart' /></form></td></tr>";
	echo "<tr><td><a class='btn btn-warning' href='javascript:history.go(0)'>Reload Cart</a></td>";
	echo "<td colspan='4'></td><td><a href='".$BASE_URL."checkout.php' class='btn btn-success btn-lg'>Check Out</a></td></tr>";
	echo "</table>";
}
?>
</div>
</div>
<?php include('footer.php'); ?>
</div>

<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/loadFunction.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>
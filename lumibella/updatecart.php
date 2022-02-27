<?php
session_start();
include("connect.php");
include("cart.php");
if(!isset($_SESSION['cart'])){
	header("Location:products.php");
}
$pid = $_POST['cpid'];
$pqty = $_POST['cqnty'];
updatecart($pid, $pqty);
echo "<div id='itemadded'><span class='glyphicon glyphicon-ok'></span> Ok</div>";
?>
<?php
session_start();
include('connect.php');
include("cart.php");
$pid = $_POST['cpid'];
$pqty = $_POST['cqnty'];
if(isset($_SESSION['cart'])){
$max = count($_SESSION['cart']);
for($i=0; $i<$max; $i++){
if($pid == $_SESSION['cart'][$i]['pid']){
echo "<span class='glyphicon glyphicon-exclamation-sign'></span> Already in cart";
exit();
}
}
}
addcart($pid, $pqty);
echo "<div id='itemadded'><span class='glyphicon glyphicon-ok'></span> Added to cart</div>";
?>
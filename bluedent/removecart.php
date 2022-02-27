<?php
session_start();
include("cart.php");
if(!isset($_SESSION['cart'])){
	header("Location: products.php");
}
if(isset($_REQUEST['remove'])){
$id = $_REQUEST['remid'];
removecart($id);
header('Location: mycart.php');
}
?>
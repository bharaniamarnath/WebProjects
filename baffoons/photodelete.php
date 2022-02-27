<?php
	session_start();
	include('includes/header.php');
	include('includes/connect.php');
	include('includes/class.photos.php');
	include('includes/alerts.php');
	$suid = $_SESSION['user'];
	if(isset($_POST['picdelete'])){
		$photos = new photos();
		$photos->setUserSession($suid);
		$photos->setImageId($_POST['deletepic']);
		$photos->ImageDelete();
		header("Location: photos.php");
		}
?>
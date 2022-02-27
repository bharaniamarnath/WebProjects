<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.photos.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['vote'])){
		$photos = new photos();
		$photos->setUserSession($suid);
		$photos->setImageVote($_POST['votepic']);
		$photos->InsertVote();
	}
?>
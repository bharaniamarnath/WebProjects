<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.friend.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['deleterequest'])){
		$friend = new friend();
		$friend->setUserSession($suid);
		$friend->setRequestName($_POST['reqfrnd']);
		$friend->DeleteRequest();
		header("Location: friendrequest.php");
		}
	?>
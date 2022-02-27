<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.message.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['delete'])){
		$message = new message();
		$message->setUserSession($suid);
		$message->setPostMessage($_POST['deletemsg']);
		$message->DeleteBulletin();
		header("Location: publicpost.php");
		}
?>
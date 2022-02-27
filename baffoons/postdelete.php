<?php
	session_start();
	include('includes/connect.php');
	include('includes/class.message.php');
	include('includes/alerts.php');
	$suid = $_SESSION['user'];
	if(isset($_POST['delete'])){
		$message = new message();
		$message->setUserSession($suid);
		$message->setPostMessage($_POST['deletemsg']);
		$message->DeleteMessage();
		header("Location: main.php");
		}
?>
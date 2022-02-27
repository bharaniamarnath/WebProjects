<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.feedback.php');
include('includes/alerts.php');
$suid = $_SESSION['user'];
if(isset($_POST['sendfb'])){
	if(empty($_POST['fbfrom']) || empty($_POST['fbsubj']) || empty($_POST['feedbk'])){
		echo $emptysenderalert;
		exit();
	}
	$feedback = new feedback();
	$feedback->setFeedId(rand(000000,999999));
	$feedback->setFrom($_POST['fbfrom']);
	$feedback->setSubject($_POST['fbsubj']);
	$feedback->setMessage($_POST['feedbk']);
	$feedback->SendFeedback();
}
?>
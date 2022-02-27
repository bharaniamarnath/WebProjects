<?php
session_start();
include('includes/inhead.php');
include('includes/class.signin.php');
include('includes/alerts.php');
if(isset($_POST['login'])){
if(empty($_POST['uname']) && empty($_POST['pswd'])){
	echo $logemptyalert;
	exit();
}
$signin = new signin();
$signin->setUserName($_POST['uname']);
$signin->setUserPassword(md5($_POST['pswd']));
$signin->UserSignIn();
}
?>

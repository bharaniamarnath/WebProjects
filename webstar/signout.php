<?php
session_start();
include('includes/outhead.php');
include('includes/connect.php');
include('includes/alerts.php');
if(isset($_SESSION['user'])){
	unset($_SESSION['user']);
	session_destroy();
	echo $logoutalert;
}
?>
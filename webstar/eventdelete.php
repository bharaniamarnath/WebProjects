<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.event.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['delevent'])){
	$event = new event();
	$event->setUserSession($suid);
	$event->setEventName($_POST['evntnme']);
	$event->setEventDay($_POST['evntdte']);
	$event->DeleteEvent();
	header("Location: calendar.php");
	}
?>
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
	if(isset($_POST['addeve'])){
		$event = new event();
		$event->setUserSession($suid);
		$event->setEventName($_POST['eventname']);
		$edte = $_POST['edate'];
		$emnth = $_POST['emonth'];
		$eyr = $_POST['eyear'];
		$event->setEventDay($eyr . $emnth . $edte);
		$event->setEventType($_POST['eventtype']);
		$event->setEventDescription($_POST['eventdes']);
		$event->InsertEvent();
	}
		
?>
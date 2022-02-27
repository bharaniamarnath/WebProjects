<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.report.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['report'])){
		$report = new report();
		$report->setReportId(rand(000000,999999));
		$report->setReportedUser($suid);
		$report->setReportUser($_POST['repuid']);
		$report->setReportMessage($_POST['repmsg']);
		$report->setReportLocation($_POST['reploc']);
		$report->MessageReport();
		}
?>
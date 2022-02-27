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
	if(isset($_POST['delete'])){
		$picid = $_POST['commpicid'];
		$photos = new photos();
		$photos->setUserSession($suid);
		$photos->setCommentDate($_POST['commdate']);
		$photos->DeleteComment();
		header("Location: publicphotoview.php?photoid=" . $picid);
		}
?>
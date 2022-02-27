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
if(isset($_POST['commpic'])){
$photos = new photos();
$photos->setUserSession($suid);
$photos->setCommentId(rand(000000,999999));
$photos->setImageId($_POST['commentpic']);
$photos->setImageComment($_POST['piccomm']);
$photos->InsertComment();
header("Location: publicphotoview.php?photoid=" . $photos->getImageId());
}
?>
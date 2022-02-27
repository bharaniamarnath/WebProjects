<?php
session_start();
include('includes/header.php');
include('includes/class.message.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
$suid = $_SESSION['user'];

if(isset($_POST['post'])){
	if(empty($_POST['msgpost'])){
		echo $postemptyalert;
		exit();
	}
	if(strlen($_POST['msgpost']>100)){
		echo $posterralert;
		exit();
	}
$message = new message();
$message->setUserSession($suid);
$message->setPostMessage($_POST['msgpost']);
$message->InsertBulletin();
header("location: publicpost.php");
}

if(isset($_POST['vidpost'])){
	if(empty($_POST['vdopost'])){
		echo $postemptyalert;
		exit();
	}
	
$url = $_POST['vdopost'];
$urlcheck = 'http://www.youtube.com/watch?v=';
	if(strpos($url, $urlcheck) === false){
		echo $invalidurlalert;
		exit();
	}
$videocode = substr($url, 31);
$seturl = '<iframe width="420" height="345"
src="http://www.youtube.com/embed/'.$videocode.'">
</iframe>';

$message = new message();
$message->setUserSession($suid);
$message->setPostMessage($seturl);
$message->InsertBulletin();
header("location: publicpost.php");
}
?>
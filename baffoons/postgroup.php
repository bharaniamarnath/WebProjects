<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.group.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
if(isset($_POST['gpost'])){
if($_POST['gmsgpost'] == ""){
echo $grouppostalert;
exit();
}
$group = new group();
$group->setUserSession($suid);
$group->setPostId(rand(000000,999999));
$group->setPostMessage($_POST['gmsgpost']);
$group->setGroupId($_POST['gpid']);
$group->InsertGroupPost();
header("Location: viewgroup.php?vgrpid=" . $group->getGroupId());
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

$group = new group();
$group->setUserSession($suid);
$group->setPostId(rand(000000,999999));
$group->setPostMessage($seturl);
$group->setGroupId($_POST['gpid']);
$group->InsertGroupPost();
header("Location: viewgroup.php?vgrpid=" . $group->getGroupId());
}
?>
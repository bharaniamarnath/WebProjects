<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.update.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
if(isset($_POST['updateacc'])){

if(empty($_POST['usrnme'])){
echo $unamealert;
exit();
}
if(empty($_POST['oldpass'])){
echo $passalert;
exit();
}
if(empty($_POST['newpass'])){
echo $passalert;
exit();
}
if($_POST['newpass'] != $_POST['cnewpass']){
echo $passconfalert;
exit();
}

$update = new update();
$update->setUserSession($suid);
$update->setAccountId($_POST['accid']);
$update->setUsername($_POST['usrnme']);
$update->setOldPassword(md5($_POST['oldpass']));
$update->setNewPassword(md5($_POST['newpass']));
$update->UpdateAccount();
}
?>

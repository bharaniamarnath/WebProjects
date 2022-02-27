<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.mail.php');
include('includes/alerts.php');
$suid = $_SESSION['user'];

if(isset($_POST['delete'])){
$mail = new mail();
$mail->setUserSession($suid);
$mail->setMailId($_POST['delmail']);
$mail->DeleteMail();
header("Location: inbox.php");
}

if(isset($_POST['deleteall'])){
$mail = new mail();
$mail->setMailReciever($_POST['usermail']);
$mail->DeleteAllMail();
}

if(isset($_POST['readall'])){
$mail = new mail();
$mail->setMailReciever($_POST['readmail']);
$mail->AllMailRead();
}
?>
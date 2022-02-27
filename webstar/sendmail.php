<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.mail.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
	echo $logdenyalert;
}
	$suid = $_SESSION['user'];
	if(isset($_POST['send'])){
		if(empty($_POST['reciever'])){
			echo $emptytoalert;
			exit();
		}
		$run = $_POST['reciever'];
		$getrid = $pdo->prepare("SELECT * FROM userdetails WHERE Username=:Username");
		$getrid->execute(array('Username'=>$run));
		$gridrow = $getrid->fetch();
		$grid = $gridrow['UserID'];
		$mail = new mail();
		$mail->setUserSession($suid);
		$mail->setMailId(rand(000000,999999));
		$mail->setMailReciever($grid);
		$mail->setMailSubject($_POST['subject']);
		$mail->setMailMessage($_POST['mailbody']);
		$mail->SendMail();
	}
	?>
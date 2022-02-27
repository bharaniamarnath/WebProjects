<?php
include('includes/inhead.php');
include('includes/connect.php');
include('includes/alerts.php');
if(isset($_POST['check'])){
	if(empty($_POST['userid'])){
		echo $useridalert;
		exit();
	}
	else{
	$userid = $_POST['userid'];
	$id = $pdo->prepare("SELECT * FROM userdetails WHERE UserID = :UserID");
	$id->execute(array('UserID'=>$userid));
	if($id->rowCount()==0){
		echo $noidexistalert;
		exit();
		}
	else{
		header("Location: updatepass.php");
		}
		}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Retrieve User Account</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<br />
<div class="mainboard" style="border-top: 1px solid #ccc;">
<h3>Enter the 6 digit Account ID which is in the account's settings page.</h3>
<table class="regform">
<form action="checkuid.php" method="POST">
	<tr><td colspan="2" id="aboutme">In case of forgotten or not having the account ID, do the following step:<br /><br />Write a feedback to the Baffoons from a friend's account, requesting for the account recovery by providing valid information about the lost account. Baffoons will fix the account as soon as possible after verifying the feedback information.</td></tr>
	<tr><td class="regform" style="padding-top: 20px;">Account ID:</td> <td class="regform" style="padding-top: 20px;"><input type="text" name="userid" id="userid" /></td></tr>
	<tr><td></td><td><input type="submit" name="check" id="check" value="Check ID" /></td></tr>
	</form>
	</table></div>
	</body>
	</html>
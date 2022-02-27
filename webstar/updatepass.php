<?php
include('includes/inhead.php');
include('includes/connect.php');
include('includes/class.update.php');
include('includes/alerts.php');
if(isset($_POST['update'])){
	$usrname = $_POST['usrname'];
	if(empty($_POST['usrname'])){
		echo $unamealert;
		exit();
	}
	else{		
	$un = $pdo->prepare("SELECT * FROM userdetails WHERE Username = :Username");
	$un->execute(array('Username'=>$usrname));
	if($un->rowCount()==0){
		echo $unamefailalert;
		exit();
		}
		}
	if(empty($_POST['newpasswd'])){
		echo $emptypassalert;
		exit();
	}
	if(empty($_POST['confnewpw'])){
		echo $emptypassalert;
		exit();
	}
	if($_POST['newpasswd']!==$_POST['confnewpw']){
		echo $newpassalert;
		exit();
	}
$update = new update();
$update->setUsername($_POST['usrname']);
$update->setNewPassword(md5($_POST['newpasswd']));
$update->UpdatePassword();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons - Update Password</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="mainboard" style="border-top: 1px solid #ccc;">
<h3 id="aboutme">To update the password, enter the account username and the new password below.</h3>
<table class="regform">
<form action="updatepass.php" method="POST">
<tr><td class="regform">Username:</td> <td class="regform"><input type="text" name="usrname" id="usrname" /></td></tr>
<tr><td class="regform">New Password:</td> <td class="regform"><input type="password" name="newpasswd" id="newpasswd" /></td></tr>
<tr><td class="regform">Retype New Password:</td> <td class="regform"><input type="password" name="confnewpw" id="confnewpw" /></td></tr>
<tr><td></td><td><input type="submit" name="update" id="update" value="Update" /></td></tr>
</form>
</table>
</div>
</body>
</html>		

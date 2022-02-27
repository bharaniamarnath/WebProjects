<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
if(!isset($_POST['submitpass'])){
echo $invalidsettingaccess;
exit();
}
else{
$getpass = md5($_POST['verifypass']);
$chkpass = $pdo->prepare("SELECT Password FROM userdetails WHERE UserID = :UserID");
$chkpass->execute(array(
				'UserID'=>$suid
				));
while($cprow = $chkpass->fetch()){
$cppass = $cprow['Password'];
if($getpass != $cppass){
echo $invalidpassalert;
exit();
}
}
}
?>
<?php
$aun = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$aun->execute(array('UserID'=>$suid));
$aunrow = $aun->fetch();
$auname = $aunrow['Username'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />
</head>
<body>
<div id="container">
<div id="leftpane">
<div class="dashboard"><div id="profileimage"><?php echo "<a href='profile.php'><img src='$thumbloc' id='profilecrop' /></a>"; ?></div><h2><?php echo $fname . ' ' . $lname; ?></h2><?php echo $usrnme; ?><br /><?php echo $mail; ?></div>
<div id="menubar">
<div id="holder">
<ul>
<li><a href="main.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="photos.php">Photos</a></li>
<li><a id="onlink" href="mail.php">Messages</a></li>
<li><a href="groups.php">Groups</a></li>
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div id="submenubar">
<div id="holder">
<ul>
<li><a id="onlink" href="account.php">Account Settings</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<table class="proform">
<form action="updateaccount.php" method="POST">
<tr><td colspan="2" id="aboutme">Use the account settings to change the account username and password</td></tr>
<tr><th>Account ID & Name</th></tr>
<tr><td>Account ID:</td><td><?php echo $suid; ?></td></tr>
<tr><td>Account Name:</td><td><input type="text" value="<?php echo $auname; ?>" name="usrnme" /></td></tr>
<tr><th>Account Password</th></tr>
<tr><td>Old Password:</td><td><input type="password" name="oldpass" /></td></tr>
<tr><td>New Password:</td><td><input type="password" name="newpass" /></td></tr>
<tr><td>Retype New Password:</td><td><input type="password" name="cnewpass" /></td></tr>
<tr><td></td><td><br /><input type="hidden" name="accid" value="<?php echo $suid; ?>"><input type="submit" name="updateacc" value="Update Account" /></td></tr>
</form>
<form action="deleteaccount.php" method="POST">
<tr><th>Delete Account</th></tr>
<tr><td colspan="2">Deleting this account will remove all the posts, images and other data permanently</td></tr>
<tr><td><input type="hidden" value="<?php echo $suid; ?>" name="delaccid" /><br /><input type="submit" name="delacc" value="Delete Account" />
</form>
</table>
</div>
</div>
</div>
</div>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
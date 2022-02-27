<?php
session_start();
include('includes/outhead.php');
include('includes/connect.php');
include('includes/class.update.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";

if(isset($_POST['condelete'])){
if(empty($_POST['accpass'])){
echo $delaccpassalert;
exit();
}
$daid = $_POST['daid'];
$confpass = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$confpass->execute(array('UserID'=>$daid));
while($conpswd = $confpass->fetch()){
$accuname = $conpswd['Username'];
$compswd = $conpswd['Password'];
if($compswd == md5($_POST['accpass'])){
$update = new update();
$update->setAccountId($_POST['daid']);
$update->DeleteAccount();
}
else{
echo $wrongdelpassalert;
exit();
}
}
}
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
<li><a href="account.php">Account Settings</a></li>
<li><a id="onlink" href="deleteaccount.php">Delete Account</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php
if(isset($_POST['delacc'])){
$delaccid = $_POST['delaccid'];
echo "<form action='deleteaccount.php' method='POST'>";
echo "<table class='proform'><tr><td colspan='2' id='aboutme'>Deleting the account will delete all the posts, images and other data permanently and cannot be recovered</td></tr><tr><th colspan='2'>Enter account password to confirm account deletion</th></tr><tr><td>Account Password:</td><td><input type='password' name='accpass' /></td></tr>";
echo "<tr><td></td><td><input type='hidden' value='$delaccid' name='daid' /><input type='submit' value='Confirm' name='condelete' /></td></tr></table>";
echo "</form>";
}
?>
</div>
</div>
</div>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>

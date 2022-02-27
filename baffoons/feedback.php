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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta http-equiv="refresh" content="120">
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
<li><a id="onlink" href="main.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="photos.php">Photos</a></li>
<li><a href="inbox.php">Messages</a></li>
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
<li><a id="onlink" href="feedback.php">Feedback</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<h4>Send Feedback to Baffoons</h4><br />
<form action="sendfeedback.php" method="POST">
<table class="mailbox">
<tr>
<td class="mail">From: </td><td><input type="text" value="<?php echo $mail; ?>" name="fbfrom" />&nbsp;</td>
</tr>
<tr>
<td class="mail">Subject: </td><td><input type="text" name="fbsubj" /></td>
</tr>
<tr>
<td class="mail">Feedback: </td><td><textarea name="feedbk"></textarea></td>
</tr>
<tr>
<td></td><td><br /><input type="submit" name="sendfb" value="Send Feedback" id="sendbutton" /></td>
</tr>
</table>
</form>
<input type="button" value="Back" onClick="history.go(-1)"></input><br />
</div>
</div>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
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
<li><a href="inbox.php">Inbox</a></li>
<li><a href="mailsent.php">Sent Mails</a></li>
<li><a id="onlink" href="composemail.php">Compose Mail</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<h3>Compose new message</h3><br />
<table>
<form action="sendmail.php" method="POST">
<table class="mailbox">
<tr>
<td class="mail">To:<br /><input type="text" name="reciever" /><font style="font-weight:normal; margin-left:5px; font-size: 10px;">Username</font></td>
</tr>
<tr>
<td class="mail">Subject:<br /><input type="text" name="subject" /></td>
</tr>
<tr>
<td class="mail">Message:<br /><textarea id="mailbody" name="mailbody"></textarea></td>
</tr>
<tr><td class="mail"><input type="submit" value="Send Message" name="send" id="sendbutton" /></td></tr>
</table>
</form>
</div>
</div>
</div>
</div>
</div>

<div id="notification">
<h5>Mail Box</h5>
<?php
$mailnotify = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever = :Reciever AND Status = :Status");
$mailnotify->execute(array(
			'Reciever'=>$suid,
			'Status'=>'U'
));
$unreadmails = $mailnotify->rowCount();
if($unreadmails == 0){
echo "<p>No new mails</p>";
}
else{
echo "<p>$unreadmails new/unread mail(s)";
echo "<div id='bdbox' style='border-bottom: none; padding-bottom: 20px; margin-top: 20px;'><input id='addmbdf' type='button' onClick=parent.location='inbox.php' value='View Inbox'></div>";
}
?>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
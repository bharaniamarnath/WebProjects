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
<li><a id="onlink" href="composemail.php">Compose Mail</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<?php
if(isset($_POST['reply'])){
$replyto = $_POST['toreply'];
echo "<h3>Reply To</h3><br />";
echo "<table>";
echo "<form action='sendmail.php' method='POST'>";
echo "<table class='mailbox' style='padding-top: 10px; background: #eee;'>";
echo "<tr>";
echo "<td class='mail'>To: </td><td class='mail'><input type='text' name='reciever' value='$replyto' /><font color='#309cbc' style='padding-left: 5px; font-size: 11px;'></font></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='mail'>Subject: </td><td class='mail'><input type='text' name='subject' /></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='mail'>Message: </td><td class='mail'><textarea name='mailbody'></textarea><br /><br /></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='mail'></td><td class='mail'><input type='submit' value='Send Message' name='send' id='sendbutton'' /></td>";
echo "</tr>";
echo "</table>";
}
?>
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
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
<li><a id="onlink" href="inbox.php">Messages</a></li>
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
<li><a id="onlink" href="inbox.php">Inbox</a></li>
<li><a href="mailsent.php">Sent Mails</a></li>
<li><a href="composemail.php">Compose Mail</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php 
if(isset($_POST['vmail'])){
$mailid = $_POST['viewmail'];
$updmail = $pdo->prepare("UPDATE maildetails SET Status='R' WHERE ID=:ID");
$updmail->execute(array('ID'=>$mailid));
$chkmail = $pdo->prepare("SELECT * FROM maildetails WHERE ID=:ID");
$chkmail->execute(array('ID'=>$mailid));
if($chkmail->rowCount()==0){
echo $emptyinboxalert;
}
while($cmrow = $chkmail->fetch()){
$cmid = $cmrow['ID'];
$cmsender = $cmrow['Sender'];
$cmsubj = $cmrow['Subject'];
$cmbody = $cmrow['Mail'];
$cmdate = $cmrow['Date'];
$sendername = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$sendername->execute(array('UserID'=>$cmsender));
while($sname = $sendername->fetch()){
$sfname = $sname['Firstname'];
$slname = $sname['Lastname'];
$susrname = $sname['Username'];
echo "<table class='viewmail'>";
echo "<tr>";
echo "<td colspan='2' class='mailtitle'>Mail Header</td>";
echo "</tr><tr>";
echo "<td class='mail'>Sender: </td><td>$sfname $slname</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='mail'>Sent on: </td><td>$cmdate</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='mail'>Subject: </td><td>$cmsubj</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='2' class='mailtitle'>Message</td>";
echo "</tr><tr>";
echo "<td class='mailmessage' colspan='2'><font id='postmessage'>$cmbody</font></td>";
echo "</tr>";
echo "</tr>";
echo "<tr>";
echo "<td></td><td>
<form action='replymail.php' method='POST'>
<input type='hidden' name='toreply' value='$susrname'></input>
<input type='submit'id='sendbutton' name='reply' value='Reply' style='margin-top:12px;' />
</form>
<form action='deletemail.php' method='POST'>
<input type='hidden' name='delmail' value='$cmid'></input>
<input type='submit'id='sendbutton' name='delete' value='Delete' />
</form><input type='button' onclick=location.href='inbox.php' value='Back' id='backinbox' />";
echo "</tr>";
echo "</table>";
}
}
}
?>
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
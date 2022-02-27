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
<li><a id="onlink" href="inbox.php">Inbox</a></li>
<li><a href="composemail.php">Compose Mail</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php 
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever=:Reciever");
$msg->execute(array('Reciever'=>$suid));
$msgcount = $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$chkmail = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever=:Reciever ORDER BY Date DESC LIMIT $start, $perpage");
$chkmail->execute(array('Reciever'=>$suid));
echo "<form action='deletemail.php' method='POST'><input type='hidden' value='$suid' name='usermail' /><input type='submit' value='Delete All' name='deleteall' id='photobutton' /></form>";
echo "<form action='deletemail.php' method='POST'><input type='hidden' value='$suid' name='readmail' /><input type='submit' value='Mark All Read' name='readall' id='photobutton' style='margin-top: -6px; margin-bottom: 10px;' /></form>";
echo "<table class='inbox'>";
echo "<tr><th>Sender</th><th>Subject</th><th>Date</th><th>Actions</th></tr>";
if($chkmail->rowCount()==0){
echo "<tr><td colspan='4'>".$emptyinboxalert."</td></tr>";
}
while($cmrow = $chkmail->fetch()){
$cmid = $cmrow['ID'];
$cmsender = $cmrow['Sender'];
$cmsubj = $cmrow['Subject'];
$cmbody = $cmrow['Mail'];
$cmdate = $cmrow['Date'];
$cmstatus = $cmrow['Status'];
echo "<tr>";
if($cmstatus == 'U'){
echo "<td><b>$cmsender</b></td>";
echo "<td><b>$cmsubj</b></td>";
echo "<td style='width:125px;'><b>$cmdate</b></td>";
}
else{
echo "<td>$cmsender</td>";
echo "<td>$cmsubj</td>";
echo "<td style='width:125px;'>$cmdate</td>";
}
echo "<td style='width:125px;'>
<form action='viewmail.php' method='POST'>
<input type='hidden' name='viewmail' value='$cmid'></input>
<input type='submit' name='vmail' value='View' style='margin-top:12px;' />
</form>
<form action='deletemail.php' method='POST'>
<input type='hidden' name='delmail' value='$cmid'></input>
<input type='submit' name='delete' value='Delete' />
</form>";
echo "</td></tr>";
}
echo "</table>";
?>

<?php
echo "<div id='pagenumbers'>";
if($pages>=1 && $page<=$pages){
for($x = 1; $x <= $pages ; $x++){
echo ($x == $page) ? "<a id='selected' href='?page=$x'>$x</a> " : "<a id='notselected' href='?page=$x'>$x</a> ";	
}
}
echo "</div>";
?>
</div>

</div>
</div>
</div>
</div>

<div id="notification">
<h5>Random Mails</h5>
<?php
$mailrand = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever = :Reciever");
$mailrand->execute(array('Reciever'=>$suid));
if($mailrand->rowCount() == 0){
echo "<p>No mails found</p>";
}
while($rmrow = $mailrand->fetch()){
$rmid = $rmrow['ID'];
$rmsender = $rmrow['Sender'];
$rmsubject = $rmrow['Subject'];
$rmdate = $rmrow['Date'];
$rmsd = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$rmsd->execute(array('UserID'=>$rmsender));
$rmsrow = $rmsd->fetch();
$rmsun = $rmsrow['Username'];
echo "<table class='rmails'>";
echo "<tr><td><b>$rmsun</b><br />$rmsubject<br />$rmdate</td></tr>";
echo "<tr><td style='float: right'>
<form action='viewmail.php' method='POST'>
<input type='hidden' name='viewmail' value='$rmid'></input>
<input type='submit' name='vmail' value='View' style='margin-top:12px;' />
</form></td></tr>";
echo "</table>";
}
?>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
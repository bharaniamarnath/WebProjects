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
<li><a href="mail.php">Messages</a></li>
<li><a id="onlink" href="groups.php">Groups</a></li>
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div id="submenubar">
<div id="holder">
<ul>
<li><a href="groups.php">My Groups</a></li>
<li><a id="onlink" href="allgroups.php">All Groups</a></li>
<li><a href="creategroup.php">Create Group</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php 
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM groups");
$msg->execute();
$msgcount = $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$groups = $pdo->prepare("SELECT * FROM groups ORDER BY Date DESC LIMIT $start, $perpage");
$groups->execute();
while($agroup = $groups->fetch()){
$groupid = $agroup['ID'];
$groupname = $agroup['Name'];
$grouptype = $agroup['Type'];
$groupdesc = $agroup['Description'];
$groupadmin = $agroup['UserID'];
$groupimage = $agroup['Image'];
$groupimagethumb = $agroup['Thumb'];
echo "<div class='groupbox'>";
echo "<img align='left' id='thumbimgcrop' src='$groupimagethumb'></img><p>$groupname<br /><font id='postmessage'>$grouptype</font></p><a href='viewgroup.php?vgrpid=$groupid'>View</a></div>";
}
?>
</div>
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

<div id="groupbox">
<h5>Random Groups</h5>
<?php
$randgrp = $pdo->prepare("SELECT * FROM groups ORDER BY RAND() LIMIT 6");
$randgrp->execute();
if($randgrp->rowCount() == 0){
echo "<p>No groups found</p><br />";
}
while($rgrow = $randgrp->fetch()){
$rgid = $rgrow['ID'];
$rgn = $rgrow['Name'];
$rgimg = $rgrow['Image'];
$rgtype = $rgrow['Type'];
echo "<table class='rgroups'>";
echo "<tr><td id='rgimage' rowspan='2'><div id='randomgrp'><a href='viewgroup.php?vgrpid=$rgid'><img src='$rgimg' id='profilecrop' /></a></div></td>";
echo "<td><a id='rglink' href='viewgroup.php?vgrpid=$rgid'><p>$rgn</p></a><font>$rgtype</font></td></tr>";
echo "</table>";
}
?>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
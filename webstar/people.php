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
<li><a id="onlink" href="friends.php">Friends</a></li>
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
<li><a href="friends.php">Friends</a></li>
<li><a id="onlink" href="people.php">People</a></li>
<li><a href="friendrequest.php">Friend Requests</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<?php 
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM userdetails WHERE UserID NOT IN (SELECT UserID FROM friends WHERE friends.UserID=:UserID OR friends.Friend=:Friend) AND UserID!=:User");
$msg->execute(array(
'UserID'=>$suid,
'Friend'=>$suid,
'User'=>$suid
));
$msgcount= $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$listres = $pdo->prepare("SELECT * FROM userdetails WHERE UserID NOT IN (SELECT UserID FROM friends WHERE friends.UserID=:UserID OR friends.Friend=:Friend) AND UserID!=:User ORDER BY Created DESC LIMIT $start, $perpage");	
$listres->execute(array(
'UserID'=>$suid,
'Friend'=>$suid,
'User'=>$suid
));
if($listres->rowCount() == 0){
echo $peopleemptyalert;
}	
while($frow = $listres->fetch()){
$fusrid = $frow['UserID'];
$fusrnme = $frow['Username'];
$ffname = $frow['Firstname'];
$flname = $frow['Lastname'];
$fimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$fimgresult->execute(array('UserID'=>$fusrid));
while($imgrow = $fimgresult->fetch()){
$postimg = $imgrow['Image'];
$postimgthumb = $imgrow['Thumb'];
echo "<div class='friendbox'>";
echo "<div id='randompeople'><img align='left' id='profilecrop' src='$postimgthumb' /></div>";
echo "<p>$ffname $flname<br /><font id='postmessage'>$fusrnme</font></p>";
echo "<form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$fusrnme' />";
echo "<input type='submit' name='reply' id='addf' value='Send Message'>";
echo "</form>";
echo "<form action='sendrequest.php' method='POST'>";
echo "<input type='hidden' name='friendname' value='$fusrid' />";
echo "<input type='submit' name='sendreq' id='addf' value='Add Friend'>";
echo "</form>";
echo "</div>";
}
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

<div id="notification">
<h5>Random People</h5>
<?php
$randppl = $pdo->prepare("SELECT * FROM userdetails WHERE UserID NOT IN (SELECT UserID FROM friends WHERE friends.UserID=:UserID OR friends.Friend=:Friend) AND UserID!=:User ORDER BY RAND() LIMIT 6");
$randppl->execute(array(
				'UserID'=>$suid,
				'Friend'=>$suid,
				'User'=>$suid
				));
if($randppl->rowCount() == 0){
echo "<p>No people found</p>";
}
$rprow = $randppl->fetch();
$rpid = $rprow['UserID'];
$rpun = $rprow['Username'];
$rpimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$rpimgresult->execute(array('UserID'=>$rpid));
while($rpimgrow = $rpimgresult->fetch()){
$rpimg = $rpimgrow['Thumb'];
echo "<table class='rpeople'>";
echo "<tr><td rowspan='2'><div id='randompeople'><img id='profilecrop' src='$rpimg' /></div></td>";
echo "<td colspan='2'><font id='rpun'>$rpun</font></td></tr>";
echo "<tr><td><form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$rpun' />";
echo "<input type='submit' name='reply' id='addrpf' value='Message'>";
echo "</form></td>";
echo "<td><form action='sendrequest.php' method='POST'>";
echo "<input type='hidden' name='friendname' value='$rpid' />";
echo "<input type='submit' name='sendreq' id='addrpf' value='Add Friend'>";
echo "</form></td></tr>";
echo "</table>";
}
?>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
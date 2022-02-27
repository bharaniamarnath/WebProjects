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
<title>Baffoons - Friends</title>
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
<li><a id="onlink" href="friends.php">Friends</a></li>
<li><a href="people.php">People</a></li>
<li><a href="friendrequest.php">Friend Requests</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<?php 
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM friends WHERE UserID=:UserID");
$msg->execute(array('UserID'=>$suid));
$msgcount= $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$listres = $pdo->prepare("SELECT * FROM friends WHERE UserID=:UserID ORDER BY UserID LIMIT $start, $perpage");
$listres->execute(array('UserID'=>$suid));
if($listres->rowCount()==0){
echo $nofrndsalert;
}
while($frow = $listres->fetch()){
$fusrnme = $frow['Friend'];
$_SESSION['fprofile']=$fusrnme;
$frnddet = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$frnddet->execute(array('UserID'=>$fusrnme));
while($fdrow = $frnddet->fetch()){
$ffname = $fdrow['Firstname'];
$flname = $fdrow['Lastname'];
$funame = $fdrow['Username'];
$fgend = $fdrow['Gender'];
$fimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$fimgresult->execute(array('UserID'=>$fusrnme));
while($imgrow = $fimgresult->fetch()){
$postimg = $imgrow['Image'];
$postimgthumb = $imgrow['Thumb'];
echo "<div class='friendbox'>";
echo "<div id='randompeople'><img align='left' id='profilecrop' src='$postimgthumb' /></div>";
echo "<p>$ffname $flname<br /><font id='postmessage'>$funame</font></p>";
echo "<form action='viewfriend.php' method='POST'>";
echo "<input type='hidden' name='viewpro' value='$fusrnme' />";
echo "<input type='submit' name='viewprofile' value='View Profile'>";
echo "</form>";
echo "<form action='deletefriend.php' method='POST'>";
echo "<input type='hidden' name='delfrnd' value='$fusrnme' />";
echo "<input type='submit' name='deletefriend' value='Remove Friend'>";
echo "</form>";
echo "</div>";
}
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
</div>
</div>

<div id="notification">
<h5>Random Friends</h5>
<?php
$randppl = $pdo->prepare("SELECT * FROM friends WHERE UserID=:UserID ORDER BY RAND() LIMIT 6");
$randppl->execute(array('UserID'=>$suid));
if($randppl->rowCount() == 0){
echo "<p>No friends found</p>";
}
while($rprow = $randppl->fetch()){
$rfuid = $rprow['Friend'];
$rfd = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$rfd->execute(array('UserID'=>$rfuid));
$rfrow = $rfd->fetch();
$rfun = $rfrow['Username'];
$rfffname = $rfrow['Firstname'];
$rflname = $rfrow['Lastname'];
$rfimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$rfimgresult->execute(array('UserID'=>$rfuid));
$rfimgrow = $rfimgresult->fetch();
$rfpostimgthumb = $rfimgrow['Thumb'];
echo "<table class='rpeople'>";
echo "<tr><td rowspan='2'><div id='randompeople'><img id='profilecrop' src='$rfpostimgthumb' /></div></td>";
echo "<td colspan='2'><font id='rpun'>$rfun</font></td></tr>";
echo "<tr><td><form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$rfun' />";
echo "<input type='submit' name='reply' id='addrpf' value='Message'>";
echo "</form></td>";
echo "<td><form action='viewfriend.php' method='POST'>";
echo "<input type='hidden' name='viewpro' value='$rfuid' />";
echo "<input type='submit' id='addrpf' name='viewprofile' value='View Profile'>";
echo "</form></td></tr>";
echo "</table>";
}
?>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
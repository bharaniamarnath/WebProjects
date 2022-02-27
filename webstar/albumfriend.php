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
$fproid = $_GET['faid'];
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
<li><a id="onlink" href="profile.php">Profile</a></li>
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
<li><a href="viewprofile.php?fpid=<?php echo $fproid; ?>">Profile</a></li>
<li><a id="onlink" href="albumfriend.php">Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php
$perpage = 9;
$fproaid = $_GET['faid'];
$msg = $pdo->prepare("SELECT COUNT(*) FROM photodetails WHERE Username=:Username");
$msg->execute(array('Username'=>$fproaid));
$msgcount = $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$photores = $pdo->prepare("SELECT * FROM photodetails WHERE Username=:Username ORDER BY Date DESC LIMIT $start, $perpage");
$photores->execute(array('Username'=>$fproaid));
if($photores->rowCount()==0){
echo $nofrndphotosalert;
}
while($phrow = $photores->fetch()){
$phuid = $phrow['ID'];
$phunme = $phrow['Username'];
$phimg = $phrow['Photo'];
$phthumb = $phrow['Thumb'];
$phname = $phrow['Filename'];
$phdate = $phrow['Date'];
$phdes = $phrow['Description'];
echo "<h3 id='aboutme'>Private Photos - $phunme</h3>";
echo "<table class='photos'>";
echo "<tr>";
echo "<td>";
echo "<a href='friendphotoview.php?imgid=$phuid'><img src='$phthumb' id='photoimage'></img>";
echo "</td>";
echo "</tr>";
echo "</table>";
}
?>
<div style="display: block; clear: both;"></div>
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

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
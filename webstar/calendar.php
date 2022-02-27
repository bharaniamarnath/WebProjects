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
<title>Baffoons - Calendar</title>
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
<li><a href="profile.php">Profile</a></li>
<li><a id="onlink" href="calendar.php">calendar</a></li>
<li><a href="activities.php">Activities</a></li>
<li><a href="addevent.php">Add Events</a></li>
</ul>
</div>
</div>
<div class="messageboard">
<?php
$perpage = 10;
$msg = $pdo->prepare("SELECT * FROM events WHERE UserID=:UserID");
$msg->execute(array('UserID'=>$suid));
$msgcount= $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$listevent = $pdo->prepare("SELECT * FROM events WHERE UserID=:UserID ORDER BY Included DESC LIMIT $start, $perpage");
$listevent->execute(array('UserID'=>$suid));
if($listevent->rowCount()==0){
	echo $emptyeventalert;
}
while($erow = $listevent->fetch()){
$evname = $erow['Event'];
$evday = $erow['Date'];
$evtype = $erow['Type'];
$evdes = $erow['Description'];
$evinc = $erow['Included'];
echo "<table class='calendar'>";
echo "<tr>";
echo "<td colspan='2'><h3>
$evname</h3></td>";
echo "<td class='eventlist' style='text-align: right;'>$evday</td>";
echo "</tr>";
echo "<tr>";
echo "<td class='eventlist'>$evtype</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='3'>$evdes</td>";
echo "</tr>";
echo "<form action='eventdelete.php' method='POST'>";
echo "<tr>";
echo "<input type='hidden' name='evntnme' value='$evname' />";
echo "<input type='hidden' name='evntdte' value='$evday' />"; 
echo "<td colspan='3'><input type='submit' id='photobutton' name='delevent' value='Delete Event' style='float:right;'/></td>";
echo "</tr>";
echo "</form>";
echo "</table>";
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
<h5>Random Events</h5>
<?php
$eventnotify = $pdo->prepare("SELECT * FROM events WHERE UserID = :UserID ORDER BY RAND() LIMIT 6");
$eventnotify->execute(array('UserID'=>$suid));
if($eventnotify->rowCount() == 0){
echo "<p>No events found</p>";
}
while($rerow = $eventnotify->fetch()){
$rename = $rerow['Event'];
$redate = $rerow['Date'];
echo "<table><tr><td><p>$rename</td><td id='redate'>$redate</td></tr></table>";
}
?>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>

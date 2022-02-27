<?php
session_start();
include('includes/connect.php');
include('includes/class.profile.php');
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php include('includes/header.php'); ?>

<div class="col-md-3">
<div class="row panel-board"><div class="col-md-4"><?php echo "<a href='profile.php'><img src='$thumbloc' class='img-responsive'></a>"; ?></div><div class="col-md-8"><h5><?php echo $fname . ' ' . $lname; ?><br /><small><?php echo $usrnme; ?><br /><?php echo $mail; ?></small></h5></div></div>
<div class="row">
<div class="col-md-12">
<div class="list-group">
<a class="list-group-item" href="main.php"><span class='glyphicon glyphicon-home'></span> Home</a>
<a class="list-group-item active" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
<a class="list-group-item" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
<a class="list-group-item" href="photos.php"><span class='glyphicon glyphicon-picture'></span> Photos</a>
<a class="list-group-item" href="inbox.php"><span class='glyphicon glyphicon-envelope'></span> Messages</a>
<a class="list-group-item" href="groups.php"><span class='glyphicon glyphicon-th'></span> Groups</a>
<a class="list-group-item" href="account.php"><span class='glyphicon glyphicon-lock'></span> Account</a>
</div>
</div>
</div>		
</div>

<div class="col-md-6">
<div class="row">
<div class="col-md-12">
<ul class="nav nav-pills nav-justified">
<li><a href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a></li>
<li class="active"><a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span> calendar</a></li>
<li><a href="activities.php"><span class='glyphicon glyphicon-th-large'></span> Activities</a></li>
<li><a href="addevent.php"><span class='glyphicon glyphicon-star'></span> Event</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-calendar'></span> Calendar</h3>
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
echo "<div class='panel panel-default'>";
echo "<div class='panel-heading'><h4>$evname</h4></div>";
echo "<div class='panel-body'>";
echo "<h4>$evday</h4>";
echo "<h6>$evtype</h6>";
echo "<p class='text-default lead'>$evdes</p>";
echo "<form action='eventdelete.php' method='POST'>";
echo "<input type='hidden' name='evntnme' value='$evname' />";
echo "<input type='hidden' name='evntdte' value='$evday' />"; 
echo "<input type='submit' class='btn btn-danger btn-sm pull-right' name='delevent' value='Delete' />";
echo "</form>";
echo "</div>";
echo "</div>";
}
?>
</div>
<?php
echo "<ul class='pagination'>";
if($pages>=1 && $page<=$pages){
for($x = 1; $x <= $pages ; $x++){
echo ($x == $page) ? "<li><a id='selected' href='?page=$x'>$x</a> </li>" : "<li><a id='notselected' href='?page=$x'>$x</a> </li>";	
}
}
echo "</ul>";
?>
</div>
</div>

<div class="row">
<div class="col-md-3">
<div class="panel panel-warning"><div class="panel-heading">Random Events</div>
<div class="panel-body">
<?php
$eventnotify = $pdo->prepare("SELECT * FROM events WHERE UserID = :UserID ORDER BY RAND() LIMIT 6");
$eventnotify->execute(array('UserID'=>$suid));
if($eventnotify->rowCount() == 0){
echo "No events added";
}
while($rerow = $eventnotify->fetch()){
$rename = $rerow['Event'];
$redate = $rerow['Date'];
echo "<h5>$rename<br /><small>$redate</small></h5>";
}
?>
</div>
</div>
</div>
</div>

<div class="row footer">
<div class="col-md-12">
<a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a>
<br />
&copy;Copyrights 2013. Baffoons Network.
</div>
</div>

</div>
</div>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

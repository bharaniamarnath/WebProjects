<?php
session_start();
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
<a class="list-group-item" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
<a class="list-group-item active" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
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
<li><a href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a></li>
<li class="active"><a href="people.php"><span class='glyphicon glyphicon-globe'></span> People</a></li>
<li><a href="friendrequest.php"><span class='glyphicon glyphicon-bell'></span> Friend Requests</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-globe'></span> People</h3>
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
echo "<div class='row post-message'><div class='col-md-3 col-xs-5'><div class='post-thumbnail'><img class='img-responsive' src='$postimgthumb' /></div></div>";
echo "<div class='col-md-9 col-xs-7'>";
echo "<h5>$ffname $flname<h5><h6>$fusrnme</h6>";
echo "<div class='row'><div class='col-md-4'>";
echo "<form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$fusrnme' />";
echo "<button class='btn btn-primary btn-sm' type='submit' name='reply'>Send Message</button>";
echo "</form>";
echo "</div>";
echo "<div class='col-md-8'>";
echo "<form action='sendrequest.php' method='POST'>";
echo "<input type='hidden' name='friendname' value='$fusrid' />";
echo "<button class='btn btn-success btn-sm' type='submit' name='sendreq'>Add Friend</button>";
echo "</form>";
echo "</div></div>";
echo "</div>";
echo "</div>";
}
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

<div class="col-md-3">
<div class="panel panel-danger">
<div class="panel-heading"><span class='glyphicon glyphicon-globe'></span> Random People</div>
<div class="panel-body">
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
while($rprow = $randppl->fetch()){
$rpid = $rprow['UserID'];
$rpun = $rprow['Username'];
$rpimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$rpimgresult->execute(array('UserID'=>$rpid));
while($rpimgrow = $rpimgresult->fetch()){
$rpimg = $rpimgrow['Thumb'];
echo "<div class='row'><div class='col-md-5 col-xs-5'><div class='post-thumbnail-sm'><img class='img-responsive' src='$rpimg' /></div></div>";
echo "<div class='col-md-7 col-xs-7'><h6>$rpun</h6>";
echo "<form action='sendrequest.php' method='POST'>";
echo "<input type='hidden' name='friendname' value='$rpid' />";
echo "<input class='btn btn-danger btn-xs' type='submit' name='sendreq' value='Add Friend'>";
echo "</form>";
echo "</div>";
echo "</div>";
}
}
?>
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
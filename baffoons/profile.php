<?php
session_start();
include('includes/connect.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
$proresult = $pdo->prepare("SELECT * FROM personaldetails WHERE UserID=:UserID");
$proresult->execute(array('UserID'=>$suid));
while($prow = $proresult->fetch())
{
$userid = $prow['UserID'];
$occ = $prow['Occupation'];
$cont = $prow['Contact'];
$city = $prow['City'];
$cntry = $prow['Country'];
$schl = $prow['School'];
$wrk = $prow['Work'];
$lang = $prow['Language'];
$marital = $prow['Marital'];
$abtme = $prow['About'];
if($cont == 0){
$cont = "";
}
if($abtme == ""){
$abtme = "Hello, I am ".$fname." ".$lname;
}	
}
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
<li class="active"><a href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a></li>
<li><a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span> calendar</a></li>
<li><a href="activities.php"><span class='glyphicon glyphicon-th-large'></span> Activities</a></li>
<li><a href="addevent.php"><span class='glyphicon glyphicon-star'></span> Event</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-user'></span> Profile</h3>
<div class="row">
<div class="col-md-4"><?php echo "<a href='imageupload.php'><img src='$imgloc' class='img-responsive thumbnail' /></a>"; ?></div><div class="col-md-8"><h3><?php echo $fname . " ". $lname; ?></h3></div>
</div>
<div class="row"><div class="panel panel-primary"><div class="panel-heading">About Me:</div><div class="panel-body"><?php echo $abtme; ?></div></div>

<div class="panel panel-info"><div class="panel-heading">Basic</div>
<div class="panel-body">
<div class="row"><div class="col-md-4"><strong>Username:</strong></div><div class="col-md-8"><?php echo $usrnme; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Gender:</strong></div><div class="col-md-8"><?php echo $gend; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Date of Birth:</strong></div><div class="col-md-8"><?php echo $dob; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Age:</strong></div><div class="col-md-8"><?php echo $age; ?></div>
</div>
</div>
</div>

<div class="panel panel-warning"><div class="panel-heading">Contact</div>
<div class="panel-body">
<div class="row"><div class="col-md-4"><strong>City:</strong></div><div class="col-md-8"><?php echo $city; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Country:</strong></div><div class="col-md-8"><?php echo $cntry; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Contact:</strong></div><div class="col-md-8"><?php echo $cont; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Email:</strong></div><div class="col-md-8"><?php echo $mail; ?></div>
</div>
</div>
</div>

<div class="panel panel-default"><div class="panel-heading">Professional</div>
<div class="panel-body">
<div class="row"><div class="col-md-4"><strong>Occupation:</strong></div><div class="col-md-8"><?php echo $occ; ?></div></div>
<div class="row"><div class="col-md-4"><strong>School:</strong></div><div class="col-md-8"><?php echo $schl; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Work Place:</strong></div><div class="col-md-8"><?php echo $wrk; ?></div></div>
</div>
</div>

<div class="panel panel-danger"><div class="panel-heading">Personal</div>
<div class="panel-body">
<div class="row"><div class="col-md-4"><strong>Languages:</strong></div><div class="col-md-8"><?php echo $lang; ?></div></div>
<div class="row"><div class="col-md-4"><strong>Marital Status:</strong></div><div class="col-md-8"><?php echo $marital; ?></div></div>
</div>
</div>

<a class='btn btn-danger pull-right' type='button' href='updateprofile.php'>Edit Profile</a>
</div>
</div>
</div>
</div>

<div class="col-md-3">
<ul class="nav nav-pills nav-justified"><li class="active"><a href="profile.php"><span class="glyphicon glyphicon-heart"></span> Favourites</a></li></ul>
<br />
<?php
$getfavs = $pdo->prepare("SELECT * FROM favorites WHERE UserID=:UserID");
$getfavs->execute(array('UserID'=>$suid));
while($gfrow = $getfavs->fetch()){
$gfacts = $gfrow['Activities'];
$gffoods = $gfrow['Foods'];
$gfmovies = $gfrow['Movies'];
$gfmusic = $gfrow['Music'];
$gfbooks = $gfrow['Books'];
$gfgames = $gfrow['Games'];
$gfpeople = $gfrow['People'];
echo "<div class='panel panel-default'><div class='panel-heading'>Activities</div><div class='panel-body'>".$gfacts."</div></div>";
echo "<div class='panel panel-success'><div class='panel-heading'>Foods</div><div class='panel-body'>".$gffoods."</div></div>";
echo "<div class='panel panel-primary'><div class='panel-heading'>Movies</div><div class='panel-body'>".$gfmovies."</div></div>";
echo "<div class='panel panel-info'><div class='panel-heading'>Music</div><div class='panel-body'>".$gfmusic."</div></div>";
echo "<div class='panel panel-warning'><div class='panel-heading'>Books</div><div class='panel-body'>".$gfbooks."</div></div>";
echo "<div class='panel panel-danger'><div class='panel-heading'>Games</div><div class='panel-body'>".$gfgames."</div></div>";
echo "<div class='panel panel-success'><div class='panel-heading'>People</div><div class='panel-body'>".$gfpeople."</div></div>";
}
?>
<a class='btn btn-success pull-right' href="favorites.php">Update Favorites</a>
</div>


<div class="row footer">
<div class="col-md-12">
<a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a>
<br />
&copy;Copyrights 2013. Baffoons Network.
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
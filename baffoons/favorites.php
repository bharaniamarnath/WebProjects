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
<?php
$profavresult = $pdo->prepare("SELECT * FROM favorites WHERE UserID=:UserID");
$profavresult->execute(array('UserID'=>$suid));
$fvrow = $profavresult->fetch();
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
<h3 class="page-header"><span class='glyphicon glyphicon-heart'></span> Favourites</h3>
<form action="updatefavorites.php" method="POST">
<div class="form-group"><label for=" ">Favorite Activities/Hobbies:</label><textarea class="form-control" name="favacts" id="favacts" rows="5" cols="30"><?php echo $fvrow['Activities']; ?></textarea></div>	
<div class="form-group"><label for=" ">Favorite Foods/Cuisines:</label><textarea class="form-control" name="favfoods" id="favfoods" rows="5" cols="30"><?php echo $fvrow['Foods']; ?></textarea></div>
<div class="form-group"><label for=" ">Favorite Movies/TV Shows:</label><textarea class="form-control" name="favmovies" id="favmovies" rows="5" cols="30"><?php echo $fvrow['Movies']; ?></textarea></div>
<div class="form-group"><label for=" ">Favorite Music/Songs:</label><textarea class="form-control" name="favmusic" id="favmusic" rows="5" cols="30"><?php echo $fvrow['Music']; ?></textarea></div>
<div class="form-group"><label for=" ">Favorite Books/Stories:</label><textarea class="form-control" name="favbooks" id="favbooks" rows="5" cols="30"><?php echo $fvrow['Books']; ?></textarea></div>
<div class="form-group"><label for=" ">Favorite Games/Sports:</label><textarea class="form-control" name="favgames" id="favgames" rows="5" cols="30"><?php echo $fvrow['Games']; ?></textarea></div>
<div class="form-group"><label for=" ">Favorite People/Characters:</label><textarea class="form-control" name="favpeople" id="favpeople" rows="5" cols="30"><?php echo $fvrow['People']; ?></textarea><br />
<input class="btn btn-success btn-lg pull-right" type="submit" name="updatefav" id="updatefav" value="Update Favorites" />
</form>
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

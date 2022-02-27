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
<li><a href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a></li>
<li><a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span> calendar</a></li>
<li><a href="activities.php"><span class='glyphicon glyphicon-th-large'></span> Activities</a></li>
<li class="active"><a href="addevent.php"><span class='glyphicon glyphicon-star'></span> Event</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-calendar'></span> Add Event</h3>

<form action="eventsave.php" method="POST">
<div class="form-group"><label for=" ">Event Name:</label><input class="form-control" type="text" name="eventname"/></div>
<div class="form-group"><label for=" ">Event Date:</label>
<div class="row">
<div class="col-md-4">
<select class="form-control" name="edate">
<option value="">Date</option>
<?php for($i=1;$i<=31;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select></div>
<div class="col-md-4">
<select class="form-control" name="emonth">
<option value="">Month</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select></div>
<div class="col-md-4">
<select class="form-control" name="eyear">
<option value="">Year</option>
<?php for($i=1910;$i<=date('Y');$i++):?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select></div>
</div></div>
<div class="form-group"><label for=" ">Event Type:</label><select class="form-control" name="eventtype">
<option  value=""/>
<option value="Birthday">Birthday</option>
<option value="Personal">Personal</option>
<option value="School">School</option>
<option value="Work">Work</option>
<option value="Festival">Festival</option>
<option value="Public">Public</option>
<option value="National">National</option>
<option value="World">World</option>
<option value="Sport">Sport</option>
<option value="Media">Media</option>
<option value="Others">Others</option>
</select>
</div>
<div class="form-group"><label for=" ">Event Description:</label><textarea class="form-control" name="eventdes" rows="5" cols="30"></textarea></div>
<input class="btn btn-success btn-lg pull-right" type="submit" name="addeve" value="Add Event"/>
</form>
</div>
</div>
</div>

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
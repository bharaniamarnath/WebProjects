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
<li><a href="calendar.php"><span class='glyphicon glyphicon-calendar'></span> calendar</a></li>
<li class="active"><a href="activities.php"><span class='glyphicon glyphicon-th-large'></span> Activities</a></li>
<li><a href="addevent.php"><span class='glyphicon glyphicon-star'></span> Event</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-th-large'></span> Activities</h3>
<div class="row">
<div class="col-md-12">
<form action="activities.php" method="POST">

<div class="row"><div class="col-md-12"><label for=" ">Select activity by year:</label><select class="form-control" name="ayear">
<option value="">Year</option>
<?php for($i=2013;$i<=date('Y');$i++):?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
<input class="btn btn-primary pull-right" type="submit" name="viewyearactivity" id="activitybutton" value="View Year Activity" /></div></div>
<hr>
<div class="row"><div class="col-md-12"><label for=" ">Select activity by month:</label><select class="form-control" name="amonth">
<option value="">Month</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
<input class="btn btn-primary pull-right" type="submit" name="viewmonthactivity" id="activitybutton" value="View Month Activity" /></div></div>

</form>
</div>
</div>
<div class="row">
<div class="col-md-12">
<?php
if(!isset($_POST['viewyearactivity']) && !isset($_POST['viewmonthactivity'])){
echo $noactivityalert;
}	
if(isset($_POST['viewyearactivity'])){
$avyear = $_POST['ayear'];
echo "<h3 class='page-header'><span class='glyphicon glyphicon-th-large'></span> Activities in $avyear</h3>";
$avpost = $pdo->prepare("SELECT * FROM messages WHERE UserID=:UserID AND DATE_FORMAT(Time,'%Y')=:Year ORDER BY Time DESC");
$avpost->execute(array(
'UserID'=>$suid,
'Year'=>$avyear
));
echo "<h4 class='page-header'>Private Posts</h4>";
if($avpost->rowCount()==0){
	echo $noactivityalert;
}
while($avprow = $avpost->fetch()){
$avpuname = $avprow['UserID'];
$avpmsg = $avprow['Message'];
$avptime = $avprow['Time'];
$postud = $pdo->prepare("SELECT * from userdetails WHERE UserID=:UserID");
$postud->execute(array('UserID'=>$avpuname));
while($pudrow = $postud->fetch()){
$avpfname = $pudrow['Firstname'];	
$avplname = $pudrow['Lastname'];
$postthumb = $pdo->prepare("SELECT * from imagedetails WHERE UserID=:UserID");
$postthumb->execute(array('UserID'=>$avpuname));
while($imgrow = $postthumb->fetch()){
$imgthumb = $imgrow['Image'];	
echo "<div class='row post-message'><div class='col-md-3'><img class='img-responsive thumbnail' src='$imgthumb' /></div>";
echo "<div class='col-md-9'>";
echo "<h5>";
echo $avpfname . " " . $avplname;
echo "</h5>";
echo "<p>".$avpmsg."</p>";
echo "<div class='label label-info pull-left'>Posted on: $avptime</div>";
echo "</div>";
echo "</div>";
}
}
}
$avbul = $pdo->prepare("SELECT * FROM bulletin WHERE UserID=:UserID AND DATE_FORMAT(Time,'%Y')=:Year ORDER BY Time DESC");
$avbul->execute(array(
'UserID'=>$suid,
'Year'=>$avyear
));
echo "<h4 class='page-header'>Public Posts</h4>";
	if($avbul->rowCount()==0){
	echo $noactivityalert;
}
while($avbrow = $avbul->fetch()){
$avbuname = $avbrow['UserID'];
$avbmsg = $avbrow['Message'];
$avbtime = $avbrow['Time'];
$bpostud = $pdo->prepare("SELECT * from userdetails WHERE UserID=:UserID");
$bpostud->execute(array('UserID'=>$avpuname));
while($pudrow = $bpostud->fetch()){
$avbfname = $pudrow['Firstname'];	
$avblname = $pudrow['Lastname'];
$postthumb = $pdo->prepare("SELECT * from imagedetails WHERE UserID=:UserID");
$postthumb->execute(array('UserID'=>$avbuname));
while($imgrow = $postthumb->fetch()){
$imgthumb = $imgrow['Image'];	
echo "<div class='row post-message'><div class='col-md-3'><img class='img-responsive thumbnail' src='$imgthumb' /></div>";
echo "<div class='col-md-9'>";
echo "<h5>";
echo $avbfname . " " . $avblname;
echo "</h5>";
echo "<p>".$avbmsg."</p>";
echo "<div class='label label-info pull-left'>Posted on: $avbtime</div>";
echo "</div>";
echo "</div>";
}
}
}

$avphotos = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID AND DATE_FORMAT(Date,'%Y')=:Year ORDER BY Date DESC");
$avphotos->execute(array(
'UserID'=>$suid,
'Year'=>$avyear
));
echo "<font id='asubhead'>Private Images</font>";
if($avphotos->rowCount()==0){
	echo $noactivityalert;
}
while($avirow = $avphotos->fetch()){
$avid = $avirow['ID'];
$aviphoto = $avirow['Photo'];
$avithumb = $avirow['Thumb'];
$aviname = $avirow['Filename'];
$avides = $avirow['Description'];
$avidate = $avirow['Date'];
echo "<table class='photos'>";
echo "<tr>";
echo "<td colspan='3'>";
echo "<div><a class='viewbutton' href='photoview.php?pid=$avid'><img src='$avithumb' id='photoimage'></img></a></div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<form action='photodelete.php' method='POST'>";
echo "<input type='hidden' name='deletepic' value='$aviphoto' />";
echo "<input type='submit' name='picdelete' id='photobutton' value='Delete'>";
echo "</form>";
echo "</td>";
echo "<td>";
echo "<form action='photoedit.php' method='POST'>";
echo "<input type='hidden' name='editpic' value='$aviphoto' />";
echo "<input type='submit' name='picedit' id='photobutton' value='Edit'>";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";
}
echo "<div style='display: block; clear: both;'></div>";
$avpubphotos = $pdo->prepare("SELECT * FROM publicphotos WHERE UserID=:UserID AND DATE_FORMAT(Date,'%Y')=:Year ORDER BY Date DESC");
$avpubphotos->execute(array(
'UserID'=>$suid,
'Year'=>$avyear
));
echo "<font id='asubhead'>Public Images</font>";
if($avpubphotos->rowCount()==0){
	echo $noactivityalert;
}
while($avprow = $avpubphotos->fetch()){
$avpphoto = $avprow['Photo'];
$avpthumb = $avprow['Thumb'];
$avpname = $avprow['Filename'];
$avpdes = $avprow['Description'];
$avpdate = $avprow['Date'];
$avpid = $avprow['ID'];
echo "<table class='photos'>";
echo "<tr>";
echo "<td colspan='3'>";
echo "<div><a href='publicphotoview.php?photoid=$avpid'><img src='$avpthumb' id='photoimage'></img></a></div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<form action='publicphotodelete.php' method='POST'>";
echo "<input type='hidden' name='deletepic' value='$avpphoto' />";
echo "<input type='submit' name='picdelete' id='photobutton' value='Delete'>";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";
}

}

if(isset($_POST['viewmonthactivity'])){
$avmonth = $_POST['amonth'];
if($avmonth == ""){
$avwmonth = "";
}
if($avmonth == 1){
$avwmonth = "January";
}
if($avmonth == 2){
$avwmonth = "February";
}
if($avmonth == 3){
$avwmonth = "March";
}
if($avmonth == 4){
$avwmonth = "April";
}
if($avmonth == 5){
$avwmonth = "May";
}
if($avmonth == 6){
$avwmonth = "June";
}
if($avmonth == 7){
$avwmonth = "July";
}
if($avmonth == 8){
$avwmonth = "August";
}
if($avmonth == 9){
$avwmonth = "September";
}
if($avmonth == 10){
$avwmonth = "October";
}
if($avmonth == 11){
$avwmonth = "November";
}
if($avmonth == 12){
$avwmonth = "December";
}
echo "<h2 id='activityheading'>Activities in $avwmonth</h2>";
$avpost = $pdo->prepare("SELECT * FROM messages WHERE UserID=:UserID AND DATE_FORMAT(Time,'%m')=:Month ORDER BY Time DESC");
$avpost->execute(array(
'UserID'=>$suid,
'Month'=>$avmonth
));
echo "<font id='asubhead'>Private Posts</font>";
if($avpost->rowCount()==0){
	echo $noactivityalert;
}
while($avprow = $avpost->fetch()){
$avpuname = $avprow['UserID'];
$avpmsg = $avprow['Message'];
$avptime = $avprow['Time'];
$postud = $pdo->prepare("SELECT * from userdetails WHERE UserID=:UserID");
$postud->execute(array('UserID'=>$avpuname));
while($pudrow = $postud->fetch()){
$avmfname = $pudrow['Firstname'];	
$avmlname = $pudrow['Lastname'];
$postthumb = $pdo->prepare("SELECT * from imagedetails WHERE UserID=:UserID");
$postthumb->execute(array('UserID'=>$suid));
while($imgrow = $postthumb->fetch()){
$imgthumb = $imgrow['Image'];	
echo "<div class='postbox'>";
echo "<div id='postimg'><img id='profilecrop' src='$imgthumb' /></div>";
echo "<div id='posttime'>Posted on: $avptime</div>";
echo "<h4>";
echo $avmfname . " " . $avmlname;
echo "</h4>";
echo "<font id='postmessage'>".$avpmsg."</font>";
echo "</div>";
}
}
}
$avbul = $pdo->prepare("SELECT * FROM bulletin WHERE UserID=:UserID AND DATE_FORMAT(Time,'%m')=:Month ORDER BY Time DESC");
$avbul->execute(array(
'UserID'=>$suid,
'Month'=>$avmonth
));
echo "<font id='asubhead'>Public Posts</font>";
	if($avbul->rowCount()==0){
	echo $noactivityalert;
}
while($avbrow = $avbul->fetch()){
$avbuname = $avbrow['UserID'];
$avbmsg = $avbrow['Message'];
$avbtime = $avbrow['Time'];
$postud = $pdo->prepare("SELECT * from userdetails WHERE UserID=:UserID");
$postud->execute(array('UserID'=>$avpuname));
while($pudrow = $postud->fetch()){
$avmfname = $pudrow['Firstname'];	
$avmlname = $pudrow['Lastname'];
$postthumb = $pdo->prepare("SELECT * from imagedetails WHERE UserID=:UserID");
$postthumb->execute(array('UserID'=>$suid));
while($imgrow = $postthumb->fetch()){
$imgthumb = $imgrow['Image'];	
echo "<div class='postbox'>";
echo "<div id='postimg'><img id='profilecrop' src='$imgthumb' /></div>";
echo "<div id='posttime'>Posted on: $avbtime</div>";
echo "<h4>";
echo $avmfname . " " . $avmlname;
echo "</h4>";
echo "<font id='postmessage'>".$avbmsg."</font>";
echo "</div>";
}
}
}

$avphotos = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID AND DATE_FORMAT(Date,'%m')=:Month ORDER BY Date DESC");
$avphotos->execute(array(
'UserID'=>$suid,
'Month'=>$avmonth
));
echo "<font id='asubhead'>Private Images</font>";
if($avphotos->rowCount()==0){
	echo $noactivityalert;
}
while($avirow = $avphotos->fetch()){
$aviphoto = $avirow['Photo'];
$avithumb = $avirow['Thumb'];
$aviname = $avirow['Filename'];
$avides = $avirow['Description'];
$avidate = $avirow['Date'];
echo "<table class='photos'>";
echo "<tr>";
echo "<td colspan='3'>";
echo "<div id='photoimage'><img src='$avithumb'></img></div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<form action='photodelete.php' method='POST'>";
echo "<input type='hidden' name='deletepic' value='$aviphoto' />";
echo "<input type='submit' name='picdelete' id='photobutton' value='Delete'>";
echo "</form>";
echo "</td>";
echo "<td>";
echo "<form action='photoedit.php' method='POST'>";
echo "<input type='hidden' name='editpic' value='$aviphoto' />";
echo "<input type='submit' name='picedit' id='photobutton' value='Edit'>";
echo "</form>";
echo "</td>";
echo "<td>";
echo "<form action='photoview.php' method='POST'>";
echo "<input type='hidden' name='viewpic' value='$aviphoto' />";
echo "<input type='submit' name='picview' id='photobutton' value='View'>";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";
}
echo "<div style='display: block; clear: both;'></div>";
$avpubphotos = $pdo->prepare("SELECT * FROM publicphotos WHERE UserID=:UserID AND DATE_FORMAT(Date,'%m')=:Month ORDER BY Date DESC");
$avpubphotos->execute(array(
'UserID'=>$suid,
'Month'=>$avmonth
));
echo "<font id='asubhead'>Public Images</font>";
if($avpubphotos->rowCount()==0){
	echo $noactivityalert;
}
while($avprow = $avpubphotos->fetch()){
$avpphoto = $avprow['Photo'];
$avpthumb = $avprow['Thumb'];
$avpname = $avprow['Filename'];
$avpdes = $avprow['Description'];
$avpdate = $avprow['Date'];
echo "<table class='photos'>";
echo "<tr>";
echo "<td colspan='2'>";
echo "<div id='photoimage'><img src='$avpthumb'></img></div>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<form action='publicphotodelete.php' method='POST'>";
echo "<input type='hidden' name='deletepic' value='$avpphoto' />";
echo "<input type='submit' name='picdelete' id='photobutton' value='Delete'>";
echo "</form>";
echo "</td>";
echo "<td>";
echo "<form action='publicphotoview.php' method='POST'>";
echo "<input type='hidden' name='viewpic' value='$avpphoto' />";
echo "<input type='submit' name='picview' id='photobutton' value='View'>";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";
}		
}
?>
<div style="display: block; clear: both;"></div>
</div>
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
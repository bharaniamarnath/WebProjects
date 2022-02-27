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
<li class="active"><a href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a></li>
<li><a href="people.php"><span class='glyphicon glyphicon-globe'></span> People</a></li>
<li><a href="friendrequest.php"><span class='glyphicon glyphicon-bell'></span> Friend Requests</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-th-list'></span> Friends</h3>
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

echo "<div class='row post-message'><div class='col-md-3 col-xs-4'><a href='viewprofile.php?fpid=$funame'><div class='post-thumbnail'><img align='left' class='img-responsive' src='$postimgthumb' /></a></div></div>";
echo "<div class='col-md-9 col-xs-8'>";
echo "<a href='viewprofile.php?fpid=$funame'><h5>$ffname $flname</h5></a><h6>$funame</h6>";
echo "<div class='row'><div class='col-md-12'>";
echo "<form action='deletefriend.php' method='POST'>";
echo "<input type='hidden' name='delfrnd' value='$fusrnme' />";
echo "<input class='btn btn-danger btn-sm pull-right' type='submit' name='deletefriend' value='Remove Friend'>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
}
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
<div class="panel-heading"><span class='glyphicon glyphicon-th-list'></span> Random Friends</div>
<div class="panel-body">
<?php
$randppl = $pdo->prepare("SELECT * FROM friends WHERE UserID=:UserID ORDER BY RAND() LIMIT 6");
$randppl->execute(array('UserID'=>$suid));
if($randppl->rowCount() == 0){
echo "No friends found";
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
echo "<div class='row'><div class='col-md-5 col-xs-5'><div class='post-thumbnail-sm'><img class='img-responsive' src='$rfpostimgthumb' /></div></div>";
echo "<div class='col-md-7 col-xs-7'><h6>$rfun</h6>";
echo "<input type='hidden' name='toreply' value='$rfun' />";
echo "<input type='submit' name='reply' class='btn btn-danger btn-xs' value='Message'>";
echo "</form>";
echo "</div>";
echo "</div>";
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
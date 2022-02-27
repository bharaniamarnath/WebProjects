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
<a class="list-group-item" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
<a class="list-group-item active" href="photos.php"><span class='glyphicon glyphicon-picture'></span> Photos</a>
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
<li class="active"><a href="photos.php">Private Photos</a></li>
<li><a href="publicphotos.php">Public Photos</a></li>
<li><a href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-picture'></span> Photos</h3>
<?php
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID");
$msg->execute(array('UserID'=>$suid));
$msgcount= $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$photores = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID ORDER BY Date DESC LIMIT $start, $perpage");
$photores->execute(array('UserID'=>$suid));
if($photores->rowCount()==0){
echo $nophotosalert;
}
while($phrow = $photores->fetch()){
$phuid = $phrow['ID'];
$phunme = $phrow['UserID'];
$phimg = $phrow['Photo'];
$phthumb = $phrow['Thumb'];
$phname = $phrow['Filename'];
$phdate = $phrow['Date'];
$phdes = $phrow['Description'];
echo "<div class='col-md-4 col-xs-8'><div class='photo-thumbnail'><a href='photoview.php?pid=$phuid'><img src='$phthumb' class='img-responsive' /></a></div>";
echo "<div class='row'>";
echo "<div class='col-md-6 col-xs-6'>";
echo "<form action='photodelete.php' method='POST'>";
echo "<input type='hidden' name='deletepic' value='$phimg' />";
echo "<button class='btn btn-danger btn-sm' type='submit' name='picdelete'>Delete</button>";
echo "</form>";
echo "</div>";
echo "<div class='col-md-6 col-xs-6'>";
echo "<form action='photoedit.php' method='POST'>";
echo "<input type='hidden' name='editpic' value='$phimg' />";
echo "<button class='btn btn-primary btn-sm' type='submit' name='picedit'>Edit</button>";
echo "</form>";
echo "</div>";
echo "</div>";
echo "</div>";
}
?>
<div class='row'><div class='col-md-12'><a class='btn btn-success pull-right' href='uploadphotos.php'>Upload Photos</a></div></div>
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
</div>

<div class="col-md-3">
<div class="panel panel-info">
<div class="panel-heading"><span class='glyphicon glyphicon-picture'></span> Random Photos</div>
<div class="panel-body">
<?php
$randpp = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID ORDER BY RAND() LIMIT 6");
$randpp->execute(array('UserID'=>$suid));
if($randpp->rowCount() == 0){
echo "No photos available";
}
echo "<div class='row'><div class='col-md-12'>";
while($pprow = $randpp->fetch()){
$rppid = $pprow['ID'];
$rppthumb = $pprow['Thumb'];
$rppimg = $pprow['Photo'];
echo "<div class='col-md-4 random-thumbnail'><a href='photoview.php?pid=$rppid'><img src='$rppthumb' class='img-responsive' /></a></div>";
}
echo "</div>";
echo "</div>";
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
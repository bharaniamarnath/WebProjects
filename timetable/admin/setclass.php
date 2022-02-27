<?php
ob_start();
session_start();
include('includes/connect.php');
if(!isset($_SESSION['admin'])){
header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Time Table Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-8">
<?php 
include('header.php');
?>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<ul class="nav nav-pills">
  <li><a href="main.php">Control Panel</a></li>
  <li><a href="selectdept.php">Add Table</a></li>
  <li><a href="selectclass.php">Add Class</a></li>
</ul>
<h3>Add Classes</h3>
<?php
if(isset($_POST['setclass'])){
if(empty($_POST['subcode']) || empty($_POST['staff'])){
echo "<div class='alert alert-info'>Subject and staff field is required to set a class period</div>";
echo "<a class='btn btn-default pull-right' href='addclass.php?cid=".$_POST['bid']."'>Back</a>";
exit();
}
$cntprd = $pdo->prepare("SELECT * FROM periods WHERE subcode=:csubcode AND bid=:cbid");
$cntprd->execute(array(
				"csubcode"=>$_POST['subcode'],
				"cbid"=>$_POST['bid']
				));
if($cntprd->rowCount() > 6){
echo "<div class='alert alert-info'>The subject exceeds more than six periods per week</div>";
echo "<a class='btn btn-default pull-right' href='addclass.php?cid=".$_POST['bid']."'>Back</a>";
}
$chkstf = $pdo->prepare("SELECT * FROM periods WHERE staff=:cstaff AND pday=:cpday AND period=:cperiod");
$chkstf->execute(array(
				"cstaff"=>$_POST['staff'],
				"cpday"=>$_POST['pday'],
				"cperiod"=>$_POST['prd']
				));
if($chkstf->rowCount() == 1){
echo "<div class='alert alert-info'>This faculty has already a class on same period</div>";
echo "<a class='btn btn-default pull-right' href='addclass.php?cid=".$_POST['bid']."'>Back</a>";
}
else{
$bid = $_POST['bid'];
$day = $_POST['pday'];
$period = $_POST['prd'];
$subcode = $_POST['subcode'];
$staff = $_POST['staff'];
$gcd = $pdo->prepare("SELECT * FROM branch WHERE Id = :bid");
$gcd->execute(array("bid"=>$bid));
while($gcdrow = $gcd->fetch()){
$deg = $gcdrow['Degree'];
$dept = $gcdrow['Department'];
$yr = $gcdrow['Year'];
}
$insclass = $pdo->prepare("UPDATE periods SET subcode=:subcode, staff=:staff WHERE bid=:bid AND pday=:pday AND period=:period");
$insclass->execute(array(
				"subcode"=>$subcode,
				"staff"=>$staff,
				"bid"=>$bid,
				"pday"=>$day,
				"period"=>$period
				));
if($insclass){
echo "<div class='alert alert-info'>Period $period on $day for class $deg - $dept, $yr year has been updated.</div>";
echo "<a class='btn btn-default pull-right' href='addclass.php?cid=$bid'>Set more classes</a>";
}
else{
echo "<div class='alert alert-info'>Error updating class period. Try later.</div>";
}
}
}
?>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
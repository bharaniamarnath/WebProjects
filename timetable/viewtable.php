<?php
ob_start();
session_start();
include('includes/connect.php');
if(!isset($_SESSION['staff'])){
header("Location: panel.php");
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
  <li><a href="main.php">Menu panel</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<h3>Class Time Table</h3>
<?php
$bid = $_GET['id'];
$getcd = $pdo->prepare("SELECT * FROM branch WHERE Id=:bid");
$getcd->execute(array("bid"=>$bid));
while($gcdrow = $getcd->fetch()){
$degree = $gcdrow['Degree'];
$department = $gcdrow['Department'];
$year = $gcdrow['Year'];
echo "<h3>" . $degree . " - " . $department . ", " . $year . " year</h3>";
echo "<h4>Class Details</h4>";
}
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
$selp = $pdo->prepare("SELECT * FROM schedule");
$selp->execute();
echo "<table class='table table-bordered timetable'>";
echo "<thead><tr>";
echo "<th>Period</th>";
while($sprow = $selp->fetch()){
$sphr = $sprow['period'];
$sptime = $sprow['pstart'] . " to " . $sprow['pend'];
echo "<th>";
echo $sphr;
echo "</th>";
}
echo "</tr>";
$selpt = $pdo->prepare("SELECT * FROM schedule");
$selpt->execute();
echo "<tr><th>Time</th>";
while($sptrow = $selpt->fetch()){
$sptime = $sptrow['pstart'] . " to " . $sptrow['pend'];
echo "<th>";
echo $sptime;
echo "</th>";
}
echo "</tr></thead>";
for($k = 0; $k < count($days); $k++){
echo "<tr>";
echo "<td class='days'>" . $days[$k] . "</td>";
$seltt = $pdo->prepare("SELECT * FROM periods WHERE bid = :bid AND pday = :pday");
$seltt->execute(array(
			"bid"=>$bid,
			"pday"=>$days[$k]
			));
$cnt = 0;
while($stt = $seltt->fetch()){
$ttsub = $stt['subcode'];
echo "<td>" . $ttsub . "</td>";
if($cnt == 1) echo "<td class='days'></td>";
if($cnt == 4) echo "<td class='days'></td>";
$cnt++;
}
echo "</tr>";
}
echo "</table>";
?>
<h4>Subject &amp; Staff Details</h4>
<?php
echo "<table class='table table-bordered timetable'>";
echo "<thead><tr><th>Subject Code</th><th>Subject Name</th><th>Staff Name</th></tr></thead>";
$snsd = $pdo->prepare("SELECT * FROM periods WHERE bid = :sid GROUP BY subcode");
$snsd->execute(array("sid"=>$bid));
while($snsrow = $snsd->fetch()){
$sncode = $snsrow['subcode'];
$snstaff = $snsrow['staff'];
$subtn = $pdo->prepare("SELECT * FROM subjects WHERE subid =:suid");
$subtn->execute(array("suid"=>$sncode));
while($subf = $subtn->fetch()){
$ssubname = $subf['subname'];
$snstn = $pdo->prepare("SELECT * FROM staffs WHERE sid =:stid");
$snstn->execute(array("stid"=>$snstaff));
while($stnf = $snstn->fetch()){
$stfname = $stnf['fname'];
$stlname = $stnf['lname'];
echo "<tr><td>" . $sncode . "</td>";
echo "<td>" . $ssubname . "</td>";
echo "<td>" . $stfname . " " . $stlname . "</td></tr>";
}
}
}
echo "</table>";
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
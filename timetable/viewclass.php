<?php
ob_start();
session_start();
include('includes/connect.php');
if(!isset($_SESSION['staff'])){
header("Location: panel.php");
}
$suname = $_SESSION['staff'];
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
<h3>My Class Schedules</h3>
<?php
echo "<table class='table table-bordered timetable'>";
echo "<thead><tr><th>Subject</th><th>Branch</th><th>Day</th><th>Period</th></tr></thead>";
$stfcode = $pdo->prepare("SELECT * FROM users WHERE username=:username");
$stfcode->execute(array("username"=>$suname));
while($stfrow = $stfcode->fetch()){
$stfid = $stfrow['Id'];
$stfprd = $pdo->prepare("SELECT * FROM periods WHERE staff=:staff");
$stfprd->execute(array("staff"=>$stfid));
while($sprow = $stfprd->fetch()){
$sbid = $sprow['bid'];
$spday = $sprow['pday'];
$speriod = $sprow['period'];
$ssubcode = $sprow['subcode'];
$getsub = $pdo->prepare("SELECT * FROM subjects WHERE subid=:subcode");
$getsub->execute(array("subcode"=>$ssubcode));
while($gsrow = $getsub->fetch()){
$gsname = $gsrow['subname'];
$gbd = $pdo->prepare("SELECT * FROM branch WHERE Id=:id");
$gbd->execute(array("id"=>$sbid));
while($gbdrow = $gbd->fetch()){
$gdeg = $gbdrow['Degree'];
$gdep = $gbdrow['Department'];
$gyr = $gbdrow['Year'];
$sdept = $gdeg . " - " . $gdep . ", " . $gyr . " year";
echo "<tr><td>" . $ssubcode . " - " . $gsname . "</td>";
echo "<td>" .  $sdept . "</td>";
echo "<td>" .  $spday . "</td>";
echo "<td>" .  $speriod . "</td></tr>";
}
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
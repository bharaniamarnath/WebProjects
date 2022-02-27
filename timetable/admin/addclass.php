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
$cid = $_GET['cid'];
$chkcls = $pdo->prepare("SELECT * FROM periods WHERE bid=:chbid");
$chkcls->execute(array("chbid"=>$cid));
if($chkcls->rowCount() == 0){
echo "<div class='alert alert-info'>Schedule table has not been set to this class. Add table before adding periods.</div>";
}
else{
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
$gcd = $pdo->prepare("SELECT * FROM branch WHERE Id = :bid");
$gcd->execute(array("bid"=>$cid));
while($gcdrow = $gcd->fetch()){
echo "<h2>Class Schedule - " . $gcdrow['Degree'] . " - " . $gcdrow['Department'] . ", " . $gcdrow['Year']  . " year</h2>";
}
for($i = 0; $i < count($days); $i++){
echo "<table class='table table-striped'>";
echo "<thead><tr><th colspan='4'>" . $days[$i] . "</th></tr></thead>";
echo "<thead><tr><th>Hour</th><th>Subject</th><th>Staff</th><th>Actions</th></tr></thead>";
for($j = 1; $j <= 8; $j++){
echo "<form action='setclass.php' method='POST'>";
echo "<tr><td>" . $j . "</td>";
echo "<td>";
$selsub = $pdo->prepare("SELECT * FROM subjects");
$selsub->execute();
$sub = $pdo->prepare("SELECT * FROM periods WHERE bid=:bid AND pday=:pday AND period=:period");
$sub->execute(array(
			"bid"=>$cid,
			"pday"=>$days[$i],
			"period"=>$j
			));
echo "<select class='form-control' name='subcode'>";
while($subrow = $sub->fetch()){
$subrowcode = $subrow['subcode'];
$selsubname = $pdo->prepare("SELECT * FROM subjects WHERE subid=:subid");
$selsubname->execute(array("subid"=>$subrowcode));
while($ssnrow = $selsubname->fetch()){
echo "<option value='".$ssnrow['subid']."'>" . $ssnrow['subname'] . "</option>";
}
}
echo "<option value=''>----Select----</option>";
while($srow = $selsub->fetch()){
echo "<option value='".$srow['subid']."'>" . $srow['subname'] . "</option>";
}
echo "</select></td>";
echo "<td>";
$selst = $pdo->prepare("SELECT * FROM staffs");
$selst->execute();
$stf = $pdo->prepare("SELECT * FROM periods WHERE bid=:bid AND pday=:pday AND period=:period");
$stf->execute(array(
			"bid"=>$cid,
			"pday"=>$days[$i],
			"period"=>$j
			));
echo "<select class='form-control' name='staff'>";
while($stfrow = $stf->fetch()){
$stfrowcode = $stfrow['staff'];
$selstfname = $pdo->prepare("SELECT * FROM staffs WHERE sid=:sid");
$selstfname->execute(array("sid"=>$stfrowcode));
while($stfrow = $selstfname->fetch()){
echo "<option value='".$stfrow['sid']."'>" . $stfrow['fname'] . " " . $stfrow['lname'] . "</option>";
}
}
echo "<option value=''>----Select----</option>";
while($strow = $selst->fetch()){
echo "<option value='".$strow['sid']."'>" . $strow['fname'] . " " . $strow['lname'] . "</option>";
}
echo "</select></td>";
echo "<input type='hidden' name='bid' value='$cid'>";
echo "<input type='hidden' name='pday' value=".$days[$i].">";
echo "<input type='hidden' name='prd' value='$j'>";
echo "<td><input class='btn btn-default' type='submit' value='Set Class' name='setclass'></td></tr>";
echo "</form>";
}
echo "</table>";
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
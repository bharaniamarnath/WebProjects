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
<h3>Add Schedule</h3>
<?php
if(isset($_GET['id'])){
$id = $_GET['id'];
$checkav = $pdo->prepare("SELECT * FROM periods WHERE bid = :bid LIMIT 1");
$checkav->execute(array("bid"=>$id));
if($checkav->fetchColumn()){
echo "<div class='alert alert-info'>Schedule for selected class already exists</div>";
echo "<a class='btn btn-default pull-right' href='main.php'>Go to Control Panel</a>";
exit();
}
$days = array("Monday","Tuesday","Wednesday","Thursday","Friday");
for($j = 0; $j < count($days); $j++){
for($i = 1; $i <= 8; $i++){
$insched = $pdo->prepare("INSERT INTO periods (bid, pday, period) VALUES (:bid, :pday, :period)");
$insched->execute(array(
				"bid"=>$id,
				"pday"=>$days[$j],
				"period"=>$i
				));
}
}
$getcd = $pdo->prepare("SELECT * FROM branch WHERE Id=:bid");
$getcd->execute(array("bid"=>$id));
while($gcdrow = $getcd->fetch()){
$gdegree = $gcdrow['Degree'];
$gdepartment = $gcdrow['Department'];
$gyear = $gcdrow['Year'];
echo "<div class='alert alert-info'>Schedule added to " . $gdegree . " - " . $gdepartment . ", " . $gyear . "</div>";
echo "<a class='btn btn-default pull-right' href='addclass.php?cid=$id'>Add periods to " . $gdegree . " - " . $gdepartment . ", " . $gyear . " year</a>";
}
}
?>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
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
<h3>Select Department</h3>
</div>
</div>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php
$choose = $pdo->prepare("SELECT * FROM branch");
$choose->execute();
echo "<table class='table table-striped'><thead><tr><th>Degree</th><th>Department</th><th>Year</th><th>Action</th></tr></thead>";
while($row = $choose->fetch()){
$id = $row['Id'];
$degree = $row['Degree'];
$department = $row['Department'];
$year = $row['Year'];
echo "<tr><td>" . $degree ."</td>";
echo "<td>" . $department . "</td>";
echo "<td>" . $year . "</td>";
echo "<td><a href='addschedule.php?id=$id'>Add Schedules</a></td></tr>";
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
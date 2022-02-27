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
<h3>Select Department</h3>
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
echo "<td><a class='btn btn-default' href='viewtable.php?id=$id'>View Timetable</a></td></tr>";
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
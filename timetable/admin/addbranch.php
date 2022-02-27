<?php
ob_start();
session_start();
include('includes/connect.php');
if(!isset($_SESSION['admin'])){
header("Location: index.php");
}
$deptsn = array("CSE","IT","ECE","EEE","Mech","Civil","MBA","MCA");
$deptfn = array("Computer Science Engineering","Information Technology","Electronics and Communication Engineering","Electrical and Electronics Engineering","Mechanical Engineering","Civil Engineering","Master of Business Management","Master of Computer Applications");
$years = array("First","Second","Third","Fourth");
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
<h3>Add Branch/Department</h3>
<?php
if(isset($_POST['addbranch'])){
if(empty($_POST['department']) || empty($_POST['year'])){
echo "<div class='alert alert-info'>All fields are mandatory</div>";
}
$checkbr = $pdo->prepare("SELECT * FROM branch WHERE Degree= :Degree AND Department= :Department AND Year= :Year");
$checkbr->execute(array(
				"Degree"=>$_POST['degree'],
				"Department"=>$_POST['department'],
				"Year"=>$_POST['year']
				));
if($checkbr->fetchColumn()){
echo "<div class='alert alert-info'>" . $_POST['degree'] . " " . $_POST['department'] . " " . $_POST['year'] .  " year department already exists in database</div>";
}
else{
$id = rand(000000,999999);
$degree = $_POST['degree'];
$department = $_POST['department'];
$year = $_POST['year'];
$addbr = $pdo->prepare("INSERT INTO branch (Id, Degree, Department, Year) VALUES (:Id, :Degree, :Department, :Year)");
$addbr->execute(array(
				"Id"=>$id,
				"Degree"=>$degree,
				"Department"=>$department,
				"Year"=>$year
				));
if($addbr){
echo "<div class='alert alert-info'>" . $degree ." " . $department . " " . $year ." year department added to the database</div>";
}
}
}
?>
<form action="addbranch.php" method="POST">
<div class="form-group"><label for="graduation">Select Degree *:</label>
<div class="radio">
<label>
<input type="radio" name="degree" value="UG" checked="checked">U.G.
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="degree" value="PG">P.G.
</label>
</div>
</div>
<div class="form-group"><label for="department">Select Department *:</label>
<select name="department" class="form-control">
<option value="" selected="selected">Select</option>
<?php
for($i = 0; $i < count($deptsn); $i++){
echo "<option value=". $deptsn[$i] .">" . $deptfn[$i] . "</option>";
}
?>
</select>
</div>
<div class="form-group"><label for="year">Select Year *:</label>
<select name="year" class="form-control">
<option value="" selected="selected">Select</option>
<?php
for($j = 0; $j < count($years); $j++){
echo "<option value=". $years[$j] .">" . $years[$j] . "</option>";
}
?>
</select>
</div>
<input class="btn btn-default pull-right" type="submit" name="addbranch" value="Add Department" />
</form>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
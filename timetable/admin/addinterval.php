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
<h3>Add Intervals</h3>
<form action="setinterval.php" method="POST">
<div class="form-group"><label for="coll_start_time">College Start Time:</label>
<div class="row">
<div class="col-md-4">
<label for="shour">Hours:</label><select class="form-control" name="shour">
<option value="08">08</option>
<option value="09">09</option>
<option value="10">10</option>
</select>
</div>
<div class="col-md-4">
<label for="sminute">Minutes:</label><select class="form-control" name="sminute">
<option value="00">00</option>
<option value="05">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select>
</div>
</div>
</div>
<hr>
<div class="form-group"><label for="coll_start_time">College End Time:</label>
<div class="row">
<div class="col-md-4">
<label for="ehour">Hours:</label><select class="form-control" name="ehour">
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
</select>
</div>
<div class="col-md-4">
<label for="eminute">Minutes:</label><select class="form-control" name="eminute">
<option value="00">00</option>
<option value="05">05</option>
<option value="10">10</option>
<option value="15">15</option>
<option value="20">20</option>
<option value="25">25</option>
<option value="30">30</option>
<option value="35">35</option>
<option value="40">40</option>
<option value="45">45</option>
<option value="50">50</option>
<option value="55">55</option>
</select>
</div>
</div>
</div>
<hr>
<div class="form-group">
<label for="class_duration">Class Duration:</label>
<div class="row">
<div class="col-md-4">
<select class="form-control" name="duration">
<option value="40 min">40 minutes</option>
<option value="45 min">45 minutes</option>
<option value="50 min">50 minutes</option>
<option value="55 min">55 minutes</option>
<option value="60 min">60 minutes</option>
</select>
</div>
</div>
</div>
<input class="btn btn-default pull-right" type="submit" value="Set Intervals" name="schedule" />
</form>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
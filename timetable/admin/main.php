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
<div class="col-md-8 col-md-offset-2">
<center><h3>Select Menu</h3></center><hr>
<ul class="menubox">
<li><a href="addinterval.php">Set Intervals</a></li>
<li><a href="addbranch.php">Add Department</a></li>
<li><a href="addsubject.php">Add Subject</a></li>
<li><a href="selectdept.php">Add Table</a></li>
<li><a href="selectclass.php">Update Classes</a></li>
<li><a href="logout.php">Log out</a></li>
</ul>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
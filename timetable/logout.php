<?php
ob_start();
session_start();
include('includes/connect.php');
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
<?php
if(isset($_SESSION['staff'])){
	unset($_SESSION['staff']);
	session_destroy();
	echo "<div class='alert alert-info'>Staff logged out successfully.</div><a class='btn btn-default btn-lg pull-right' href='index.php'>Go to Main Index</a>";
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
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
<h3>Add Subject</h3>
<?php
if(isset($_POST['addsub'])){
if(empty($_POST['subcode']) || empty($_POST['subname'])){
echo "<div class='alert alert-info'>All fields are mandatory</div>";
}
$checksb = $pdo->prepare("SELECT * FROM subjects WHERE subid= :subid");
$checksb->execute(array(
				"subid"=>$_POST['subcode']
				));
if($checksb->fetchColumn()){
echo "<div class='alert alert-info'>" . $_POST['subcode'] . " - " . $_POST['subname'] . " subject already exists in database</div>";
}
else{
$subcode = $_POST['subcode'];
$subname = $_POST['subname'];
$inssub = $pdo->prepare("INSERT INTO subjects (subid, subname) VALUES (:subid, :subname)");
$inssub->execute(array(
				"subid"=>$subcode,
				"subname"=>$subname
				));
if($inssub){
echo "<div class='alert alert-info'>" . $subcode . " - " . $subname . " added</div>";
}
else{
echo "<div class='alert alert-info'>Error. Could not add subject. Try Later</div>";
}
}
}
?>
<form action="addsubject.php" method="POST">
<div class="form-group">
<label for="subcode">Subject Code:</label><input class="form-control" type="text" name="subcode" />
</div>
<div class="form-group">
<label for="subcode">Subject Name:</label><input class="form-control" type="text" name="subname" />
</div>
<input class="btn btn-default pull-right" type="submit" name="addsub" value="Add Subject" />

</form>

</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
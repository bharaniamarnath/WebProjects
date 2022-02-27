<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="bluedent india, bluedent chennai, rediscover dentistry" />
<meta name="description" content="Welcome to Bluedent India. Rediscover Dentistry.">
<meta name="copyright" content="&copy; Copyright 2014. Bluedent India. All rights reserved.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Edit Slides</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php
if(isset($_POST['updateSlide'])){
$slideProduct = $_POST['slideProduct'];
$slideImageId = $_POST['simgid'];
$getsinfo = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$getsinfo->execute(array("pid"=>$slideProduct));
while($rowgsi = $getsinfo->fetch()){
$gsipid = $rowgsi['pid'];
$gsiname = $rowgsi['name'];
$gsicat = $rowgsi['category'];
$gsisubcat = $rowgsi['subcategory'];
$gsilink = "images/products/$gsicat/$gsisubcat/thumbs/$gsipid.png";
$usimg = $pdo->prepare("UPDATE sliders SET pid=:pid, name=:name, link=:link WHERE id=:id");
$usimg->execute(array(
				"pid"=>$gsipid,
				"name"=>$gsiname,
				"link"=>$gsilink,
				"id"=>$slideImageId
				));
if($usimg->rowCount() > 0){
	echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Slide image updated successfully</div>";
}
else{
	echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Slide image failed to update</div>";
}
}
}
?>

<table class="table cart">
<thead><tr><th colspan="5">Top Slide</th></tr><tr><th>Position</th><th>Slide</th><th>Name</th><th>Action</th></tr></thead>
<?php
$position = "top";
$except = 'Dental Instruments';
$ts1 = $pdo->prepare("SELECT * FROM sliders WHERE position=:position");
$ts1->execute(array("position"=>$position));
while($rowts1 = $ts1->fetch()){
echo "<form action='".$CP_URL."sliders.php' method='POST'>";
$tsid = $rowts1['id'];
$tssno = $rowts1['slide'];
$tspid = $rowts1['pid'];
$tsname = $rowts1['name'];
$tslink = $rowts1['link'];
echo "<tr><td>$tsid</td><td>$tssno</td>";
$tspro = $pdo->prepare("SELECT * FROM products WHERE category!=:category");
$tspro->execute(array("category"=>$except));
echo "<td><select class='form-control' name='slideProduct'>";
echo "<option value='$tspid'>$tsname</option>";
while($rowtsp = $tspro->fetch()){
$rtspid = $rowtsp['pid'];
$rtspname = $rowtsp['name'];
echo "<option value='$rtspid'>$rtspname</option>";
}
echo "</select></td>";
echo "<td><input type='hidden' name='simgid' value='$tsid' /><input type='submit' class='btn btn-success btn-sm' name='updateSlide' value='Update' /></td></tr>";
echo "</form>";
}
?>
</table>

<table class="table cart">
<thead><tr><th colspan="5">Bottom Slide</th></tr><tr><th>Position</th><th>Slide</th><th>Name</th><th>Action</th></tr></thead>
<?php
$position = "bottom";
$except = 'Dental Instruments';
$ts1 = $pdo->prepare("SELECT * FROM sliders WHERE position=:position");
$ts1->execute(array("position"=>$position));
while($rowts1 = $ts1->fetch()){
echo "<form action='".$CP_URL."sliders.php' method='POST'>";
$tsid = $rowts1['id'];
$tssno = $rowts1['slide'];
$tspid = $rowts1['pid'];
$tsname = $rowts1['name'];
$tslink = $rowts1['link'];
echo "<tr><td>$tsid</td><td>$tssno</td>";
$tspro = $pdo->prepare("SELECT * FROM products WHERE category!=:category");
$tspro->execute(array("category"=>$except));
echo "<td><select class='form-control' name='slideProduct'>";
echo "<option value='$tspid'>$tsname</option>";
while($rowtsp = $tspro->fetch()){
$rtspid = $rowtsp['pid'];
$rtspname = $rowtsp['name'];
echo "<option value='$rtspid'>$rtspname</option>";
}
echo "</select></td><td><input type='hidden' name='simgid' value='$tsid' /><input type='submit' class='btn btn-success btn-sm' name='updateSlide' value='Update' /></td></tr>";
echo "</form>";
}
?>
</table>

<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead>
<form action="<?php echo $CP_URL; ?>editlist.php" method="POST" enctype="multipart/form-data">
<tr><td>Search Product: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</form>
<tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href="<?php echo $CP_URL; ?>dashboard.php">Control Panel</a></td></tr></table>
</div>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

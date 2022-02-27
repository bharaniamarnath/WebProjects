<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://admin.bluedentindia.in/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/panelstyle.css" />
</head>
<body>
<div class="container">
<?php include "panelheader.php"; ?>
<div class='row page-title'><div class='col-md-12'><h2>Add Files</h2></div></div>
<div class="row">
<div class="col-md-12">
<?php
if(isset($_POST['addfile'])){
if(empty($_POST['fname']) || empty($_POST['filecategory'])){
echo "<div class='alert alert-warning'>Valid file name and file category is required</div>";
echo "<a type='button' href='http://admin.bluedentindia.in/addfiles.php' class='btn btn-primary pull-right'>Add Files</a>";
}
else if($name = $_FILES['upfile']['size'] == 0){
echo "<div class='alert alert-warning'>File not chosen to upload or invalid file</div>";
echo "<a type='button' href='http://admin.bluedentindia.in/addfiles.php' class='btn btn-primary pull-right'>Add Files</a>";
}
else{
$fid = rand(000000,999999);
$fname = $_POST['fname'];
$category = $_POST['filecategory'];
$name = $_FILES['upfile']['name'];
$tmp_name = $_FILES['upfile']['tmp_name']; 
$filename = $fid."_".$name;
$filepath = "downloads/$category/$filename";
if(move_uploaded_file($tmp_name,$filepath)){
$addfile = $pdo->prepare("INSERT INTO downloads(fid,name,category,link) VALUES (:fid,:name,:category,:link)");
$addfile->execute(array(
				"fid"=>$fid,
				"name"=>$fname,
				"category"=>$category,
				"link"=>$filepath
				));
if($addfile){
echo "<div class='alert alert-success'>File added to the database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/addfiles.php'>Add More</a></div></div>";
include('footer.php');
exit();
}
else{
echo "<div class='alert alert-danger'>Error adding file to the database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/addfiles.php'>Add Files</a></div></div>";
include('footer.php');
exit();
}
}
}
}	
?>
</div>
</div>
<?php include('panelfooter.php'); ?>

</div>
<script src="http://admin.bluedentindia.in/js/jquery-1.11.1.min.js"></script>
<script src="http://admin.bluedentindia.in/js/bootstrap.min.js"></script>
</body>
</html>
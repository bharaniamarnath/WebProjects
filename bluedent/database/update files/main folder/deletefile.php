<?php
ob_start();
session_start();
include('connect.php');
?>
<?php
if(isset($_POST['addgallery'])){
$progid = $_POST['progid'];
$prod = $pdo->prepare("SELECT name FROM products WHERE pid=:pid");
$prod->execute(array("pid"=>$progid));
while($prow = $prod->fetch()){
$pname = $prow['name'];
}
}
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
<div class='row page-title'><div class='col-md-12'><h2>Delete Files</h2></div></div>
<div class="row">
<div class="col-md-12">
<?php
$fileid = $_POST['fid'];
$selfile = $pdo->prepare("SELECT * FROM downloads WHERE fid=:fid");
$selfile->execute(array("fid"=>$fileid));
while($frow = $selfile->fetch()){
$filelink = $frow['link'];
if(file_exists($filelink)){
unlink($filelink);
$delfile = $pdo->prepare("DELETE FROM downloads WHERE fid=:fid");
$delfile->execute(array("fid"=>$fileid));
if($delfile){
echo "<div class='alert alert-success'>File deleted from downloads section</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/addfiles.php'>Back</a></div></div>";
include('footer.php');
exit();
}
else{
echo "<div class='alert alert-danger'>Error. Could not delete file</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/addfiles.php'>Back</a></div></div>";
include('footer.php');
exit();
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
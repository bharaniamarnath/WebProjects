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
<div class='row page-title'><div class='col-md-12'><h2>Product Images</h2></div></div>
<div class="row">
<div class="col-md-12">
<?php
$imageid = $_GET['imageid'];
$imgproid = $pdo->prepare("SELECT * FROM gallery WHERE imageid=:imageid");
$imgproid->execute(array("imageid"=>$imageid));
while($pirow = $imgproid->fetch()){
$pgid = $pirow['pid'];
}
$imgpath = "images/gallery/$imageid.png";
$thumbimgpath = "images/gallery/thumbs/$imageid.png";
if(file_exists($imgpath)){
if(file_exists($thumbimgpath)){
unlink($imgpath);
unlink($thumbimgpath);
$delimg = $pdo->prepare("DELETE FROM gallery WHERE imageid=:imageid");
$delimg->execute(array("imageid"=>$imageid));
if($delimg){
echo "<div class='alert alert-success'>Image deleted from product gallery</div>";
echo "<form action='addgallery.php' method='POST'><input type='hidden' value='$pgid' name='progid' /><button class='btn btn-primary pull-right' type='submit' name='addgallery'>Back</button></form>";
echo "<a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
exit();
}
else{
echo "<div class='alert alert-danger'>Could not delete image from product gallery</div>";
echo "<a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
exit();
}
}
}
?>

<?php
$dimageid = $_GET['dimageid'];
$dimgproid = $pdo->prepare("SELECT * FROM descriptions WHERE imageid=:imageid");
$dimgproid->execute(array("imageid"=>$dimageid));
while($pirow = $dimgproid->fetch()){
$dpgid = $dpirow['pid'];
$dimgpath = "images/descriptions/$dimageid.png";
$dthumbimgpath = "images/descriptions/thumbs/$dimageid.png";
if(file_exists($dimgpath)){
if(file_exists($dthumbimgpath)){
unlink($dimgpath);
unlink($dthumbimgpath);
$deldimg = $pdo->prepare("DELETE FROM descriptions WHERE imageid=:imageid");
$deldimg->execute(array("imageid"=>$dimageid));
if($deldimg){
echo "<div class='alert alert-success'>Image deleted from product descriptions</div>";
echo "<form action='addgallery.php' method='POST'><input type='hidden' value='$pgid' name='progid' /><button class='btn btn-primary pull-right' type='submit' name='addgallery'>Back</button></form>";
echo "<a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
exit();
}
else{
echo "<div class='alert alert-danger'>Could not delete image from product descriptions</div>";
echo "<a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
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
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
<div class='row page-title'><div class='col-md-12'><h2>Delete Product</h2></div></div>
<div class="row">
<div class="col-md-12">
<?php
$productid = $_GET['proid'];
$procat = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$procat->execute(array("pid"=>$productid));
while($rowpro = $procat->fetch()){
$proname = $rowpro['name'];
$procategory = $rowpro['category'];
$prosubcat = $rowpro['subcategory'];
}
$proimgpath = "images/products/$procategory/$prosubcat/$productid.png";
$prothumbimg = "images/products/$procategory/$prosubcat/thumbs/$productid.png";
if(file_exists($proimgpath)){
unlink($proimgpath);
unlink($prothumbimg);
$delpro = $pdo->prepare("DELETE FROM products WHERE pid=:pid");
$delpro->execute(array("pid"=>$productid));
if($delpro){
$delgal = $pdo->prepare("SELECT * FROM gallery WHERE pid=:pid");
$delgal->execute(array("pid"=>$productid));
while($rowgal = $delgal->fetch()){
$galimgid = $rowgal['imageid'];
$galimgpath = $rowgal['link'];
$galthumbimgpath = "images/gallery/thumbs/$galimgid.png";
if(file_exists($galimgpath)){
if(file_exists($galthumbimgpath)){
unlink($galimgpath);
unlink($galthumbimgpath);
}
}
}
}
$delgaldb = $pdo->prepare("DELETE FROM gallery WHERE pid=:pid");
$delgaldb->execute(array("pid"=>$productid));
if($delgaldb){
echo "<div class='alert alert-success'>Product  <b>" . $proname . "</b> deleted from database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
exit();
}
else{
echo "<div class='alert alert-danger'>Could not delete product <b>" . $proname . "</b>  from database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></div></div>";
include('http://admin.bluedentindia.in/footer.php');
exit();
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
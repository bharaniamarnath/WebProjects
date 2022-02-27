<?php
ob_start();
session_start();
include('includes/connect.php');
include('includes/validateDeleteProduct.php');
//Assign Status variables
$deletestatus = "Product delete status will be displayed here";
//fetch form values
if(isset($_REQUEST['del'])){
$delpid = trim($_REQUEST['del']);
//create classes and objects
$validateDeleteProduct = new validateDeleteProduct();
$deleteProuct = $validateDeleteProduct->deleteProduct($delpid);
//throw exceptions
if($deleteProuct == false){
	$deletestatus = $validateDeleteProduct->deleteFailed();
}
else if($deleteProuct == true){
	$deletestatus = $validateDeleteProduct->deleteSuccess();
}
else{
	$deletestatus = "Error occurred while deleting product.";
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include('header.php'); ?>
<div class="row content">
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Edit Product</h4>
<hr>
</div>
</div>
<div class="row">
<form action="editlist.php" method="POST">
<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2 panel-search">
<div class="input-group">
<input class="form-control" type="text" name="searchpname" placeholder="Enter Product Name" maxlength="25" />
<span class="input-group-btn">
<input class="btn btn-primary" type="submit" name="searchpro" value="Search Product" />
</span>
</div>
</form>
</div>
</div>
<div class="row">
<div class="col-md-3 col-lg-3">
<div class="list-group">
<?php
$selectsec = $pdo->prepare("SELECT DISTINCT section FROM categories ORDER BY section");
$selectsec->execute();
while($ss = $selectsec->fetch()){
$secname = $ss['section'];
?>
<div class="list-group-item disabled"><span class="glyphicon glyphicon-list"></span> <?php echo $secname; ?></div>
<?php
$selectcat = $pdo->prepare("SELECT DISTINCT category FROM categories WHERE section=:section ORDER BY category");
$selectcat->execute(array("section"=>$secname));
while($sc = $selectcat->fetch()){
$catname = $sc['category'];
?>
<a href="editlist.php?section=<?php echo $secname; ?>&category=<?php echo $catname; ?>" class="list-group-item"><span class="glyphicon glyphicon-th-large"></span> <?php echo $catname; ?></a>
<?php
}
}
?>
</div>
</div>
<div class="col-md-9 col-lg-9">
<div class="editlist">
<div class="alert alert-info"><?php echo $deletestatus; ?></div>
<?php
if(isset($_REQUEST['section']) && isset($_REQUEST['category'])){
$sec = $_REQUEST['section'];
$cat = $_REQUEST['category'];
$getcatid = $pdo->prepare("SELECT * FROM categories WHERE section=:section AND category=:category ORDER BY subcategory");
$getcatid->execute(array(
				"section"=>$sec,
				"category"=>$cat
				));
while($gciddet = $getcatid->fetch()){
$gcid = $gciddet['categoryid'];
$gcsubcat = $gciddet['subcategory'];
$getcatproducts = $pdo->prepare("SELECT * FROM products WHERE pcategory=:pcategory ORDER BY pname ASC");
$getcatproducts->execute(array("pcategory"=>$gcid));
echo "<h4 class='checkout-heading'>" . $gcsubcat . "</h4>";
if($getcatproducts->rowCount() == 0){
echo "<div class='alert alert-info'><span class='glyphicon glyphicon-exclamation-sign'></span> No products found in record under this section</div>";
}
else{
while($gprow = $getcatproducts->fetch()){
$gpid = $gprow['pid'];
$gpname = $gprow['pname'];
$gpcategory = $gprow['pcategory'];
$getcatdet = $pdo->prepare("SELECT * FROM categories WHERE categoryid=:catid");
$getcatdet->execute(array("catid"=>$gpcategory));
$gcval = $getcatdet->fetch();
$gcsection = $gcval['section'];
$gccat = $gcval['category'];
$gcsubcat = $gcval['subcategory'];
echo "<div class='row'>";
echo "<div class='col-md-4'><h5>$gpname</h5></div><div class='col-md-2'><h6>$gcsection</h6></div><div class='col-md-2'><h6>$gccat</h6></div><div class='col-md-1 col-xs-4'><a href='editproduct.php?pid=$gpid' class='btn btn-primary'>Edit</a></div><div class='col-md-2 col-xs-4'><a href='editlist.php?del=$gpid' class='btn btn-primary'>Delete</a></div>";
echo "</div>";
}
}
}
}
else{
$wheresearch = "";
if(isset($_REQUEST['searchpro'])){
$spname = trim($_REQUEST['searchpname']);
$wheresearch = " WHERE pname LIKE '%" . $spname . "%'";
}
$getproducts = $pdo->prepare("SELECT * FROM products $wheresearch ORDER BY pname ASC");
$getproducts->execute();
if($getproducts->rowCount() == 0){
echo "<div class='alert alert-info'>No product(s) available for the search result - '" . $spname . "'</div>";
}
else{
while($gprow = $getproducts->fetch()){
$gpid = $gprow['pid'];
$gpname = $gprow['pname'];
$gpcategory = $gprow['pcategory'];
$getcatdet = $pdo->prepare("SELECT * FROM categories WHERE categoryid=:catid");
$getcatdet->execute(array("catid"=>$gpcategory));
$gcval = $getcatdet->fetch();
$gcsection = $gcval['section'];
$gccat = $gcval['category'];
$gcsubcat = $gcval['subcategory'];
echo "<div class='row edit-list'>";
echo "<div class='col-md-4'><h5>$gpname</h5></div><div class='col-md-2'><h6>$gcsection</h6></div><div class='col-md-2'><h6>$gccat</h6></div><div class='col-md-1 col-xs-4'><a href='editproduct.php?pid=$gpid' class='btn btn-primary'>Edit</a></div><div class='col-md-2 col-xs-4'><a href='editlist.php?del=$gpid' class='btn btn-primary'>Delete</a></div>";
echo "</div>";
}
}
}
?>
</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
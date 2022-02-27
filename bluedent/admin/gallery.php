<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/validateProductGallery.php');
include('includes/validateProductDescription.php');
include('includes/validateDeleteGallery.php');
include('includes/validateDeleteDescriptionImage.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
?>
<?php
if(isset($_GET['progid'])){
$progid = $_GET['progid'];
$prod = $pdo->prepare("SELECT name FROM products WHERE pid=:pid");
$prod->execute(array("pid"=>$progid));
while($prow = $prod->fetch()){
$pname = $prow['name'];
}
}
// Assign Error Variables 
$galleryStatus = '';
$deleteGalleryStatus = '';
// Fetch Image Values
if(isset($_REQUEST['addimage'])){
$imageid = sprintf("%03d", mt_rand(100,999));
$proid = $_REQUEST['progid'];
$proftdid = substr($proid,0,3);
$imgid = $imageid . $proftdid;
$imgpath = "images/gallery/$imgid.png";
$source = $_FILES['new_image']['tmp_name'];
$file_size = $_FILES['new_image']['size'];
$size_limit = '10485760';
$target = "../images/gallery/$imgid.png";
$file_type = $_FILES['new_image']['type'];
// Create class and object instance
$validateProductGallery = new validateProductGallery();
$validateImage = $validateProductGallery->validateImage($file_size,$size_limit);
$validateGalleryUpload = $validateProductGallery->validateGalleryUpload($imgid,$file_size,$size_limit,$source,$target,$file_type);
// Throw Exceptions
if($validateImage == false){
$galleryStatus = $validateProductGallery->imageValidateError();
}
if($validateGalleryUpload == false){
$galleryStatus = $validateProductGallery->imageError();
}
if($validateImage !== false && $validateGalleryUpload !== false){
$addGallery = $validateProductGallery->addGallery($proid,$imgid,$imgpath);
if($addGallery == true){
$galleryStatus = $validateProductGallery->gallerySuccess();
}
else if($addGallery == false){
$galleryStatus = $validateProductGallery->galleryFailed();
}
else{
$galleryStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
}

// DESCRIPTION IMAGE

// Assign Error Variables 
$descriptionImageStatus = '';
$deleteDescriptionImageStatus = '';

// Fetch Image Values
if(isset($_REQUEST['adddesimage'])){
$imageid = sprintf("%03d", mt_rand(100,999));
$proid = $_REQUEST['prodid'];
$proftdid = substr($proid,0,3);
$imgid = $imageid . $proftdid;
$imgpath = "images/descriptions/$imgid.png";
$source = $_FILES['newd_image']['tmp_name'];
$file_size = $_FILES['newd_image']['size'];
$size_limit = '10485760';
$target = "../images/descriptions/$imgid.png";
$file_type = $_FILES['newd_image']['type'];
// Create class and object instance
$validateProductDescription = new validateProductDescription();
$validateDescriptionImage = $validateProductDescription->validateDescriptionImage($file_size,$size_limit);
$validateDescriptionImageUpload = $validateProductDescription->validateDescriptionImageUpload($imgid,$file_size,$size_limit,$source,$target,$file_type);
// Throw Exceptions
if($validateDescriptionImage == false){
$descriptionImageStatus = $validateProductDescription->descriptionImageValidateError();
}
if($validateDescriptionImageUpload == false){
$descriptionImageStatus = $validateProductDescription->descriptionImageError();
}
if($validateDescriptionImage !== false && $validateDescriptionImageUpload !== false){
$addDescriptionImage = $validateProductDescription->addDescriptionImage($proid,$imgid,$imgpath);
if($addDescriptionImage == true){
$descriptionImageStatus = $validateProductDescription->descriptionImageSuccess();
}
else if($addDescriptionImage == false){
$descriptionImageStatus = $validateProductDescription->descriptionImageFailed();
}
else{
$descriptionImageStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
}

// DELETE GALLERY IMAGE

//Fetch Delete Gallery Values
if(isset($_REQUEST['delimg'])){
$imageid = $_GET['delimg'];
// Create Class and Object Instance
$validateDeleteGallery = new validateDeleteGallery();
$deleteGallery = $validateDeleteGallery->deleteGallery($imageid);
if($deleteGallery == true){
$deleteGalleryStatus = $validateDeleteGallery->deleteGallerySuccess();
}
else if($deleteGallery == false){
$deleteGalleryStatus = $validateDeleteGallery->deleteGalleryFailed();
}
else{
$deleteGalleryStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}


// DELETE DESCRIPTION IMAGE

//Fetch Delete Description Image Values
if(isset($_REQUEST['deldimg'])){
$dimageid = $_GET['deldimg'];
// Create Class and Object Instance
$validateDeleteDescriptionImage = new validateDeleteDescriptionImage();
$deleteDescriptionImage = $validateDeleteDescriptionImage->deleteDescriptionImage($dimageid);
if($deleteDescriptionImage == true){
$deleteDescriptionImageStatus = $validateDeleteDescriptionImage->deleteDescriptionImageSuccess();
}
else if($deleteGallery == false){
$deleteDescriptionImageStatus = $validateDeleteDescriptionImage->deleteDescriptionImageFailed();
}
else{
$deleteDescriptionImageStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
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
<h2>Product Images</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php if($galleryStatus !== ''){ ?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $galleryStatus; ?></div>
<?php } ?>
<?php if($deleteGalleryStatus !== ''){ ?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $deleteGalleryStatus; ?></div>
<?php } ?>
<?php if($descriptionImageStatus !== ''){ ?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $descriptionImageStatus; ?></div>
<?php } ?>
<?php if($deleteDescriptionImageStatus !== ''){ ?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $deleteDescriptionImageStatus; ?></div>
<?php } ?>
<form action="<?php echo $CP_URL; ?>gallery.php?progid=<?php echo $progid; ?>" method="POST" enctype="multipart/form-data">
<table class="table cart"><thead><tr><th colspan="2">Add an image to product gallery</th></tr></thead>
<tr><td>Product Name</td><td><?php echo $pname; ?></td></tr>
<thead><tr><th colspan="2">Product Gallery Images</th></tr></thead><tr><td colspan="2"><?php 
$progall = $pdo->prepare("SELECT * FROM gallery WHERE pid=:pid");
$progall->execute(array("pid"=>$progid));
if($progall->rowCount() == 0){
echo "<p>No Images added</p>";
}
while($rowgall = $progall->fetch()){
$gallink = $rowgall['link'];
$imgid = $rowgall['imageid'];
echo "<div class='col-md-4 col-lg-4 edit-gallery'><a href='".$BASE_URL."$gallink'><img class='img-responsive' src='".$BASE_URL."images/gallery/thumbs/$imgid.png' /></a>";
echo "<a class='btn btn-danger btn-block' id='deletelink' href='".$CP_URL."gallery.php?delimg=$imgid&progid=$progid'>Delete</a></div>";
}
?>
</td></tr>
<tr><td>Select Image</td><td><span class="btn btn-warning btn-file">Browse Image<input type="file" name="new_image" id="image" /></span></td></tr>
<tr><td colspan="2"><input type="hidden" name="proid" value="<?php echo $progid; ?>" /><button class="btn btn-success btn-lg pull-right" type="submit" name="addimage">Add Image</button></td></tr>
</table>
</form>

<!-- Description Images -->

<form action="gallery.php?progid=<?php echo $progid; ?>" method="POST" enctype="multipart/form-data">
<table class="table cart"><thead><tr><th colspan="2">Add an image to product description</th></tr></thead>
<thead><tr><th colspan="2">Product Description Images</th></tr></thead><tr><td colspan="2"><?php 
$prodgall = $pdo->prepare("SELECT * FROM descriptions WHERE pid=:pid");
$prodgall->execute(array("pid"=>$progid));
if($prodgall->rowCount() == 0){
echo "<p>No images added</p>";
}
while($drowgall = $prodgall->fetch()){
$deslink = $drowgall['link'];
$dimgid = $drowgall['imageid'];
echo "<div class='col-md-4 edit-gallery'><a href='".$BASE_URL."$deslink'><img class='img-responsive' src='".$BASE_URL."images/descriptions/thumbs/$dimgid.png' /></a>";
echo "<h5>$deslink</h5>";
echo "<a class='btn btn-danger btn-block' id='deletelink' href='".$CP_URL."gallery.php?deldimg=$dimgid&progid=$progid'>Delete</a></div>";
}
?></td></tr>
<tr><td>Select Image</td><td><span class="btn btn-warning btn-file">Browse Image<input type="file" name="newd_image" id="newd_image" /></span></td></tr>
<tr><td colspan="2"><input type="hidden" name="prodid" value="<?php echo $progid; ?>" /><button class='btn btn-success btn-lg pull-right' type="submit" name="adddesimage" id="adddesimage">Add Image</button></td></tr>
</table>
</form>
</div>
</div>

<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Instructions to add a product</th></tr></thead>
<tr><td colspan="2">
<h4><small>Product Image Formats:</small></h4>
<ul>
<li>Using images of size with square dimensions is recommended. <i>Example: 200px width &amp; 200px height</i></li>
<li>For description images, dimensions can be of any width or height.</li>
<li>Uploading optimized and less resolution images is recommended for higher website performance. <i>Example: Images of resolution not more than 2000px of width</i></li>
<li>PNG format images are recommended for good quality.</li><br />
</ul>
</table>

<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead>
<form action="<?php echo $CP_URL; ?>editlist.php" method="POST" enctype="multipart/form-data">
<tr><td>Search Product: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</form>
<tr><td>Go to product list</td><td><a class='btn btn-danger btn-sm' href='editlist.php'>Product List</a></td></tr><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='<?php echo $CP_URL; ?>dashboard.php'>Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

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
$stop = '0';
if(isset($_POST['addimage'])){
if($_FILES['new_image']['size'] == 0){
echo "<div class='alert alert-danger'>Image is not selected or invalid</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
}
else{
if (isset ($_FILES['new_image'])){
$imgid = rand(000000,999999);
$proid = $_POST['proid'];
$imgpath = "images/gallery/$imgid.png";
$imagename = $_FILES['new_image']['name'];
$source = $_FILES['new_image']['tmp_name'];
$file_size = $_FILES['new_image']['size'];
$size_limit = '2000000';
$target = "images/gallery/$imgid.png";
$file_type = $_FILES['new_image']['type'];

if($file_size >= $size_limit) :
echo 'You image is to large!';
else :
if($_FILES['new_image']['type'] == 'image/jpeg'):
move_uploaded_file($source, $target);
elseif($_FILES['new_image']['type'] == 'image/png'):
move_uploaded_file($source, $target);
elseif($_FILES['new_image']['type'] == 'image/gif'):
move_uploaded_file($source, $target);
endif;
endif;


$imagepath = "$imgid.png";
$save = "images/gallery/" . $imagepath; //This is the new file you saving
$file = "images/gallery/" . $imagepath; //This is the original file
$x = @getimagesize($file); 
switch($x[2]) { 
case 1: 
$image = imagecreatefromgif($file); 
break; 
case 2: 
$image = imagecreatefromjpeg($file);
break; 
case 3: 
$image = imagecreatefrompng($file);  
break; 
default: 
echo "<div class='alert alert-danger'>Could not update the product gallery</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
$stop = '1';
break;
} 
if($stop != 1) {
list($width, $height) = getimagesize($file) ; 

$modwidth = $width;

$diff = $width / $modwidth;

$modheight = $height / $diff; 
$tn = imagecreatetruecolor($modwidth, $modheight) ; 
/*
$file_type = $_FILES['new_image']['type'];
if($file_type == "image/jpeg" || $file_type == "image/jpg") :
$image = imagecreatefromjpeg($file);
elseif($file_type == "image/x-png" || $file_type == "image/png") :
$image = imagecreatefrompng($file);
elseif($file_type == "image/gif") :
$image = imagecreatefromgif($file);
else : 
echo 'Invalid type';
endif;*/

imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 

$save = "images/gallery/thumbs/" . $imagepath; //This is the new file you saving
$file = "images/gallery/" . $imagepath; //This is the original file

list($width, $height) = getimagesize($file) ; 

$modwidth = 300; 

$diff = $width / $modwidth;

$modheight = $height / $diff; 
$tn = imagecreatetruecolor($modwidth, $modheight) ; 
$x = @getimagesize($file); 
switch($x[2]) { 
case 1: 
$image = imagecreatefromgif($file); 
break; 
case 2: 
$image = imagecreatefromjpeg($file);
break; 
case 3: 
$image = imagecreatefrompng($file);  
break; 
default: 
echo "<div class='alert alert-danger'>Could not update the product gallery</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
} 
imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 
}
}
$updateimg = $pdo->prepare("INSERT INTO gallery (pid,imageid,link) VALUES (:pid,:imageid,:link)");
$updateimg->execute(array(
					"pid"=>$proid,
					"imageid"=>$imgid,
					"link"=>$imgpath
					));
if($updateimg){
echo "<div class='alert alert-success'>Product gallery updated</div>";
echo "<form action='addgallery.php' method='POST'><input type='hidden' value='$proid' name='progid' /><button class='btn btn-primary pull-right' type='submit' name='addgallery'>Add More</button></form><a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Go to Product List</a></div></div>";
include("http://admin.bluedentindia.in/footer.php");
exit();
}
else{
echo "<div class='alert alert-danger'>Could not update the product gallery</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a></div></div>";
exit();
}
}
}
?>
<!--Upload Description Image-->
<?php
$stop = '0';
if(isset($_POST['adddimage'])){
if($_FILES['newd_image']['size'] == 0){
echo "<div class='alert alert-danger'>Image is not selected or invalid</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
}
else{
if (isset ($_FILES['newd_image'])){
$dimgid = rand(000000,999999);
$prodid = $_POST['prodid'];
$imgpath = "images/descriptions/$dimgid.png";
$imagename = $_FILES['newd_image']['name'];
$source = $_FILES['newd_image']['tmp_name'];
$file_size = $_FILES['newd_image']['size'];
$size_limit = '2000000';
$target = "images/descriptions/$dimgid.png";
$file_type = $_FILES['newd_image']['type'];

if($file_size >= $size_limit) :
echo 'You image is to large!';
else :
if($_FILES['newd_image']['type'] == 'image/jpeg'):
move_uploaded_file($source, $target);
elseif($_FILES['newd_image']['type'] == 'image/png'):
move_uploaded_file($source, $target);
elseif($_FILES['newd_image']['type'] == 'image/gif'):
move_uploaded_file($source, $target);
endif;
endif;


$imagepath = "$dimgid.png";
$save = "images/descriptions/" . $imagepath; //This is the new file you saving
$file = "images/descriptions/" . $imagepath; //This is the original file
$x = @getimagesize($file); 
switch($x[2]) { 
case 1: 
$image = imagecreatefromgif($file); 
break; 
case 2: 
$image = imagecreatefromjpeg($file);
break; 
case 3: 
$image = imagecreatefrompng($file);  
break; 
default: 
echo "<div class='alert alert-danger'>Error. Could not update the product description image.</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
$stop = '1';
break;
} 
if($stop != 1) {
list($width, $height) = getimagesize($file) ; 

$modwidth = $width;

$diff = $width / $modwidth;

$modheight = $height / $diff; 
$tn = imagecreatetruecolor($modwidth, $modheight) ; 
/*
$file_type = $_FILES['newd_image']['type'];
if($file_type == "image/jpeg" || $file_type == "image/jpg") :
$image = imagecreatefromjpeg($file);
elseif($file_type == "image/x-png" || $file_type == "image/png") :
$image = imagecreatefrompng($file);
elseif($file_type == "image/gif") :
$image = imagecreatefromgif($file);
else : 
echo 'Invalid type';
endif;*/

imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 

$save = "images/descriptions/thumbs/" . $imagepath; //This is the new file you saving
$file = "images/descriptions/" . $imagepath; //This is the original file

list($width, $height) = getimagesize($file) ; 

$modwidth = 300; 

$diff = $width / $modwidth;

$modheight = $height / $diff; 
$tn = imagecreatetruecolor($modwidth, $modheight) ; 
$x = @getimagesize($file); 
switch($x[2]) { 
case 1: 
$image = imagecreatefromgif($file); 
break; 
case 2: 
$image = imagecreatefromjpeg($file);
break; 
case 3: 
$image = imagecreatefrompng($file);  
break; 
default: 
echo "<div class='alert alert-danger'>Error. Could not update the product description image.</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a>";
exit();
} 
imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 
}
}
$updatedimg = $pdo->prepare("INSERT INTO descriptions (pid,imageid,link) VALUES (:pid,:imageid,:link)");
$updatedimg->execute(array(
					"pid"=>$prodid,
					"imageid"=>$dimgid,
					"link"=>$imgpath
					));
if($updatedimg){
echo "<div class='alert alert-success'>Product description image updated.</div>";
echo "<form action='addgallery.php' method='POST'><input type='hidden' value='$prodid' name='progid' /><button class='btn btn-primary pull-right' type='submit' name='addgallery'>Add More</button></form><a class='btn btn-danger pull-right' href='http://admin.bluedentindia.in/editlist.php'>Go to Product List</a></div></div>";
include("http://admin.bluedentindia.in/footer.php");
exit();
}
else{
echo "<div class='alert alert-danger'>Error. Could not update the product description image.</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/editlist.php' role='button'>Back</a></div></div>";
include("http://admin.bluedentindia.in/footer.php");
exit();
}
}
}
?>
<div class="row order">
<div class="col-md-12">
<form action="addgallery.php" method="POST" enctype="multipart/form-data">
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
echo "<div class='col-md-4 edit-gallery'><a href='$gallink'><img class='img-responsive' src='images/gallery/thumbs/$imgid.png' /></a>";
echo "<a class='btn btn-danger btn-block' id='deletelink' href='deleteimage.php?imageid=$imgid'>Delete</a></div>";
}
?>
</td></tr>
<tr><td>Select Image</td><td><span class="btn btn-warning btn-file">Browse Image<input type="file" name="new_image" id="image" /></span></td></tr>
<tr><td colspan="2"><input type="hidden" name="proid" value="<?php echo $progid; ?>" /><button class="btn btn-success btn-lg pull-right" type="submit" name="addimage">Add Image</button></td></tr>
</table>
</form>

<form action="addgallery.php" method="POST" enctype="multipart/form-data">
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
echo "<div class='col-md-4 edit-gallery'><a href='$deslink'><img class='img-responsive' src='images/descriptions/thumbs/$dimgid.png' /></a>";
echo "<h5>$deslink</h5>";
echo "<a class='btn btn-danger btn-block' id='deletelink' href='deleteimage.php?dimageid=$dimgid'>Delete</a></div>";
}
?></td></tr>
<tr><td>Select Image</td><td><span class="btn btn-warning btn-file">Browse Image<input type="file" name="newd_image" id="image" /></span></td></tr>
<tr><td colspan="2"><input type="hidden" name="prodid" value="<?php echo $progid; ?>" /><button class='btn btn-success btn-lg pull-right' type="submit" name="adddimage">Add Image</button></td></tr>
</table>
</form>

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
<form action="http://admin.bluedentindia.in/editlist.php" method="POST" enctype="multipart/form-data">
<tr><td>Search Product: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</form>
<tr><td>Go to product list</td><td><a class='btn btn-danger btn-sm' href='http://admin.bluedentindia.in/editlist.php'>Product List</a></td></tr><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='http://admin.bluedentindia.in/admincontrol.php'>Control Panel</a></td></tr></table>
</div>
</div>
<?php include('panelfooter.php'); ?>

</div>
<script src="http://admin.bluedentindia.in/js/jquery-1.11.1.min.js"></script>
<script src="http://admin.bluedentindia.in/js/bootstrap.min.js"></script>
</body>
</html>

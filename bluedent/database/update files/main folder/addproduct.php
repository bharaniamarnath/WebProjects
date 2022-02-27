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
<div class='row page-title'><div class='col-md-12'><h2>Add Product</h2></div></div>
<div class="row">
<div class="col-md-12">

<?php
$stop = '0';
if(isset($_POST['addproduct'])){
if(empty($_POST['pname']) || empty($_POST['description']) || $_FILES['image']['size'] == 0){
echo "<div class='alert alert-danger'>Product name, description or product image is empty or invalid</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
}
else if(strlen($_POST['description']) > 10000){
echo "<div class='alert alert-warning'>Could not update. Product description has more than 10000 characters.</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
}
else{
$pid = rand(000000,999999);
$pname = $_POST['pname'];
$category = $_POST['category'];
$subcat = $_POST['subcategory'];
$group = $_POST['group'];
$desc = $_POST['description'];
$imgpath = "images/products/$category/$subcat/$pid.png";
$imagename = $_FILES['image']['name'];
$source = $_FILES['image']['tmp_name'];
$file_size = $_FILES['image']['size'];
$size_limit = '2000000';
$target = "images/products/$category/$subcat/$pid.png";
$file_type = $_FILES['image']['type'];

if($file_size >= $size_limit) :
echo 'You image is to large!';
else :
if($_FILES['image']['type'] == 'image/jpeg'):
move_uploaded_file($source, $target);
elseif($_FILES['image']['type'] == 'image/png'):
move_uploaded_file($source, $target);
elseif($_FILES['image']['type'] == 'image/gif'):
move_uploaded_file($source, $target);
endif;
endif;


$imagepath = "$pid.png";
$save = "images/products/$category/$subcat/" . $imagepath; //This is the new file you saving
$file = "images/products/$category/$subcat/" . $imagepath; //This is the original file
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
echo "<div class='alert alert-danger'>Error. Could not update the product image</div>";
//http://admin.bluedentindia.in/newproduct.php
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
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
$file_type = $_FILES['image']['type'];
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

$save = "images/products/$category/$subcat/thumbs/" . $imagepath; //This is the new file you saving
$file = "images/products/$category/$subcat/" . $imagepath; //This is the original file

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
echo "<div class='alert alert-danger'>Error. Could not update the product gallery</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
} 
imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 
}
$addpro = $pdo->prepare("INSERT INTO products(pid,name,category,subcategory,classified,description,image) VALUES (:pid,:name,:category,:subcategory,:group,:description,:image)");
$addpro->execute(array(
				"pid"=>$pid,
				"name"=>$pname,
				"category"=>$category,
				"subcategory"=>$subcat,
				"group"=>$group,
				"description"=>$desc,
				"image"=>$imgpath
				));
if($addpro){
echo "<div class='alert alert-success'>Product <b>" . $pname . "</b> added to the database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
}
else{
echo "<div class='alert alert-danger'>Error adding product <b>" . $pname . "</b> to the database</div>";
echo "<a class='btn btn-primary pull-right' href='http://admin.bluedentindia.in/newproduct.php' role='button'>Back</a>";
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
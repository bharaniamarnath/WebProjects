<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.photos.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
$stop = '0';
if(isset($_POST['upload']))
{
if (isset ($_FILES['myfile'])){
$imgid = rand(000000,999999);
$imgpath = "photos/$imgid.jpg";
$imagename = $_FILES['myfile']['name'];
$filename = $_POST['filename'];
$filedesc = $_POST['filedes'];
$source = $_FILES['myfile']['tmp_name'];
$file_size = $_FILES['myfile']['size'];
$size_limit = '2000000';
$target = "photos/$imgid.jpg";
$thumb = "photos/thumbs/$imgid.jpg";
$file_type = $_FILES['myfile']['type'];

$photos = new photos();
$photos->setUserSession($suid);
$photos->setImageId($imgid);
$photos->setImageFileName($filename);
$photos->setImageDescription($filedesc);
$photos->setImageTarget($target);
$photos->setImageThumb($thumb);

if($file_size >= $size_limit) :
echo $photoalert;
else :
if($_FILES['myfile']['type'] == 'image/jpeg'):
move_uploaded_file($source, $target);
elseif($_FILES['myfile']['type'] == 'image/png'):
move_uploaded_file($source, $target);
elseif($_FILES['myfile']['type'] == 'image/gif'):
move_uploaded_file($source, $target);
endif;
endif;


$imagepath = "$imgid.jpg";
$save = "photos/" . $imagepath; //This is the new file you saving
$file = "photos/" . $imagepath; //This is the original file
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
echo $photoalert;
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


imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 

$save = "photos/thumbs/" . $imagepath; //This is the new file you saving
$file = "photos/" . $imagepath; //This is the original file

list($width, $height) = getimagesize($file) ; 

$modwidth = 100; 

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
echo $photoalert;
exit();
} 
imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 
}
}
$photos->UploadImage();	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php include('includes/header.php'); ?>

<div class="col-md-3">
<div class="row panel-board"><div class="col-md-4"><?php echo "<a href='profile.php'><img src='$thumbloc' class='img-responsive'></a>"; ?></div><div class="col-md-8"><h5><?php echo $fname . ' ' . $lname; ?><br /><small><?php echo $usrnme; ?><br /><?php echo $mail; ?></small></h5></div></div>
<div class="row">
<div class="col-md-12">
<div class="list-group">
<a class="list-group-item" href="main.php"><span class='glyphicon glyphicon-home'></span> Home</a>
<a class="list-group-item" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
<a class="list-group-item" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
<a class="list-group-item active" href="photos.php"><span class='glyphicon glyphicon-picture'></span> Photos</a>
<a class="list-group-item" href="inbox.php"><span class='glyphicon glyphicon-envelope'></span> Messages</a>
<a class="list-group-item" href="groups.php"><span class='glyphicon glyphicon-th'></span> Groups</a>
<a class="list-group-item" href="account.php"><span class='glyphicon glyphicon-lock'></span> Account</a>
</div>
</div>
</div>		
</div>

<div class="col-md-6">

<div class="row">
<div class="col-md-12">
<ul class="nav nav-pills nav-justified">
<li><a href="photos.php">Private Photos</a></li>
<li><a href="publicphotos.php">Public Photos</a></li>
<li class="active"><a href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>

<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-picture'></span> Upload Photos</h3>
<h6>Note: <i>Photos uploaded in this section is private. Only you and your friends can view it.</i></h6>
<form action='uploadphotos.php' method='POST' enctype='multipart/form-data'>
<div class="form-group"><label for=" ">Photo Title:</label><input class="form-control" type='text' name='filename' id='filename' /></div>
<div class="form-group"><label for=" ">Photo Description:</label><textarea class="form-control" name='filedes' id='filedes'></textarea></div>
<div class="form-group"><label for=" ">Upload Photo:</label><input type='file' name='myfile' id='myfile' accept="image/*" /></div>
<button class='btn btn-success pull-right' type='submit' name='upload'>Upload</button>
</form>
</div>
</div>
</div>



<div class="row footer">
<div class="col-md-12">
<a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a>
<br />
&copy;Copyrights 2013. Baffoons Network.
</div>
</div>

</div>
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
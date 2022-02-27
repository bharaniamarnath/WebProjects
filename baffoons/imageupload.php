<?php
session_start();
include('includes/connect.php');
include('includes/class.profile.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
$stop = '0';
if(isset($_POST['submit']))
{
if (isset ($_FILES['myfile'])){
$imgid = rand(000000,999999);
$imgpath = "album/$userid.jpg";
$imagename = $_FILES['myfile']['name'];
$source = $_FILES['myfile']['tmp_name'];
$file_size = $_FILES['myfile']['size'];
$size_limit = '2000000';
$target = "album/$userid.jpg";
$thumb = "album/thumbs/$userid.jpg";
$file_type = $_FILES['myfile']['type'];

$profile = new profile();
$profile->setUserSession($suid);
$profile->setImageTarget($target);
$profile->setImageThumb($thumb);

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


$imagepath = "$userid.jpg";
$save = "album/" . $imagepath; //This is the new file you saving
$file = "album/" . $imagepath; //This is the original file
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

$save = "album/thumbs/" . $imagepath; //This is the new file you saving
$file = "album/" . $imagepath; //This is the original file

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
$profile->ProfileImage();
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
<a class="list-group-item active" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
<a class="list-group-item" href="friends.php"><span class='glyphicon glyphicon-th-list'></span> Friends</a>
<a class="list-group-item" href="photos.php"><span class='glyphicon glyphicon-picture'></span> Photos</a>
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
<h3 class="page-header"><span class='glyphicon glyphicon-user'></span> Current Profile Picture</h3>
<?php
$imgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE Username=:Username");
$imgresult->execute(array('Username'=>$suid));
while($row = $imgresult->fetch()){
$imgloc = $row['Image'];
}
echo "<img src='$imgloc' class='img-responsive thumbnail' />";
?>
</div>
</div>
<div class="row">
<div class="col-md-12">
<h3 class="page-header"><span class='glyphicon glyphicon-picture'></span> Upload New Profile Picture</h3>
<h6>(Do not upload image of size more than 2 MB)</h6>
<form action='imageupload.php' method='POST' enctype='multipart/form-data' class="form-group">
<label for=" ">Upload Image:</label><input type='file' name='myfile' id='myfile' />
<input class="btn btn-success btn-lg pull-right" type='submit' name='submit' value='Upload'></form>
</div>
</div>

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
</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
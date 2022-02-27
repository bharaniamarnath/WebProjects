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
<title>Baffoons - Image Upload</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />

</head>
<body>
<div id="container">
<div id="leftpane">
<div class="dashboard"><div id="profileimage"><?php echo "<a href='profile.php'><img src='$thumbloc' id='profilecrop' /></a>"; ?></div><h2><?php echo $fname . ' ' . $lname; ?></h2><?php echo $usrnme; ?><br /><?php echo $mail; ?></div>
<div id="menubar">
<div id="holder">
<ul>
<li><a href="main.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a id="onlink" href="photos.php">Photos</a></li>
<li><a href="inbox.php">Messages</a></li>
<li><a href="groups.php">Groups</a></li>
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div id="submenubar">
<div id="holder">
<ul>
<li><a href="photos.php">Album</a></li>
<li><a href="publicphotos.php">Public Photos</a></li>
<li><a id="onlink" href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<div id="aboutme">
<h3>Upload private photos:</h3><br />
<h4>The photos uploaded here can be viewed only by you and your friends</h4><br />
<table class='regform'>
<form action='uploadphotos.php' method='POST' enctype='multipart/form-data'>
<tr><td class='regform'>Photo Title:</td> <td class='regform'><input type='text' name='filename' id='filename' /></td></tr>
<tr><td class='regform'>Photo Description:</td> <td class='regform'><textarea name='filedes' id='filedes'></textarea></td></tr>
<tr><td class='regform'>Upload Photo:</td><td class='regform'><div id="browsefile"><input type='file' name='myfile' id='myfile' accept="image/*" /></div></td></tr>
<tr><td></td><td><input type='submit' name='upload' value='Upload'></form></table>
</div>
</div>
</div>
</div>
</div>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
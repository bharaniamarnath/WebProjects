<?php
session_start();
include('includes/header.php');
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

$modwidth = 60; 

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
<title>Baffoons - Image Upload</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />

</head>
<body>
<div id="container">
<div id="leftpane">
<div class="dashboard"><div id="profileimage"><?php echo "<a href='profile.php'><img src='$thumbloc' id='profilecrop' /></a>"; ?></div><h2><?php echo $fname . ' ' . $lname; ?></h2><?php echo $usrnme; ?><br /><?php echo $mail; ?></div>
<div id="menubar">
<div id="holder">
<ul>
<li><a href="main.php">Home</a></li>
<li><a id="onlink" href="profile.php">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="photos.php">Photos</a></li>
<li><a href="mail.php">Messages</a></li>
<li><a href="groups.php">Groups</a></li>
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div class="messageboard">
<div id="aboutme">
<h3>Current profile picture</h3>
<?php
$imgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE Username=:Username");
$imgresult->execute(array('Username'=>$suid));
while($row = $imgresult->fetch()){
$imgloc = $row['Image'];
}
echo "<table style='margin-top: 10px;'>";
echo "<tr>";
echo "<td><img src='$imgloc' id='profileimgcrop' /></td>";
echo "</tr>";
echo "<tr>";
echo "</tr>";
echo "</table>";
?></div>
<div id="aboutme" style='border-top: 1px solid #ccc;'>
<h3>Upload a new profile picture</h3>
<h5>(Do not upload image of size more than 2 MB)</h5>
<form action='imageupload.php' method='POST' enctype='multipart/form-data'>
<table class="regform">
<tr><td class='regform'>Upload Image:</td> <td class='regform'><div id="browsefile"><input type='file' name='myfile' id='myfile' /></div></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Upload'></form></table>
</div>
</div>
</div>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
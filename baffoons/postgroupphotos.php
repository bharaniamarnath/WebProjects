<?php
session_start();
include('includes/connect.php');
include('includes/class.group.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
?>
<?php
$stop = '0';
if(isset($_POST['upload']))
{
if (isset ($_FILES['myfile'])){
$imgid = rand(000000,999999);
$imgpath = "groupphotos/$imgid.jpg";
$imagename = $_FILES['myfile']['name'];
$source = $_FILES['myfile']['tmp_name'];
$file_size = $_FILES['myfile']['size'];
$size_limit = '2000000';
$target = "groupphotos/$imgid.jpg";
$thumb = "groupphotos/thumbs/$imgid.jpg";
$file_type = $_FILES['myfile']['type'];
$groupid = $_POST['gpid'];
$posttarget = "<img src='groupphotos/$imgid.jpg'></img>";

$group = new group();
$group->setUserSession($suid);
$group->setGroupId($groupid);
$group->setPostId($imgid);
$group->setGroupImage($target);
$group->setGroupThumb($thumb);
$group->setPostMessage($posttarget);

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
$save = "groupphotos/" . $imagepath; //This is the new file you saving
$file = "groupphotos/" . $imagepath; //This is the original file
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

$save = "groupphotos/thumbs/" . $imagepath; //This is the new file you saving
$file = "groupphotos/" . $imagepath; //This is the original file

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
$group->UploadGroupPostImage();	
}
?>
<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.group.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
$stop = '0';
if(isset($_POST['creategroup']))
{
if (isset ($_FILES['myfile'])){
$grpid = rand(000000,999999);
$imgpath = "groups/$grpid.jpg";
$imagename = $_FILES['myfile']['name'];
$grpname = $_POST['grpname'];
$grptype = $_POST['grptype'];
$grpdesc = $_POST['grpdes'];
$source = $_FILES['myfile']['tmp_name'];
$file_size = $_FILES['myfile']['size'];
$size_limit = '2000000';
$target = "groups/$grpid.jpg";
$thumb = "groups/thumbs/$grpid.jpg";
$file_type = $_FILES['myfile']['type'];

$group = new group();
$group->setUserSession($suid);
$group->setGroupId($grpid);
$group->setGroupName($grpname);
$group->setGroupType($grptype);
$group->setGroupDescription($grpdesc);
$group->setGroupImage($target);
$group->setGroupThumb($thumb);

if($file_size >= $size_limit) :
echo $groupfailalert;
else :
if($_FILES['myfile']['type'] == 'image/jpeg'):
move_uploaded_file($source, $target);
elseif($_FILES['myfile']['type'] == 'image/png'):
move_uploaded_file($source, $target);
elseif($_FILES['myfile']['type'] == 'image/gif'):
move_uploaded_file($source, $target);
endif;
endif;


$imagepath = "$grpid.jpg";
$save = "groups/" . $imagepath; //This is the new file you saving
$file = "groups/" . $imagepath; //This is the original file
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
echo $groupfailalert;
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

$save = "groups/thumbs/" . $imagepath; //This is the new file you saving
$file = "groups/" . $imagepath; //This is the original file

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
echo $groupfailalert;
exit();
} 
imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

imagejpeg($tn, $save, 100) ; 
}
}	
$group->CreateGroup();
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
<li><a href="photos.php">Photos</a></li>
<li><a href="inbox.php">Messages</a></li>
<li><a id="onlink" href="groups.php">Groups</a></li>
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div id="submenubar">
<div id="holder">
<ul>
<li><a href="groups.php">My Groups</a></li>
<li><a href="allgroups.php">All Groups</a></li>
<li><a id="onlink" href="creategroup.php">Create Group</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<h3>Create a new group</h3><br />
<table class='mailbox' style='background: #eee;'>
<form action='creategroup.php' method='POST' enctype='multipart/form-data'>
<tr><td class='regform'>Group Name:</td> <td class='regform'><input type='text' name='grpname' id='grpname' /></td></tr>
<tr><td class="regform">Group Type:</td><td class="regform"><select name="grptype">
<option  value=""/>
<option value="School">School</option>
<option value="College">College</option>
<option value="Industry">Industry</option>
<option value="Person">Person</option>
<option value="Place">Place</option>
<option value="Event">Event</option>
<option value="Sports">Sports</option>
<option value="World">World</option>
<option value="Community">Community</option>
<option value="Entertainment">Entertainment</option>
<option value="Media">Media</option>
<option value="Others">Others</option>
</select>
</td></tr>
<tr><td class='regform' colspan="2">Group Description:<br /><textarea name='grpdes' id='grpdes'></textarea></td></tr>
<tr><td class='regform'>Upload Photo:</td> <td class='regform'><div id="browsefile"><input type='file' name='myfile' id='myfile' /></div></td></tr>
<tr><td colspan="2"><input type='submit' name='creategroup' value='Create Group'></form></table>
</div>
</div>
</div>
</div>
</div>

<div id="groupbox">
<h5>Random Groups</h5>
<?php
$randgrp = $pdo->prepare("SELECT * FROM groups ORDER BY RAND() LIMIT 6");
$randgrp->execute();
if($randgrp->rowCount() == 0){
echo "<p>No groups found</p><br />";
}
while($rgrow = $randgrp->fetch()){
$rgid = $rgrow['ID'];
$rgn = $rgrow['Name'];
$rgimg = $rgrow['Image'];
$rgtype = $rgrow['Type'];
echo "<table class='rgroups'>";
echo "<tr><td id='rgimage' rowspan='2'><div id='randomgrp'><a href='viewgroup.php?vgrpid=$rgid'><img src='$rgimg' id='profilecrop' /></a></div></td>";
echo "<td><a id='rglink' href='viewgroup.php?vgrpid=$rgid'><p>$rgn</p></a></tr><tr><td><font>$rgtype</font></td></tr>";
echo "</table>";
}
?>
</div>


<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
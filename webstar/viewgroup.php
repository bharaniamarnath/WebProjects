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
if(isset($_POST['join'])){
$group = new group();
$group->setUserSession($suid);
$group->setGroupId($_POST['grpid']);
$group->JoinGroup();
}
?>
<?php
if(isset($_POST['unjoin'])){
$group = new group();
$group->setUserSession($suid);
$group->setGroupId($_POST['ugrpid']);
$group->UnjoinGroup();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#videopost").click(function(){
$("#postgroup").hide();
$("#postimagegroup").hide();
$("#postvideogroup").show();
});
$("#messagepost").click(function(){
$("#postgroup").show();
$("#postimagegroup").hide();
$("#postvideogroup").hide();
});
$("#imagepost").click(function(){
$("#postgroup").hide();
$("#postimagegroup").show();
$("#postvideogroup").hide();
});
});
</script>
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
<li><a id="onlink" href="allgroups.php">All Groups</a></li>
<li><a href="creategroup.php">Create Group</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border-bottom: none;">
<?php 
if(isset($_GET['vgrpid'])){
$vgroupid = $_GET['vgrpid'];
$viewgroup = $pdo->prepare("SELECT * FROM groups WHERE ID=:ID");
$viewgroup->execute(array('ID'=>$vgroupid));
while($agroup = $viewgroup->fetch()){
$groupid = $agroup['ID'];
$groupname = $agroup['Name'];
$grouptype = $agroup['Type'];
$groupdesc = $agroup['Description'];
$groupadmin = $agroup['UserID'];
$groupimage = $agroup['Image'];
$groupdate = $agroup['Date'];
$thumb = $agroup['Thumb'];
$gpud = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$gpud->execute(array('UserID'=>$groupadmin));
$gudrow = $gpud->fetch();
$gadmin = $gudrow['Username'];
$gmemcount = $pdo->prepare("SELECT * FROM groupmembers WHERE ID=:ID");
$gmemcount->execute(array('ID'=>$groupid));
$gmcount = $gmemcount->rowCount();
$chkgroup = $pdo->prepare("SELECT * FROM groupmembers WHERE UserID=:UserID AND ID=:ID");
$chkgroup->execute(array('UserID'=>$suid, 'ID'=>$groupid));
if($chkgroup->rowCount() == 1){
echo "<div id='profilecover'><img src='$groupimage' /></div>";
echo "<table class='proform'>";
echo "<tr><td id='profilehead'><div id='profileimg'><a href='$groupimage'><img src='$groupimage' id='profileimgcrop' /></a></div></td><td id='profilehead'><h2>$groupname</h2><font>Member</font></td><td id='grpbutton'><form action='viewgroup.php' method='POST'>";
echo "<input type='hidden' name='ugrpid' value='$groupid' />";
echo "<input type='submit' name='unjoin' id='addvf' value='Unjoin Group'>";
echo "</form></td></tr>";
echo "<tr><th>About Group: </th></tr><tr><td id='aboutme' colspan='2'>$groupdesc</td></tr>";	
echo "<tr><td>Group Type:</td> <td class='pdform'>$grouptype</td></tr>";
echo "<tr><td>Created by:</td> <td class='pdform'>$gadmin</td></tr>";
echo "<tr><td>Date:</td> <td class='pdform'>$groupdate</td></tr>";
echo "<tr><td>Members:</td> <td class='pdform'>$gmcount</td></tr>";
echo "</table>";
}
else{
echo "<div id='profilecover'><img src='$groupimage' /></div>";
echo "<table class='proform'>";
echo "<tr><td id='profilehead'><div id='profileimg'><a href='$groupimage'><img src='$thumb' id='profileimgcrop' /></a></div></td><td id='profilehead'><h2>$groupname</h2></td><td id='grpbutton'><form action='viewgroup.php' method='POST'>";
echo "<input type='hidden' name='grpid' value='$groupid' />";
echo "<input type='submit' name='join' id='addvf' value='Join Group'>";
echo "</form></td></tr>";
echo "<tr><th>About Group: </th></tr><tr><td id='aboutme' colspan='2'>$groupdesc</td></tr>";	
echo "<tr><td>Group Type:</td> <td class='pdform'>$grouptype</td></tr>";
echo "<tr><td>Created by:</td> <td class='pdform'>$gadmin</td></tr>";
echo "<tr><td>Date:</td> <td class='pdform'>$groupdate</td></tr>";
echo "<tr><td>Members:</td> <td class='pdform'>$gmcount</td></tr>";
echo "</table>";
}
}

echo "<div id='postgroupoptions'><input type='button' id='videopost' value='Video' /><input type='button' id='imagepost' value='Image' /><input type='button' id='messagepost' value='Message' /></div>";

echo "<div id='postgroup'><form action='postgroup.php' method='POST'><p>Post Message:</p><textarea name='gmsgpost'></textarea><br /><input type='hidden' value='$vgroupid' name='gpid'><input type='submit' name='gpost' value='Post' id='postbutton'></input></form></div>";

echo "<div id='postvideogroup'><form action='postgroup.php' method='POST'><p>Post Youtube Video Link:</p><textarea name='vdopost'></textarea><br /><input type='hidden' value='$vgroupid' name='gpid'><input type='submit' name='vidpost' value='Post' id='postbutton'></input></form></div>";

echo "<div id='postimagegroup'><form action='postgroupphotos.php' method='POST' enctype='multipart/form-data'><p>Post an Image:</p><input type='file' name='myfile' id='myfile' accept='image/*' /><br /><input type='hidden' value='$vgroupid' name='gpid'><input type='submit' name='upload' value='Upload'></form></div>";

$gmsgresult = $pdo->prepare("SELECT * FROM groupmessages WHERE GroupID=:GroupID ORDER BY Date DESC");
$gmsgresult->execute(array('GroupID'=>$vgroupid));
while($gmsgrow = $gmsgresult->fetch())
{
$gpostid = $gmsgrow['ID'];
$gpostuser = $gmsgrow['UserID'];
$gpostmsg = $gmsgrow['Post'];
$gposttime = $gmsgrow['Date'];
$gpostuimg = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$gpostuimg->execute(array('UserID'=>$gpostuser));
$gpui = $gpostuimg->fetch();
$guimgloc = $gpui['Thumb'];
$gpud = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$gpud->execute(array('UserID'=>$gpostuser));
$gpudrow = $gpud->fetch();
$gpuname = $gpudrow['Username'];
echo "<div class='postbox'>";
echo "<div id='postimg'><img id='profilecrop' src='$guimgloc' /></div>";
echo "<div id='posttime'>Posted on: $gposttime</div>";
echo "<h4>";
echo $gpuname;
echo "</h4>";
echo "<div id='postmessage'>".$gpostmsg."</div>";
if($gpostuser == $suid){
echo "<form action='grouppostdelete.php' method='POST'>";
echo "<input type='hidden' value='$vgroupid' name='gpdid' />";
echo "<input type='hidden' name='deletegpost' value='$gpostid' />";
echo "<input type='submit' name='delete' id='postdelete' value='Delete'>";
echo "</form>";	
echo "</div>";	
}
}
}
?>
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
echo "<td><a id='rglink' href='viewgroup.php?vgrpid=$rgid'><p>$rgn</p></a><font>$rgtype</font></td></tr>";
echo "</table>";
}
?>
</div>



<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
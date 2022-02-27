<?php
session_start();
include('includes/connect.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
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
<a class="list-group-item active" href="main.php"><span class='glyphicon glyphicon-home'></span> Home</a>
<a class="list-group-item" href="profile.php"><span class='glyphicon glyphicon-user'></span> Profile</a>
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
<ul class="nav nav-pills nav-justified">
<li><a href="main.php"><span class='glyphicon glyphicon-th-large'></span> My Board</a></li>
<li><a href="publicpost.php"><span class='glyphicon glyphicon-cloud'></span> Public Board</a></li>
<li class="active"><a href="friendboard.php"><span class='glyphicon glyphicon-th-list'></span> Friends Board</a></li>
</ul>		
</div>
</div>

<div class="row post-board">
<div class="col-md-12">

<div class="post-msg-box">
<form action="friendpost.php" method="POST" class="form-group"><label for=" ">Post Message:</label><textarea class="form-control" name="msgpost"></textarea><button class="btn btn-success pull-right" type="submit" name="post" id="postbutton">Post</button></form>
</div>

<div class="post-image-box">
<form action="friendpostphotos.php" method='POST' enctype='multipart/form-data' class="form-group"><label for=" ">Post an Image:</label><input type='file' name='myfile' id='myfile' accept="image/*" /><button class="btn btn-success pull-right" type='submit' name='upload'>Post</button></form>
</div>

<div class="post-video-box">
<form action="friendpost.php" method="POST" class="form-group"><label for=" ">Post Youtube Link:</label><textarea class="form-control" name="vdopost"></textarea><button class="btn btn-success pull-right" type="submit" name="vidpost" id="postbutton">Post</button></form>
</div>

<div class="btn-group">
<button type="button" class="btn btn-default btn-sm" id="messagepost">Message</button>
<button type="button" class="btn btn-default btn-sm" id="imagepost">Image</button>
<button type="button" class="btn btn-default btn-sm" id="videopost">Video</button>
</div>

</div>
</div>

<div class="row">
<div class="col-md-12">
<?php
$perpage = 20;
$msg = $pdo->prepare("SELECT * FROM messages WHERE UserID IN (SELECT Friend FROM friends WHERE friends.UserID=:UserID OR friends.Friend=:Friend)");
$msg->execute(array('UserID'=>$suid, 'Friend'=>$suid));
$msgcount = $msg->rowCount();
$pages = ceil(($msgcount) / $perpage);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$msgresult = $pdo->prepare("SELECT * FROM messages WHERE UserID IN (SELECT Friend FROM friends WHERE friends.UserID=:UserID OR friends.Friend=:Friend) ORDER BY Time DESC LIMIT $start, $perpage");
$msgresult->execute(array('UserID'=>$suid, 'Friend'=>$suid));
while($msgrow = $msgresult->fetch())
{
$posttime = $msgrow['Time'];
$postuid = $msgrow['UserID'];
$postfname = $pdo->prepare("SELECT * from userdetails WHERE UserID=:UserID");
$postfname->execute(array('UserID'=>$postuid));
$namerow = $postfname->fetch();
$pfname = $namerow['Firstname'];
$plname = $namerow['Lastname'];
$postm = $msgrow['Message'];
$postthumb = $pdo->prepare("SELECT * from imagedetails WHERE UserID=:UserID");
$postthumb->execute(array('UserID'=>$postuid));
$imgrow = $postthumb->fetch();
$postimg = $imgrow['Image'];
$postimgthumb = $imgrow['Thumb'];
echo "<div class='row post-message'><div class='col-md-3 col-xs-4'><div class='post-thumbnail'><img class='img-responsive' src='$postimgthumb' /></div></div>";
echo "<div class='col-md-9 col-xs-8'>";
if($postuid == $suid){
echo "<form action='friendpostdelete.php' method='POST'>";
echo "<input type='hidden' name='deletemsg' value='$posttime' />";
echo "<button class='close pull-right' name='delete' id='postdelete'>&times;</button>";
echo "</form>";
}
echo "<h5>";
echo $pfname." ".$plname;
echo "</h5>";
echo "<p>".$postm."</p>";
echo "<div class='label label-info pull-left'>$posttime</div>";
echo "</div></div>";
}
?>
<?php
echo "<ul class='pagination'>";
if($pages>=1 && $page<=$pages){
for($x = 1; $x <= $pages ; $x++){
echo ($x == $page) ? "<li><a id='selected' href='?page=$x'>$x</a> </li>" : "<li><a id='notselected' href='?page=$x'>$x</a> </li>";
}
}
echo "</ul>";
?>
</div>
</div>
</div>

<div class="col-md-3">
<div class="panel panel-primary">
<div class="panel-heading"><span class='glyphicon glyphicon-gift'></span> Birthday Alerts</div>
<div class="panel-body">
<?php
$bdayq = $pdo->prepare("SELECT * FROM userdetails WHERE DAY(Dob)=DAY(curdate()) AND MONTH(dob)=MONTH(curdate())");
$bdayq->execute();
if($bdayq->rowCount() == 0){
echo "No Birthdays today";
}
else{
while($bdrow = $bdayq->fetch()){
$bdusrid = $bdrow['UserID'];
$bdfname = $bdrow['Firstname'];
$bdlname = $bdrow['Lastname'];
$bdusrnme = $bdrow['Username'];
$agetake = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$agetake->execute(array(
'UserID'=>$bdusrid
));
while($atrow = $agetake->fetch()){
$dob = $atrow['Dob'];
$bdage = floor( (strtotime(date('Y-m-d')) - strtotime($dob)) / 31556926);
if($bdusrnme == $suid){
echo "Happy Birthday !<br /><a href='inbox.php' class='btn btn-default btn-sm pull-right'>Go to Inbox</a>";
}
else{
echo $bdfname . " " . $bdlname . " turns " . $bdage ."<br />";
echo "<form action='replymail.php' method='POST' class='form-group'>";
echo "<input type='hidden' name='toreply' value='$bdusrnme' />";
echo "<button type='submit' name='reply' class='btn btn-primary btn-sm pull-right'>Send Message</button>";
echo "</form>";
}
}
}
}
?>
</div>
</div>

<div class="panel panel-default">
<div class="panel-heading"><span class='glyphicon glyphicon-envelope'></span> Mail Box</div>
<div class="panel-body">
<?php
$mailnotify = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever = :Reciever AND Status = :Status");
$mailnotify->execute(array(
			'Reciever'=>$suid,
			'Status'=>'U'
));
$unreadmails = $mailnotify->rowCount();
if($unreadmails == 0){
echo "No new mails";
}
else{
echo "$unreadmails new/unread mail(s)<br />";
echo "<a href='inbox.php' class='btn btn-default btn-sm pull-right'>Go to Inbox</a>";
}
?>
</div>
</div>

<div class="panel panel-info">
<div class="panel-heading"><span class='glyphicon glyphicon-th-list'></span> Friend Requests</div>
<div class="panel-body">
<?php
$fmsg = $pdo->prepare("SELECT * FROM requests WHERE Requested=:Requested");
$fmsg->execute(array('Requested'=>$suid));
$fmsgcount= $fmsg->rowCount();
if($fmsgcount == 0){
echo "No friend requests";
}
else{
echo "$fmsgcount friend request(s)<br />";
echo "<a class='btn' href='friendrequest.php'>View Requests</a>";
}
?>
</div>
</div>

<div class="panel panel-danger">
<div class="panel-heading"><span class='glyphicon glyphicon-comment'></span> Public Chat</div>
<div class="panel-body">
<a class='btn btn-danger btn-sm pull-right' href='chat.php'>Chat Now!</a>
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
$("#messagepost").click(function(){
$(".post-board .post-msg-box").show();
$(".post-board .post-video-box").hide();
$(".post-board .post-image-box").hide();
});
$("#imagepost").click(function(){
$(".post-board .post-msg-box").hide();
$(".post-board .post-video-box").hide();
$(".post-board .post-image-box").show();
});
$("#videopost").click(function(){
$(".post-board .post-msg-box").hide();
$(".post-board .post-video-box").show();
$(".post-board .post-image-box").hide();
});
});
</script>
</body>
</html>
<?php
session_start();
include('includes/header.php');
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
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#videopost").click(function(){
$(".messageboard").hide();
$(".imageboard").hide();
$(".videoboard").show();
});
$("#messagepost").click(function(){
$(".messageboard").show();
$(".videoboard").hide();
$(".imageboard").hide();
});
$("#imagepost").click(function(){
$(".messageboard").hide();
$(".videoboard").hide();
$(".imageboard").show();
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
<li><a id="onlink" href="main.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="friends.php">Friends</a></li>
<li><a href="photos.php">Photos</a></li>
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
<li><a id="onlink" href="main.php">My Board</a></li>
<li><a href="publicpost.php">Public Board</a></li>
<li><a href="friendboard.php">Friends Board</a></li>
</ul>		
</div>
</div>

<div id="postoptions">
<input type="button" id="videopost" value="Video" />
<input type="button" id="imagepost" value="Image" />
<input type="button" id="messagepost" value="Message" />
</div>

<div class="messageboard"><form action="message.php" method="POST"><p>Post Message:</p><textarea name="msgpost"></textarea><br /><input type="submit" name="post" value='Post' id="postbutton"></input></form><br /></div>

<div class="videoboard"><form action="message.php" method="POST"><p>Post Youtube Video Link:</p><textarea name="vdopost"></textarea><br /><input type="submit" name="vidpost" value='Post' id="postbutton"></input></form><br /></div>

<div class="imageboard"><form action="postphotos.php" method='POST' enctype='multipart/form-data'><p>Post an Image:</p><input type='file' name='myfile' id='myfile' accept="image/*" /><br /><input type='submit' name='upload' value='Upload'></form><br /></div>

<div id="post">
<?php
$perpage = 20;
$msgcount = $pdo->prepare("SELECT * FROM messages WHERE UserID=:UserID");
$msgcount->execute(array('UserID'=>$suid));
$pages = ceil($msgcount->rowCount() / $perpage);
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$msgresult = $pdo->prepare("SELECT * FROM messages WHERE UserID=:UserID ORDER BY Time DESC LIMIT $start, $perpage");
$msgresult->execute(array('UserID'=>$suid));
while($msgrow = $msgresult->fetch())
{
$posttime = $msgrow['Time'];
$postuid = $msgrow['UserID'];
$postm = $msgrow['Message'];
$msgud = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$msgud->execute(array('UserID'=>$postuid));
while($udrow = $msgud->fetch()){
$udfname = $udrow['Firstname'];
$udlname = $udrow['Lastname'];
$uimgd = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$uimgd->execute(array('UserID'=>$postuid));
while($imdrow = $uimgd->fetch()){
$uthumbloc = $imdrow['Thumb'];
echo "<div class='postbox'>";
echo "<div id='postimg'><img id='profilecrop' src='$uthumbloc' /></div>";
echo "<div id='posttime'>Posted on: $posttime</div>";
echo "<h4>";
echo $udfname." ".$udlname;
echo "</h4>";
echo "<div id='postmessage'>".$postm."</div>";
echo "<form action='postdelete.php' method='POST'>";
echo "<input type='hidden' name='deletemsg' value='$posttime' />";
echo "<input type='submit' name='delete' id='postdelete' value='Delete'>";
echo "</form>";
echo "</div>";
}
}
}
?>
<?php
echo "<div id='pagenumbers'>";
if($pages>=1 && $page<=$pages){
for($x = 1; $x <= $pages ; $x++){
echo ($x == $page) ? "<a id='selected' href='?page=$x'>$x</a> " : "<a id='notselected' href='?page=$x'>$x</a> ";
}
}
echo "</div>";
?>
</div>
</div>
</div>

<div id="notification">
<h5>Birthday Alerts</h5>
<?php
$bdayq = $pdo->prepare("SELECT * FROM userdetails WHERE DAY(Dob)=DAY(curdate()) AND MONTH(dob)=MONTH(curdate())");
$bdayq->execute();
if($bdayq->rowCount() == 0){
echo "<p>No Birthdays today</p>";
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
echo "<div id='bdbox' style='border-bottom: none; padding-bottom: 20px;'><p>Happy Birthday !</p><br /><input id='addmbdf' type='button' onClick=parent.location='inbox.php' value='View Birthday Messages'></div>";
}
else{
echo "<div id='bdbox'>";
echo "<p>".$bdfname . " " . $bdlname . " turns " . $bdage ."</p><br />";
echo "<form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$bdusrnme' />";
echo "<input type='submit' name='reply' id='addbdf' value='Send Message'>";
echo "</form>";
echo "</div>";
}
}
}
}
?>
</div>
<div id="notification">
<h5>Mail Box</h5>
<?php
$mailnotify = $pdo->prepare("SELECT * FROM maildetails WHERE Reciever = :Reciever AND Status = :Status");
$mailnotify->execute(array(
			'Reciever'=>$suid,
			'Status'=>'U'
));
$unreadmails = $mailnotify->rowCount();
if($unreadmails == 0){
echo "<p>No new mails</p>";
}
else{
echo "<p>$unreadmails new/unread mail(s)</p>";
echo "<div id='bdbox'><input id='addmbdf' type='button' onClick=parent.location='inbox.php' value='View Inbox'></div>";
}
?>
</div>

<div id="notification">
<h5>Friend Requests</h5>
<?php
$fmsg = $pdo->prepare("SELECT * FROM requests WHERE Requested=:Requested");
$fmsg->execute(array('Requested'=>$suid));
$fmsgcount= $fmsg->rowCount();
if($fmsgcount == 0){
echo "<p>No friend requests";
}
else{
echo "<p>$fmsgcount friend request(s)</p>";
echo "<div id='bdbox'><input id='addmbdf' type='button' onClick=parent.location='friendrequest.php' value='View Requests'></div>";
}
?>
</div>

<div id="notification">
<h5>Public Chat</h5>
<p>Chat on public now !</p>
<div id='bdbox' style='border-bottom: none; padding-bottom: 20px; margin-top: 30px;'><input id='addmbdf' type='button' onClick=parent.location='chat.php' value='Chat Now'></div>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</div>
</body>
</html>
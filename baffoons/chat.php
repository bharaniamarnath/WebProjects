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
<!DOCTYPE html>
<html>
<head>
<title>Baffoons Chat Homepage</title>
<link rel="stylesheet" type="text/css" href="../css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#ChatText").keyup(function(e){
var ChatText = $("#ChatText").val();
if(e.keyCode == 13){
$.ajax({
type:'POST',
url:'insertchat.php',
data:{ChatText:ChatText},
success: function(){
$("#ChatMessages").load("displaychat.php");
$("#ChatText").val("");
}
});
}
});
setInterval(function(){
$("#ChatMessages").load("displaychat.php");
},1500);
$("#ChatMessages").load("displaychat.php");
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
<div id="chatwindow">
<h3>Baffoons Public Chat</h3>
<div id="ChatBig">
<div id="ChatMessages">
</div>
<textarea id="ChatText" name="ChatText"></textarea>
</div>
</div>
</div>
</div>
<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</div>
</body>
</html>
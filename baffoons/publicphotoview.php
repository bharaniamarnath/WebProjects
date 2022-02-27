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
<title>Baffoons - Image Upload</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/submenu.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$(".picscreen").hide();
$(".picscreen").load(function(){
$(".picscreen").show();
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
<li><a href="photos.php">Private Photos</a></li>
<li><a id="onlink" href="publicphotos.php">Public Photos</a></li>
<li><a href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<?php
if(isset($_GET['photoid'])){
$picvdet = $_GET['photoid'];
$vpicres = $pdo->prepare("SELECT * FROM publicphotos WHERE ID=:ID");
$vpicres->execute(array('ID'=>$picvdet));
while($vpicrow = $vpicres->fetch()){
$vpicid = $vpicrow['ID'];
$vpicimg = $vpicrow['Photo'];
$vpicimgthumb = $vpicrow['Thumb'];
$vpicname= $vpicrow['Filename'];
$vpicuname = $vpicrow['UserID'];
$vpicdesc = $vpicrow['Description'];
$vpicdate = $vpicrow['Date'];
$vpicud = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$vpicud->execute(array('UserID'=>$vpicuname));
$vpudrow = $vpicud->fetch();
$vpicudname = $vpudrow['Username'];
$vote = $pdo->prepare("SELECT * FROM publicvotes WHERE ID=:ID");
$vote->execute(array('ID'=>$vpicid));
$countvote = $vote->rowCount();

echo "<div class='photobox'>";
echo "<table class='photoedit' style='border-bottom: 1px solid #ccc; padding-bottom: 10px;'>";
echo "<form action='publiccomment.php' method='POST'>";
echo "<th><h4>Public Photo: $vpicname</h4></th>";
echo "<tr>";
echo "<td><img class='picscreen' src=$vpicimg /></td>";
echo "</tr>";
echo "<tr>";
echo "<td id='aboutpic'><h4>Uploaded by: $vpicudname<br />$vpicdate<br />$vpicdesc</h4></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='picedit'>Comment Photo: <div class='votes'>Votes: $countvote</div><br /><br /><textarea name='piccomm'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<input type='hidden' name='commentpic' value='$vpicid' />";
echo "<td><input type='submit' name='commpic' id='ppbutton' value='Comment'>";
echo "<input type='button' onClick='history.back()' value='Back' id='ppbutton'></input></td>";
echo "</form></td><td>";
$chkvote = $pdo->prepare("SELECT * FROM publicvotes WHERE ID=:ID AND UserID=:UserID");
$chkvote->execute(array('ID'=>$vpicid, 'UserID'=>$suid));
if($chkvote->rowCount()==0){
	echo "<form action='photovotes.php' method='POST'>";
	echo "<input type='hidden' name='votepic' value='$vpicid' />";
	echo "<input type='submit' name='vote' value='Vote' id='ppvbutton'></input></td>";
	echo "</form>";
}
echo "</tr>";
echo "</table>";
$dispcomm = $pdo->prepare("SELECT * FROM photocomments WHERE PhotoID=:PhotoID ORDER BY Date DESC");
$dispcomm->execute(array('PhotoID'=>$vpicid));
while($dcrow = $dispcomm->fetch()){
$dcuid = $dcrow['UserID'];
$dccomment = $dcrow['Comment'];
$dcdate = $dcrow['Date'];
$dcud = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$dcud->execute(array('UserID'=>$dcuid));
while($dcudrow = $dcud->fetch()){
$dcudname = $dcudrow['Username'];
$dcpic = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$dcpic->execute(array('UserID'=>$dcuid));
while($dcprow = $dcpic->fetch()){
$dcupicthumb = $dcprow['Thumb'];
echo "<div class='postbox'>";
echo "<div id='postimg'><img id='profilecrop' src='$dcupicthumb' /></div>";
echo "<div id='posttime'>Posted on: $dcdate</div>";
echo "<h4>";
echo $dcudname;
echo "</h4>";
echo "<font id='postmessage'>".$dccomment."</font>";
echo "<form action='deletecomment.php' method='POST'>";
echo "<input type='hidden' name='commpicid' value='$vpicid' />";
echo "<input type='hidden' name='commdate' value='$dcdate' />";
echo "<input type='hidden' name='commuser' value='$dcuid' />";
echo "<input type='submit' name='delete' id='postdelete' value='delete'>";
echo "</form>";		
echo "</div>";
}
}
}
}
}
?>
</div>
</div>
</div>
</div>
<div id="controlmenu"><input id="signouticon" type='button' onClick=parent.location='signout.php' value=''></input><input id="accounticon" type='button' onClick=parent.location='account.php' value=''></input><input id="groupicon" type='button' onClick=parent.location='groups.php' value=''></input><input id="mailicon" type='button' onClick=parent.location='inbox.php' value=''></input><input id="photoicon" type='button' onClick=parent.location='photos.php' value=''></input><input id="friendicon" type='button' onClick=parent.location='friends.php' value=''></input>
<input id="profileicon" type='button' onClick=parent.location='profile.php' value=''></input>
<input id="homeicon" type='button' onClick=parent.location='main.php' value=''></input>
</div>
<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
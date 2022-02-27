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
$proresult = $pdo->prepare("SELECT * FROM personaldetails WHERE UserID=:UserID");
$proresult->execute(array('UserID'=>$suid));
while($prow = $proresult->fetch())
{
$userid = $prow['UserID'];
$occ = $prow['Occupation'];
$cont = $prow['Contact'];
$city = $prow['City'];
$cntry = $prow['Country'];
$schl = $prow['School'];
$wrk = $prow['Work'];
$lang = $prow['Language'];
$marital = $prow['Marital'];
$abtme = $prow['About'];
if($cont == 0){
$cont = "";
}
if($abtme == ""){
$abtme = "Hello, I am ".$fname." ".$lname;
}	
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
$("#profileimg").hide();
$("#profileimgcrop").load(function(){
$("#profileimg").show();
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
<li><a id="onlink" href="profile.php">Profile</a></li>
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
<li><a id="onlink" href="profile.php">Profile</a></li>
<li><a href="calendar.php">calendar</a></li>
<li><a href="activities.php">Activities</a></li>
<li><a href="addevent.php">Add Events</a></li>
</ul>		
</div>
</div>
<div class="messageboard" style="border:none;">
<div id="profilecover"><?php echo "<img src='$imgloc' />"?></div>
<table class="proform">
<tr><td id="profilehead"><div id="profileimg"><?php echo "<a href='imageupload.php'><img src='$imgloc' id='profileimgcrop' /></a>"; ?></div></td><td id="profilehead"><h2><?php echo $fname . " ". $lname; ?></h2></td></tr>
<tr><th>About Me: </th></tr><tr><td id="aboutme" colspan="2"><?php echo $abtme; ?></td></tr>	
<th>Basic</th>
<tr><td>Username:</td> <td class="pdform"><?php echo $usrnme; ?></td></tr>
<tr><td>First name:</td> <td class="pdform"><?php echo $fname; ?></td></tr>
<tr><td>Last name:</td> <td class="pdform"><?php echo $lname; ?></td></tr>
<tr><td>Gender:</td> <td class="pdform"><?php echo $gend; ?></td></tr>
<tr><td>Date of Birth:</td> <td class="pdform"><?php echo $dob; ?></td></tr>
<tr><td>Age:</td> <td class="pdform"><?php echo $age; ?></td></tr>

<th>Contact</th>
<tr><td>City:</td> <td class="pdform"><?php echo $city; ?></td></tr>
<tr><td>Country:</td> <td class="pdform"><?php echo $cntry; ?></td></tr>
<tr><td>Contact:</td> <td class="pdform"><?php echo $cont; ?></td></tr>
<tr><td>Email:</td> <td class="pdform"><?php echo $mail; ?></td></tr>

<th>Professional</th>
<tr><td>Occupation:</td> <td class="pdform"><?php echo $occ; ?></td></tr>
<tr><td>School:</td> <td class="pdform"><?php echo $schl; ?></td></tr>
<tr><td>Work Place:</td> <td class="pdform"><?php echo $wrk; ?></td></tr>

<th>Personal</th>
<tr><td>Languages known:</td> <td class="pdform"><?php echo $lang; ?></td></tr>
<tr><td>Marital Status:</td> <td class="pdform"><?php echo $marital; ?></td></tr>
</table>
<input type='button' onClick=parent.location='updateprofile.php' value='Edit Profile'></input>
</div>
</div>
</div>

<div id="notification">
<h5>Favorites</h5>
<?php
$getfavs = $pdo->prepare("SELECT * FROM favorites WHERE UserID=:UserID");
$getfavs->execute(array('UserID'=>$suid));
while($gfrow = $getfavs->fetch()){
$gfacts = $gfrow['Activities'];
$gffoods = $gfrow['Foods'];
$gfmovies = $gfrow['Movies'];
$gfmusic = $gfrow['Music'];
$gfbooks = $gfrow['Books'];
$gfgames = $gfrow['Games'];
$gfpeople = $gfrow['People'];
echo "<h4>Activities</h4><p>".$gfacts."</p>";
echo "<h4>Foods</h4><p>$gffoods</p>";
echo "<h4>Movies</h4><p>$gfmovies</p>";
echo "<h4>Music</h4><p>$gfmusic</p>";
echo "<h4>Books</h4><p>$gfbooks</p>";
echo "<h4>Games</h4><p>$gfgames</p>";
echo "<h4>People</h4><p>$gfpeople</p>";
}
?>
<input type="button" id="addrpf" onclick="location.href='favorites.php'" value='Update Favorites' style="margin: 20px 10px;"/>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</div>
</body>
</html>
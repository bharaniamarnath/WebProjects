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
$fprofid = $_GET['fpid'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
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
<li><a id="onlink" href="main.php">Profile</a></li>
<li><a href="albumfriend.php?faid=<?php echo $fprofid; ?>">Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php
$fpid = $_GET['fpid'];
$getfid = $pdo->prepare("SELECT UserID FROM userdetails WHERE Username=:Username");
$getfid->execute(array('Username'=>$fpid));
$getfrow = $getfid->fetch();
$fproid = $getfrow['UserID'];
$fprores = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$fprores->execute(array('UserID'=>$fproid));
$fprow = $fprores->fetch();
$userid = $fprow['UserID'];
$usrnme = $fprow['Username'];
$fname = $fprow['Firstname'];
$lname = $fprow['Lastname'];
$gend = $fprow['Gender'];
$mail = $fprow['Email'];
$dob = $fprow['Dob'];
$age = floor( (strtotime(date('Y-m-d')) - strtotime($dob)) / 31556926);

$fproresult = $pdo->prepare("SELECT * FROM personaldetails WHERE UserID=:UserID");
$fproresult->execute(array('UserID'=>$fproid));
$fpprow = $fproresult->fetch();
$userid = $fpprow['UserID'];
$occ = $fpprow['Occupation'];
$cont = $fpprow['Contact'];
$city = $fpprow['City'];
$cntry = $fpprow['Country'];
$schl = $fpprow['School'];
$wrk = $fpprow['Work'];
$lang = $fpprow['Language'];
$marital = $fpprow['Marital'];
$abtme = $fpprow['About'];	
if($cont == 0){
$cont = "";
}
if($abtme == ""){
$abtme = "Hello, I am ".$fname." ".$lname;
}
$fimgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$fimgresult->execute(array('UserID'=>$fproid));
$frow = $fimgresult->fetch();
$fimgloc = $frow['Image'];

echo "<table class='proform'>";
echo "<div id='profilecover'><img src='$fimgloc' /></div>";
echo "<tr><td id='profilehead'><div id='profileimg'><?php echo '<a href='imageupload.php'><img src='$fimgloc' id='profileimgcrop' /></a></div></td><td id='profilehead'><h2>$fname $lname</h2></td>";
echo "<td id='grpbutton'><form action='replymail.php' method='POST'>";
echo "<input type='hidden' name='toreply' value='$usrnme' />";
echo "<input type='submit' name='reply' id='addvf' value='Send Message'>";
echo "</form>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<table class='proform'>";
echo "<tr><th>About Me: </th></tr><tr><td id='aboutme' colspan='2'>$abtme</td></tr>";	
echo "<th>Basic Details</th>";
echo "<tr><td class='proform'>Username:</td> <td class='pdform'>$usrnme</td></tr>";
echo "<tr><td class='proform'>First name:</td> <td class='pdform'>$fname</td></tr>";
echo "<tr><td class='proform'>Last name:</td> <td class='pdform'>$lname</td></tr>";
echo "<tr><td class='proform'>Gender:</td> <td class='pdform'>$gend</td></tr>";
echo "<tr><td class='proform'>Date of Birth:</td> <td class='pdform'>$dob</td></tr>";
echo "<tr><td class='proform'>Age:</td> <td class='pdform'>$age</td></tr>";
echo "</table>";
echo "<table class='proform'>";
echo "<th>Contact Details</th>";
echo "<tr><td class='proform'>City:</td> <td class='pdform'>$city</td></tr>";
echo "<tr><td class='proform'>Country:</td> <td class='pdform'>$cntry</td></tr>";
echo "<tr><td class='proform'>Contact:</td> <td class='pdform'>$cont</td></tr>";
echo "<tr><td class='proform'>Email:</td> <td class='pdform'>$mail</td></tr>";
echo "</table>";
echo "<table class='proform'>";
echo "<th>Professional Details</th>";
echo "<tr><td class='proform'>Occupation:</td> <td class='pdform'>$occ</td></tr>";
echo "<tr><td class='proform'>School:</td> <td class='pdform'>$schl</td></tr>";
echo "<tr><td class='proform'>Work Place:</td> <td class='pdform'>$wrk</td></tr>";
echo "</table>";
echo "<table class='proform'>";
echo "<th>Personal Details</th>";
echo "<tr><td class='proform'>Languages known:</td> <td class='pdform'>$lang</td></tr>";
echo "<tr><td class='proform'>Marital Status:</td> <td class='pdform'>$marital</td></tr>";
echo "</table>";
echo "</div>";
echo "<input type='button' onclick=parent.location='people.php' value='People' id='vfbutton' />";
echo "<br />";
?>
</div>
</div>

<div id="notification">
<h5>Favorites</h5>
<?php
$getfavs = $pdo->prepare("SELECT * FROM favorites WHERE UserID=:UserID");
$getfavs->execute(array('UserID'=>$fproid));
while($gfrow = $getfavs->fetch()){
$gfacts = $gfrow['Activities'];
$gffoods = $gfrow['Foods'];
$gfmovies = $gfrow['Movies'];
$gfmusic = $gfrow['Music'];
$gfbooks = $gfrow['Books'];
$gfgames = $gfrow['Games'];
$gfpeople = $gfrow['People'];
echo "<h4>Activities</h4><p>$gfacts</p>";
echo "<h4>Foods</h4><p>$gffoods</p>";
echo "<h4>Movies</h4><p>$gfmovies</p>";
echo "<h4>Music</h4><p>$gfmusic</p>";
echo "<h4>Books</h4><p>$gfbooks</p>";
echo "<h4>Games</h4><p>$gfgames</p>";
echo "<h4>People</h4><p>$gfpeople</p>";
}
?>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
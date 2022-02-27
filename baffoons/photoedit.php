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
</ul>		
</div>
</div>
</div>
<div id="rightpane">
<div class="postboard">
<div id="submenubar">
<div id="holder">
<ul>
<li><a id="onlink" href="photos.php">Private Photos</a></li>
<li><a href="publicphotos.php">Public Photos</a></li>
<li><a href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php
if(isset($_POST['picedit'])){
$pictag = $_POST['editpic'];
$picdet = $pdo->prepare("SELECT * FROM photodetails WHERE Photo=:Photo");
$picdet->execute(array('Photo'=>$pictag));
while($pedrow = $picdet->fetch()){
$peid = $pedrow['ID'];
$pename = $pedrow['Filename'];
$pedes = $pedrow['Description'];
$peimg = $pedrow['Photo'];
echo "<div class='photobox'>";
echo "<table class='photoedit'>";
echo "<th><h4>$pename</h4></th>";
echo "<form action='photoupdate.php' method='POST'>";
echo "<tr>";
echo "<td><img id='picscreen' src=$peimg /></td>";
echo "<input type='hidden' name='udpic' value='$peid' />";
echo "</tr>";
echo "<tr>";
echo "<td class='picedit'><h4>Title:</h4><input type='text' name='picname' value='$pename'></input></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='picedit'><h4>Description:</h4><textarea name='picdesc'>$pedes</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td class='picedit'><input type='submit' name='picupdate' id='photoedit' value='Update Photo'>";
echo "<input type='button' onClick=parent.location='photos.php' value='Back' id='photoedit'></input></td>";
echo "</tr>";
echo "</form>";
echo "</table>";
echo "</div>";
}
}
?>
</div>
</div>
</div>

<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
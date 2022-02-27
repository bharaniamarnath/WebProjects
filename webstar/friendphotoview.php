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
<li><a id="onlink" href="photos.php">Private Photos</a></li>
<li><a href="publicphotos.php">Public Photos</a></li>
<li><a href="uploadphotos.php">Upload Photos</a></li>
</ul>		
</div>
</div>
<div class="messageboard">
<?php
if(isset($_GET['imgid'])){
$pictag = $_GET['imgid'];
$picdet = $pdo->prepare("SELECT * FROM photodetails WHERE ID=:ID");
$picdet->execute(array('ID'=>$pictag));
while($pedrow = $picdet->fetch()){
$pename = $pedrow['Filename'];
$pedes = $pedrow['Description'];
$peimg = $pedrow['Photo'];
$pedate = $pedrow['Date'];
echo "<div class='photobox'>";
echo "<table class='photoedit'>";
echo "<th><h4>Private Photo: $pename</h4></th>";
echo "<tr>";
echo "<td><img class='picscreen' src=$peimg /></td>";
echo "</tr>";
echo "<tr>";
echo "<td id='aboutpic'><h4>$pedate<br />$pedes</h4></td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td><input type='button' onClick='history.back()' value='Back' id='photoviewback'></input></td>";
echo "</tr>";
echo "</form>";
echo "</table><br />";
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
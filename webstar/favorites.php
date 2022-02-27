<?php
session_start();
include('includes/header.php');
include('includes/connect.php');
include('includes/class.profile.php');
include('includes/alerts.php');
if(!isset($_SESSION['user'])){
echo $logdenyalert;
}
$suid = $_SESSION['user'];
include "includes/class.info.php";
?>
<?php
$profavresult = $pdo->prepare("SELECT * FROM favorites WHERE UserID=:UserID");
$profavresult->execute(array('UserID'=>$suid));
$fvrow = $profavresult->fetch();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons - Profile Update</title>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
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
<div class="messageboard">
<h3>Profile Update - Favorites </h3><br />
<h4 id="aboutme">Fill in the favorites in each section to give more attraction to the profile. Use comma ',' seperator for each favorites for a clear look.</h4>
<table class="regform">
<form action="updatefavorites.php" method="POST">
<tr><td class="regform">Favorite Activities/Hobbies: </td> <td class="regform"><textarea name="favacts" id="favacts" rows="5" cols="30"><?php echo $fvrow['Activities']; ?></textarea></td></tr>	
<tr><td class="regform">Favorite Foods/Cuisines: </td> <td class="regform"><textarea name="favfoods" id="favfoods" rows="5" cols="30"><?php echo $fvrow['Foods']; ?></textarea></td></tr>
<tr><td class="regform">Favorite Movies/TV Shows: </td> <td class="regform"><textarea name="favmovies" id="favmovies" rows="5" cols="30"><?php echo $fvrow['Movies']; ?></textarea></td></tr>
<tr><td class="regform">Favorite Music/Songs: </td> <td class="regform"><textarea name="favmusic" id="favmusic" rows="5" cols="30"><?php echo $fvrow['Music']; ?></textarea></td></tr>
<tr><td class="regform">Favorite Books/Stories: </td> <td class="regform"><textarea name="favbooks" id="favbooks" rows="5" cols="30"><?php echo $fvrow['Books']; ?></textarea></td></tr>
<tr><td class="regform">Favorite Games/Sports: </td> <td class="regform"><textarea name="favgames" id="favgames" rows="5" cols="30"><?php echo $fvrow['Games']; ?></textarea></td></tr>
<tr><td class="regform">Favorite People/Characters: </td> <td class="regform"><textarea name="favpeople" id="favpeople" rows="5" cols="30"><?php echo $fvrow['People']; ?></textarea></td></tr>
<tr><td></td><td><input type="submit" name="updatefav" id="updatefav" value="Update Favorites" /></td></tr>
</form>
</table>
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

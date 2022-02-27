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
<title>Sign Up</title>
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
<li><a href="profile.php">Profile</a></li>
<li><a href="calendar.php">calendar</a></li>
<li><a href="activities.php">Activities</a></li>
<li><a id="onlink" href="addevent.php">Add Events</a></li>
</ul>
</div>
<div class="messageboard" style="border:none;">
<font id='asubhead'>Add an event to the calendar</font>
<div class="postbox">
<form action="eventsave.php" method="POST">
<table>
<tr>
<td class="event">Event Name:</td><td class="event"><input type="text" name="eventname"/></td>
</tr>
<tr><td class="event">Event Date:</td><td class="event"><select name="edate">
<option value="">Date</option>
<?php for($i=1;$i<=31;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>&nbsp;
<select name="emonth">
<option value="">Month</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>&nbsp;
<select name="eyear">
<option value="">Year</option>
<?php for($i=1910;$i<=date('Y');$i++):?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select></td></tr>
<tr><td class="event">Event Type:</td><td class="event"><select name="eventtype">
<option  value=""/>
<option value="Birthday">Birthday</option>
<option value="Personal">Personal</option>
<option value="School">School</option>
<option value="Work">Work</option>
<option value="Festival">Festival</option>
<option value="Public">Public</option>
<option value="National">National</option>
<option value="World">World</option>
<option value="Sport">Sport</option>
<option value="Media">Media</option>
<option value="Others">Others</option>
</select>
</td></tr><tr><td class="event">Event Description: </td><td class="event"><textarea name="eventdes"></textarea></td></tr>
<tr><td class="event"></td><td class="event"><input type="submit" name="addeve" value="Add Event"/></td>
</table>
</form>
</div>
</div>
</div>
</div>
</div>


<div class="footlink"><a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a> . <a href="feedback.php" class="terms">Feedback</a></div>
<div id="footer">&copy;Copyrights 2013. Baffoons Network.</div>
</body>
</html>
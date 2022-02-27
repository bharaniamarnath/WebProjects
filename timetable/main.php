<?php
ob_start();
session_start();
include("includes/connect.php");
if(!isset($_SESSION['staff'])){
header("Location: panel.php");
}
$sname = $_SESSION['staff'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Time Table Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-8">
<?php 
include('header.php');
?>
<div class="row">
<div class="col-md-8 col-md-offset-2">
<?php
$getsid = $pdo->prepare("SELECT * FROM users WHERE username=:username");
$getsid->execute(array(
				"username"=>$sname
				));
while($gnrow = $getsid->fetch()){
$gnfid = $gnrow['Id'];
$getname = $pdo->prepare("SELECT * FROM staffs WHERE sid=:sid");
$getname->execute(array(
				"sid"=>$gnfid
				));
while($girow = $getname->fetch()){
$gifname = $girow['fname'];
$gilname = $girow['lname'];
echo "<h3>Welcome, " . $gifname . " " . $gilname . "</h3><hr>";
}
}
?>
<div class="row">
<div class="col-md-6 today">
<h4>Today's Classes</h4>
<?php
$jd=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
$setday = jddayofweek($jd,1);
$getstfid = $pdo->prepare("SELECT * FROM users WHERE username=:username");
$getstfid->execute(array(
				"username"=>$sname
				));
while($gnsrow = $getstfid->fetch()){
$gnsfid = $gnsrow['Id'];
$getdprd = $pdo->prepare("SELECT * FROM periods WHERE staff=:staff AND pday=:pday");
$getdprd->execute(array(
				"staff"=>$gnsfid,
				"pday"=>$setday
				));
if($getdprd->rowCount() == 0){
echo "<h4>No classes today</h4>";
}
while($gdprow = $getdprd->fetch()){
$gdpid = $gdprow['bid'];
$gdprd = $gdprow['period'];
$gdsc = $gdprow['subcode'];
$getdcd = $pdo->prepare("SELECT * FROM branch WHERE Id=:dbid");
$getdcd->execute(array("dbid"=>$gdpid));
while($gcddrow = $getdcd->fetch()){
$ddegree = $gcddrow['Degree'];
$ddepartment = $gcddrow['Department'];
$dyear = $gcddrow['Year'];
echo "<h5> Period " . $gdprd . " - " . $ddegree . " - " . $ddepartment . ", " . $dyear . " year - " . $gdsc . "</h5>";
}
}
}
?> 
</div>
<div class="col-md-6 clock">
<h3>Time</h3>
<h4><div id="clockbox"></div></h4>
</div>
</div>
<hr>
<center><h3>Select Menu</h3></center><hr>
<ul class="menubox">
<li><a href="selectdept.php">View Table</a></li>
<li><a href="viewclass.php">View Classes</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
<hr>
<h3>Time Schedule</h3>
<?php
$showint = $pdo->prepare("SELECT * FROM schedule");
$showint->execute();
echo "<div class='row'><div class='col-md-6'>";
echo "<table class='table table-bordered timetable'><thead><tr><th>Period</th><th>Time</th></tr></thead>";
while($sirow = $showint->fetch()){
$siperiod = $sirow['period'];
$sistart = $sirow['pstart'];
$siend = $sirow['pend'];
$sitime = $sistart . " to " . $siend;
echo "<tr><td>" . $siperiod . "</td>";
echo "<td>" . $sitime . "</td></tr>";
}
echo "</table>";
echo "</div></div>";
?>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
tday  = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth= new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
d = new Date();
dx = d.toGMTString();
dx = dx.substr(0,dx.length -3);
d.setTime(Date.parse(dx))
d.setSeconds(d.getSeconds() + <?php date_default_timezone_set('Asia/Calcutta'); echo date('Z'); ?>);
nday   = d.getDay();
nmonth = d.getMonth();
ndate  = d.getDate();
nyear = d.getYear();
nhour  = d.getHours();
nmin   = d.getMinutes();
if(nyear<1000) nyear=nyear+1900;

     if(nhour ==  0) {ap = " AM";nhour = 12;} 
else if(nhour <= 11) {ap = " AM";} 
else if(nhour == 12) {ap = " PM";} 
else if(nhour >= 13) {ap = " PM";nhour -= 12;}

if(nmin <= 9) {nmin = "0" +nmin;}


document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+"<br /><div class='time'>"+nhour+":"+nmin+ap+"</div>";
setTimeout("GetClock()", 1000);
}
window.onload=GetClock;
</script>
</body>
</html>
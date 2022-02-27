<?php
ob_start();
session_start();
include("includes/connect.php");
if(!isset($_SESSION['admin'])){
header("Location: index.php");
}
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
<ul class="nav nav-pills">
  <li><a href="main.php">Control Panel</a></li>
  <li><a href="selectdept.php">Add Table</a></li>
  <li><a href="selectclass.php">Add Class</a></li>
</ul>
<h3>Set Intervals</h3>
<?php
if(isset($_POST['schedule'])){
$empsch = $pdo->prepare("TRUNCATE schedule");
$empsch->execute();
$shour = $_POST['shour'];
$sminute = $_POST['sminute'];
$ehour = $_POST['ehour'];
$eminute = $_POST['eminute'];
$duration = $_POST['duration'];
$startat = $shour . ":" . $sminute;
$endat = $ehour . ":" . $eminute;

$period = array("1","2","Break","3","4","5","Lunch","6","7","8");

foreach($period as $i) {
$addperiod = $pdo->prepare("INSERT INTO schedule (period) VALUES (:period)");
$addperiod->execute(array(
				"period"=>$i
				));
}

$begin = new DateTime($startat);
$end   = new DateTime($endat);
$interval = DateInterval::createFromDateString($duration);
$times    = new DatePeriod($begin, $interval, $end);

$ip = 1;
foreach ($times as $time) {
if($ip == 3){
break;
}
$pstart =  $time->format('H:i');
$pend = $time->add($interval)->format('H:i');
$addtime = $pdo->prepare("UPDATE schedule SET pstart = :pstart, pend = :pend WHERE period = :period");
$addtime->execute(array(
				"pstart"=>$pstart,
				"pend"=>$pend,
				"period"=>$ip
				));
$ip++;
}

// Till Period 2

$p2 = 2;
$ip1 = 2;
$brunch = "10 min";
$getitime = $pdo->prepare("SELECT * FROM schedule WHERE period = :period");
$getitime->execute(array("period"=>$p2));
$git = $getitime->fetch();
$startat1 = $git['pend'];

$begin1 = new DateTime($startat1);
$end1   = new DateTime($endat);
$interval1 = DateInterval::createFromDateString($brunch);
$times1    = new DatePeriod($begin1, $interval1, $end1);

foreach ($times1 as $time1) {
if($ip1 == 3){
break;
}
$pstart1 =  $time1->format('H:i');
$pend1 = $time1->add($interval1)->format('H:i');
$addtime1 = $pdo->prepare("UPDATE schedule SET pstart = :pstart, pend = :pend WHERE period = :period");
$addtime1->execute(array(
				"pstart"=>$pstart1,
				"pend"=>$pend1,
				"period"=>$period[$ip1]
				));
$ip1++;
}

// Till Interval

$p3 = "Break";
$ip2 = 3;
$getitime1 = $pdo->prepare("SELECT * FROM schedule WHERE period = :period");
$getitime1->execute(array("period"=>$p3));
$git1 = $getitime1->fetch();
$startat2 = $git1['pend'];

$begin2 = new DateTime($startat2);
$end2   = new DateTime($endat);
$interval2 = DateInterval::createFromDateString($duration);
$times2    = new DatePeriod($begin2, $interval2, $end2);

foreach ($times2 as $time2) {
if($ip2 == 6){
break;
}
$pstart2 =  $time2->format('H:i');
$pend2 = $time2->add($interval2)->format('H:i');
$addtime2 = $pdo->prepare("UPDATE schedule SET pstart = :pstart, pend = :pend WHERE period = :period");
$addtime2->execute(array(
				"pstart"=>$pstart2,
				"pend"=>$pend2,
				"period"=>$period[$ip2]
				));
$ip2++;
}

// Till Period 5


$p4 = 5;
$ip3 = 6;
$lunch = "40 min";
$getitime2 = $pdo->prepare("SELECT * FROM schedule WHERE period = :period");
$getitime2->execute(array("period"=>$p4));
$git2 = $getitime2->fetch();
$startat3 = $git2['pend'];

$begin3 = new DateTime($startat3);
$end3   = new DateTime($endat);
$interval3 = DateInterval::createFromDateString($lunch);
$times3    = new DatePeriod($begin3, $interval3, $end3);

foreach ($times3 as $time3) {
if($ip3 == 7){
break;
}
$pstart3 =  $time3->format('H:i');
$pend3 = $time3->add($interval3)->format('H:i');
$addtime3 = $pdo->prepare("UPDATE schedule SET pstart = :pstart, pend = :pend WHERE period = :period");
$addtime3->execute(array(
				"pstart"=>$pstart3,
				"pend"=>$pend3,
				"period"=>$period[$ip3]
				));
$ip3++;
}

// Till Lunch

$p5 = "Lunch";
$ip4 = 7;
$getitime3 = $pdo->prepare("SELECT * FROM schedule WHERE period = :period");
$getitime3->execute(array("period"=>$p5));
$git3 = $getitime3->fetch();
$startat4 = $git3['pend'];

$begin4 = new DateTime($startat4);
$end4   = new DateTime($endat);
$interval4 = DateInterval::createFromDateString($duration);
$times4    = new DatePeriod($begin4, $interval4, $end4);

foreach ($times4 as $time4) {
if($ip4 == 10){
break;
}
$pstart4 =  $time4->format('H:i');
$pend4 = $time4->add($interval4)->format('H:i');
$addtime4 = $pdo->prepare("UPDATE schedule SET pstart = :pstart, pend = :pend WHERE period = :period");
$addtime4->execute(array(
				"pstart"=>$pstart4,
				"pend"=>$pend4,
				"period"=>$period[$ip4]
				));
$ip4++;
}

// Till Period 8
if($addtime && $addtime1 && $addtime2 && $addtime3 && $addtime4){
echo "<div class='alert alert-info'>Intervals has been set successfully</div>";
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
echo "<a class='btn btn-default pull-right' href='main.php'>Control Panel</a>";
}
else{
echo "<div class='alert alert-info'>Error setting intervals. Try Later.</div>";
echo "<a class='btn btn-default pull-right' href='main.php'>Control Panel</a>";
}
}

?>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
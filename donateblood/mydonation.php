<?php
ob_start();
session_start();
if(!isset($_SESSION['donor'])){
header('Location:donorpanel.php');
exit();
}
include('includes/connect.php');
$duname = $_SESSION['donor'];
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Blood Donation Management Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12">
<?php
include('includes/donorheader.php');
$getdd = $pdo->prepare("SELECT * FROM donors WHERE duname=:duname");
$getdd->execute(array("duname"=>$duname));
while($gdd = $getdd->fetch())
{
$donorn = $gdd['dname'];
?>
<h2>Welcome, <?php echo $donorn; ?></h2>
<?php
}
?>
<table class="table table-striped">
<tr><th>Donation Date</th><th>Donation Venue</th><th>Registered On</th><th>Status</th></tr>
<?php
$getdl = $pdo->prepare("SELECT * FROM donation WHERE donorun=:duname");
$getdl->execute(array("duname"=>$duname));
if($getdl->rowCount() == 0){
echo "<tr><td colspan='4'>No records of blood donation found</td></tr>";
}
while($gdl = $getdl->fetch()){
$ddate = $gdl['donatedate'];
$dvenue = $gdl['venueid'];
$dreg = $gdl['dlog'];
$dstat = $gdl['verify'];
$getven = $pdo->prepare("SELECT * FROM venues WHERE vid=:vid");
$getven->execute(array("vid"=>$dvenue));
while($gv = $getven->fetch()){
$vad = $gv['vaddr'];
$vc = $gv['vcity'];
$vs = $gv['vstate'];
$vpin = $gv['vpin'];
$vcon = $gv['vcon'];
?>
<tr><td><?php echo $ddate; ?></td><td><?php echo $vad . ", " . $vc . ", " . $vs . ", " . $vpin . ", " . $vcon; ?></td><td><?php echo $dreg; ?></td><td><?php echo $dstat; ?></td></tr>
<?php
}
}
?>
</table>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
ob_start();
session_start();
include('includes/connect.php');
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
include("includes/header.php"); 
?>
<h2>Registered Donors</h2>
<table class="table table-striped">
<tr><th>Donor Name</th><th>Gender</th><th>Blood Type</th><th>Email</th><th>Contact</th></tr>
<?php
$listdonors = $pdo->prepare("SELECT * FROM donors");
$listdonors->execute();
while($donor = $listdonors->fetch()){
$dname = $donor['dname'];
$dgen = $donor['dgender'];
$dblood = $donor['btype'];
$dmail = $donor['demail'];
$dphone = $donor['dphone'];
echo "<tr><td>" . $dname . "</td><td>" . $dgen . "</td><td>" . $dblood . "</td><td>". $dmail . "</td><td>" . $dphone . "</td></tr>";
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
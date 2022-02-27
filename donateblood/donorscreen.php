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
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
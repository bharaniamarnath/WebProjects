<?php
ob_start();
session_start();
include('includes/connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Blood Donation Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row content">
<div class="col-md-12 col-lg-12">
<header>
<h1>Blood Donation Application</h1>
</header>
</div>
</div>
<div class="row content">
<div class="col-md-6 col-lg-6">
<h2>Donor</h2>
<?php
if(isset($_SESSION['donor'])){
	unset($_SESSION['donor']);
	session_destroy();
	echo "<div class='alert alert-info'>Donor logged out successfully.</div><a class='btn btn-primary btn-lg' href='index.php'>Login Panel</a>";
}
?>
</div>
</div>

</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
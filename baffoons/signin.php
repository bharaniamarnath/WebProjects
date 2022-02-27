<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php
session_start();
include('includes/inhead.php');
include('includes/class.signin.php');
include('includes/alerts.php');
if(isset($_POST['login'])){
if(empty($_POST['uname']) && empty($_POST['pswd'])){
	echo $logemptyalert;
	exit();
}
$signin = new signin();
$signin->setUserName($_POST['uname']);
$signin->setUserPassword(md5($_POST['pswd']));
$signin->UserSignIn();
}
?>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
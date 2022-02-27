<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="bluedent india, bluedent chennai, rediscover dentistry" />
<meta name="description" content="Welcome to Bluedent India. Rediscover Dentistry.">
<meta name="copyright" content="&copy; Copyright 2014. Bluedent India. All rights reserved.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<header>
<img class="img-responsive" src="<?php echo $CP_URL; ?>logos/Bluedent.png" />
</header>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Bluedent Administrator</h2>
<hr>
<?php
if(isset($_SESSION['admin'])){
	unset($_SESSION['admin']);
	session_destroy();
	echo "<div class='alert alert-success'>Administrator logged out successfully.</div><a class='btn btn-success btn-block' href='".$CP_URL."index.php'>Admin Panel</a>";
}
?>
</div>
</div>
<hr>
<footer>
<a href="<?php echo $CP_URL; ?>index.php">Home</a>  
<br />
<p>&copy; Copyrights 2014 - <?php echo date('Y'); ?>. Bluedent India. All rights reserved.</p>
</footer>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

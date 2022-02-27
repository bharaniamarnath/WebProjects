<?php
ob_start();
session_start();
include('includes/config.php');
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
<div class="row">
<div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<h4 class="table-heading">Login panel</h4>
<form id="adminLoginForm" action="<?php echo $CP_URL; ?>clogin.php" method="POST">
<div class="form-group"><label for="username">Username</label><input class="form-control" type="text" name="username" id="username" placeholder="Enter Username" /></div>
<div class="form-group"><label for="password">Password</label><input class="form-control" type="password" name="passwd" id="passwd" placeholder="Enter Password" /></div>
<button class="btn btn-success btn-lg btn-block" type="submit" name="login" id="login" />Log In</button>
</form>
</div>
</div>
</div>
</div>
<hr>
<footer>
<a href="<?php echo $CP_URL; ?>index.php">Login</a>  
<br />
<p>&copy; Copyrights 2014 - <?php echo date('Y'); ?>. Bluedent India. All rights reserved.</p>
</footer>
</div>

<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/validateAdminLogin.js"></script>
</body>
</html>
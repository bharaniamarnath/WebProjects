<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<div class="row header-block navbar-fixed-top">
<div class="col-md-2 col-lg-2"> 
<a href="index.php"><img class="img-responsive header-logo" src="images/logo/lumibella.png" /></a>
</div>
<div class="col-md-8 col-lg-8 nav-holder">
<!--navbar-->
<div class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="navbar-collapse collapse navbar-right">
<ul class="nav navbar-nav">
<li><a href="../index.php">Visit Website</a></li>
</ul>

</div> 
</div>


</div>
</div>

<div class="row content">
<h4 class="heading">Lumibella Control Panel</h4>
<hr>
<div class="col-md-6 col-lg-6 col-md-offet-3 col-lg-offset-3">
<h4 class="checkout-heading">Login Panel</h4>
<form action="clogin.php" method="POST">
<div class="form-group"><label for="username">Username</label><input class="form-control" type="text" name="username" placeholder="Enter Username" /></div>
<div class="form-group"><label for="password">Password</label><input class="form-control" type="password" name="password" placeholder="Enter Password" /><div>
<div class="form-group"><button class="btn btn-primary btn-lg pull-right" type="submit" name="login" />Log In</button></div>
</form>
</div>
</div>
</div>
</div>

<div class="row footer">

<div class="row">
<div class="social-link col-md-2 col-lg-2 col-md-offset-5 col-lg-offset-5">
<p>Follow Us On</p>
<a href="https://www.facebook.com/" target="_blank"><img src="images/logo/facebook.png" /></a>
<a href="https://www.twitter.com/" target="_blank"><img src="images/logo/twitter.png" /></a>
<a href="https://plus.google.com/" target="_blank"><img src="images/logo/gplus.png" /></a>
</div>
</div>

<div class="row">
<div class="col-md-12 col-lg-12 copyrights">
<p>&copy; 2015 Lumibella - All Rights Reserved</p>
</div>
</div>

</div>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
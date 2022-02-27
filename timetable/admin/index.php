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
<div class="col-md-8 col-md-offset-2">
<ul class="nav nav-pills">
<li><a href="../index.php">Go to Main Index</a></li>
<li><a href="../register.php">Register Admin</a></li>
</ul>
<h3>Admin Login Panel</h3>
<form action="login.php" method="POST">
<div class="form-group">
<label for="username">Username: </label><input class="form-control" type="text" name="username" id="username" placeholder="Enter Username" />
</div>
<div class="form-group">
<label for="password">Password: </label><input class="form-control" type="password" name="password" id="password" placeholder="Enter Password" />
</div>
<input class="btn btn-default btn-lg pull-right" type="submit" name="login" id="login" value="Login" />
</form>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
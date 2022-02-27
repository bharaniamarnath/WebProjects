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
<li><a href="index.php">Go to Main Index</a></li>
</ul>
<h3>Administrator Registration</h3>
<?php
include("includes/connect.php");
if(isset($_POST['register'])){
$chk = $pdo->prepare("SELECT * FROM admin");
$chk->execute();
if($chk->rowCount() == 0){
$id = rand(000000,999999);
$username = $_POST['username'];
$password = md5($_POST['password']);
$register = $pdo->prepare("INSERT INTO admin (Id, Username, Password) VALUES (:id, :username, :password)");
$register->execute(array(
				"id"=>$id,
				"username"=>$username,
				"password"=>$password
				));
if($register){
echo "<div class='alert alert-info'>Administrator as username: " . $username . " has been registered</div>";
}
else{
echo "<div class='alert alert-info'>Administrator registration failed</div>";
}
}
else{
echo "<div class='alert alert-info'>Process denied. Administrator has already been registered.</div>";
}
}
?>

<form action="register.php" method="POST">
<div class="form-group">
<label for="username">Username:</label><input class="form-control" type="text" name="username" />
</div>
<div class="form-group">
<label class="password">Password:</label><input class="form-control" type="password" name="password" />
</div>
<input class="btn btn-default btn-lg pull-right" type="submit" name="register" value="Register" />
</form>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
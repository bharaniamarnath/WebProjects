<?php
ob_start();
session_start();
include('includes/connect.php');
?>
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
<h3>Staff Login Panel</h3>
<?php
if(isset($_POST['login'])){
$usrname = $_POST['username'];
$passwd = md5($_POST['password']);
if(empty($usrname) && empty($passwd)){
echo "<p>Login failed. Check username and password.</p>";
echo "<a href='index.php'>Login Panel</a>";
}
else{
$result = $pdo->prepare("SELECT * FROM users WHERE Username=:username AND Password=:password");
$result->execute(array(
				"username"=>$usrname,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['Username'] == $usrname && $row['Password'] == $passwd){
$_SESSION['staff'] = $usrname;
header('Location: main.php');
exit();
}
else{
echo "<div class='alert alert-info'>Login failed. Invalid username and password match.</div>";
echo "<a class='btn btn-default pull-right' href='panel.php'>Login Panel</a>";
}
}
}
?>
</div>
</div>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
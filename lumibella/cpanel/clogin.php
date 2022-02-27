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
<div class="col-md-10 col-lg-10">
</div>
</div>
<div class="row content">
<h4 class="heading">Lumibella Control Panel</h4>
<div class="col-md-12">
<?php
if(isset($_POST['login'])){
$usrname = $_POST['username'];
$passwd = md5($_POST['password']);
if(empty($usrname) && empty($passwd)){
echo "<div class='alert alert-info'>Login failed. Check username and password.</div>";
echo "<a class='btn btn-primary' href='index.php'>Login Panel</a>";
}
else{
$result = $pdo->prepare("SELECT * FROM admins WHERE username=:username AND password=:password");
$result->execute(array(
				"username"=>$usrname,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['username'] == $usrname && $row['password'] == $passwd){
$_SESSION['admin'] = $usrname;
header('Location: dashboard.php');
exit();
}
else{
echo "<div class='alert alert-info'>Login failed. Invalid username and password match.</div><a class='btn btn-primary' href='index.php'>Login Panel</a>";
}
}
}
?>
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
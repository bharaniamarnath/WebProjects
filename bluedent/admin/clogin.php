<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
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
if(isset($_POST['login'])){
$usrname = $_POST['username'];
$passwd = md5($_POST['passwd']);
if(empty($usrname) && empty($passwd)){
echo "<div class='alert alert-danger'>Login failed. Check username and password.</div>";
echo "<a class='btn btn-danger btn-block' href='".$CP_URL."index.php'>Admin Panel</a>";
}
else{
$result = $pdo->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
$result->execute(array(
				"username"=>$usrname,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['username'] == $usrname && $row['password'] == $passwd){
$lastlog = $pdo->prepare("SELECT nowlog FROM admin WHERE username=:username");
$lastlog->execute(array("username"=>$usrname));
while($trow = $lastlog->fetch()){
$ltime = $trow['nowlog'];
$setlastlog = $pdo->prepare("UPDATE admin SET lastlog=:lastlog WHERE username=:username");
$setlastlog->execute(array(
					"lastlog"=>$ltime,
					"username"=>$usrname
					));
$setnowlog = $pdo->prepare("UPDATE admin SET nowlog=now() WHERE username=:username");
$setnowlog->execute(array(
					"username"=>$usrname
					));

}
if($result && $lastlog && $setlastlog && $setnowlog){
$_SESSION['admin'] = $usrname;
header('Location: dashboard.php');
exit();
}
}
else{
echo "<div class='alert alert-danger'>Login failed. Check username and password.</div>";
echo "<a class='btn btn-danger btn-block' href='".$CP_URL."index.php'>Login Panel</a>";
}
}
}
?>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>
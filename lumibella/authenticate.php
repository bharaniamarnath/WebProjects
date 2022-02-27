<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">My Account</h4>
<hr>
<div class="col-md-12 col-lg-12">
<?php
if(isset($_REQUEST['login'])){
$email = trim($_REQUEST['lemail']);
$passwd = trim(md5($_REQUEST['lpassword']));
$status = 1;
if(empty($email) && empty($passwd)){
echo "<div class='invalid-log'><h2>Login failed. Check username and password.</h2><a class='btn btn-primary btn-lg' href='customer.php'>Customer Panel</a></div>";
}
else{
$result = $pdo->prepare("SELECT * FROM customers WHERE cemail=:email AND cpassword=:password");
$result->execute(array(
				"email"=>$email,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['cemail'] == $email && $row['cpassword'] == $passwd){
$getid = $pdo->prepare("SELECT * FROM customers WHERE cemail=:email");
$getid->execute(array("email"=>$email));
$gid = $getid->fetch();
$customer = $gid['cid'];
$setstatus = $pdo->prepare("UPDATE customers SET status=:status WHERE cid=:id");
$setstatus->execute(array(
					"status"=>$status,
					"id"=>$customer
					));
$_SESSION['customer'] = $customer;
header('Location: ' . $_REQUEST['redirect']);
exit();
}
else{
echo "<div class='log-alert'><h2><span class='glyphicon glyphicon-exclamation-sign'></span> Login failed. Check username and password.</h2><br /><center><a class='btn btn-primary btn-lg' href='customer.php?location=".urlencode('account.php')."'>Customer Panel</a></center></div>";
}
}
}
?>
</div>
</div>
<?php include "footer.php"; ?>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
</body>
</html>
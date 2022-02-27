<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['customer'])){
$redirect = 'account.php';
header("Location: customer.php?location=".urlencode($redirect));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">Lumibella Customer</h4>
<hr>
<div class="col-md-12 col-lg-12">
<?php
if(isset($_SESSION['customer'])){
$email = $_SESSION['customer'];
$status = 0;
$setstatus = $pdo->prepare("UPDATE customers SET status=:status WHERE cemail=:email");
$setstatus->execute(array(
					"status"=>$status,
					"email"=>$email
					));
$_SESSION = array();
if(ini_get("session.use_cookies")){
	$params = session_get_cookie_params();
	setcookie(session_name(),'',time()-42000,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
}
unset($_SESSION['customer']);
echo "<div class='log-alert'><img class='img-responsive' src='images/logo/logo-purple.png' /><h2><span class='glyphicon glyphicon-ok'></span> You have been logged out successfully. Thank you for visiting our stores.</h2></div>";
}
else{
header("Location: customer.php?location=".urlencode($redirect));
}
?>
</div>
</div>
<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
</body>
</html>
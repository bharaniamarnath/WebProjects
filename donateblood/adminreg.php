<?php
include('includes/connect.php');
if(isset($_POST['register'])){
$aid = rand(000000,999999);
$auname = $_POST['auname'];
$apass = md5($_POST['apass']);
$areg = $pdo->prepare("INSERT INTO admin (aid, auname, apasswd) VALUES (:aid, :auname,:apass)");
$areg->execute(array(
				"aid"=>$aid,
				"auname"=>$auname,
				"apass"=>$apass
				));
if($areg){
	echo "Admin registered successfully";
}
else{
	echo "Admin registration failed";
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form action="adminreg.php" method="POST">
New Username: <input type="text" name="auname" />
New Password: <input type="password" name="apass" />
<input type="submit" name="register" value="Register" />
</form>
</body>
</html>
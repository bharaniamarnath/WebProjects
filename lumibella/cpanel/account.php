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
<?php include "header.php"; ?>


<div class="row content">
<h4 class="heading">Update Account</h4><hr>
<?php
include("connect.php");
if(isset($_POST['register'])){
if(empty($_POST['username']) || empty($_POST['cpassword']) || empty($_POST['npassword']) || empty($_POST['rtpassword'])){
echo "<div class='alert alert-info'>All fields are required</div>";
}
else{
$chkpass = $pdo->prepare("SELECT * FROM admins WHERE username=:usrnme");
$chkpass->execute(array("usrnme"=>$_POST['username']));
while($cpass = $chkpass->fetch()){
$upass = $cpass['password'];
if($upass != md5($_POST['cpassword'])){
echo "<div class='alert alert-info'>Invalid or wrong password</div>";
}
}
}
if(strlen($_POST['npassword']) < 8){
echo "<div class='alert alert-info'>Password must not be less than 8 characters</div>";
}
elseif($_POST['npassword'] != $_POST['rtpassword']){
echo "<div class='alert alert-info'>New password and retype did not match. Try again</div>";
}

else{
$uid = rand(000000,999999);
$username = $_POST['username'];
$cpassword = md5($_POST['cpassword']);
$npassword = md5($_POST['npassword']);
$register = $pdo->prepare("UPDATE admins SET id=:uid, password=:password WHERE username=:username");
$register->execute(array(
				"uid"=>$uid,
				"username"=>$username,
				"password"=>$npassword
				));
if($register){
echo "<div class='alert alert-info'>Admin registered or updated</div>";
}
else{
echo "<div class='alert alert-info'>Failed registration or update</div>";
}
}
}
?>
<div class="col-md-6 col-lg-6 careers">
<form action="register.php" method="POST">
<div class="form-group"><label for="">Username</label>
<input type="text" name="username" class="form-control" placeholder="Enter Username"/>
</div>
<div class="form-group"><label for="">Current Password</label>
<input type="password" name="cpassword" class="form-control" placeholder="Enter Current Password"/>
</div>
<div class="form-group"><label for="">New Password</label>
<input type="password" name="npassword" class="form-control" placeholder="Enter New Password"/>
</div>
<div class="form-group"><label for="">Retype New Password: </label>
<input type="password" name="rtpassword" class="form-control" placeholder="Retype New Password"/>
</div>
<input class="btn btn-primary pull-right" type="submit" name="register" value="Update" />
</form>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
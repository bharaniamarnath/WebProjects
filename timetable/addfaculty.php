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
<h3>Faculty Registration</h3>
<?php
include("includes/connect.php");
if(isset($_POST['register'])){
if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['dept']) || empty($_POST['username']) || empty($_POST['password'])){
echo "<div class='alert alert-info'>All fields are mandatory for registration.</div>";
echo "<a class='btn btn-default pull-right' href='addfaculty.php'>Back to Registration</a>";
exit();
}
if(!preg_match("#^[-A-Za-z' ]*$#", $_POST['fname']) || !preg_match("#^[-A-Za-z' ]*$#", $_POST['lname'])){
echo "<div class='alert alert-info'>Enter a valid name. Name cannot contain numbers or special characters.</div>";
echo "<a class='btn btn-default pull-right' href='addfaculty.php'>Back to Registration</a>";
exit();
}
$user = $pdo->prepare("SELECT * FROM users WHERE Username = :Username");
$user->execute(array(
			'Username'=>$_POST['username']
			));
if($user->rowCount()==1){
echo "<div class='alert alert-info'>Username already exists. Try different username.</div>";
echo "<a class='btn btn-default pull-right' href='addfaculty.php'>Back to Registration</a>";
exit();
}
else{
$id = rand(000000,999999);
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$dept = $_POST['dept'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$register = $pdo->prepare("INSERT INTO users (Id, Username, Password) VALUES (:id, :username, :password)");
$register->execute(array(
				"id"=>$id,
				"username"=>$username,
				"password"=>$password
				));
$profile = $pdo->prepare("INSERT INTO staffs (sid, fname, lname, gender, dept) VALUES (:sid, :fname, :lname, :gender, :dept)");
$profile->execute(array(
				"sid"=>$id,
				"fname"=>$fname,
				"lname"=>$lname,
				"gender"=>$gender,
				"dept"=>$dept
				));
if($register && $profile){
echo "<div class='alert alert-info'>Faculty as username: " . $username . " has been registered.</div>";
echo "<a class='btn btn-default pull-right' href='index.php'>Go to Main Index</a>";
exit();
}
else{
echo "<div class='alert alert-info'>Faculty registration failed. Try later</div>";
echo "<a class='btn btn-default pull-right' href='addfaculty.php'>Back to Registration</a>";
exit();
}
}
}
?>
<form action="addfaculty.php" method="POST">
<div class="form-group">
<label for="fname">First Name:</label><input class="form-control" type="text" name="fname" />
</div>
<div class="form-group">
<label for="lname">Last Name:</label><input class="form-control" type="text" name="lname" />
</div>
<div class="form-group"><label for="gender">Gender:</label>
<div class="radio">
<label>
<input type="radio" name="gender" value="Male" checked="checked">Male
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="gender" value="Female">Female
</label>
</div>
<div class="form-group"><label for="label">Department:</label> 
<select class="form-control" name="dept">
<?php
$deptsn = array("CSE","IT","ECE","EEE","Mech","Civil","MBA","MCA");
$deptfn = array("Computer Science Engineering","Information Technology","Electronics and Communication Engineering","Electrical and Electronics Engineering","Mechanical Engineering","Civil Engineering","Master of Business Management","Master of Computer Applications");
for($i = 0; $i < count($deptsn); $i++){
echo "<option value=". $deptsn[$i] .">" . $deptfn[$i] . "</option>";
}
?>
</select>
</div>
<div class="form-group">
<label>Username:</label><input class="form-control" type="text" name="username" />
</div>
<div class="form-group">
<label for="password">Password:</label><input class="form-control" type="password" name="password" />
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
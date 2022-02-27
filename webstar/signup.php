<?php
include('includes/inhead.php');
include('includes/class.signup.php');
include('includes/alerts.php');
if(isset($_POST['register'])){
if(empty($_POST['firstname'])&&empty($_POST['lastname'])&&empty($_POST['gender'])&&empty($_POST['date'])&&empty($_POST['month'])&&empty($_POST['year'])&&empty($_POST['username'])&&empty($_POST['password'])&&empty($_POST['confpass'])&&empty($_POST['mailid'])){
	echo $fieldalert;
	exit();
}
if(empty($_POST['firstname'])){
	echo $fnamealert;
	exit();
}
else if(!preg_match("#^[-A-Za-z' ]*$#", $_POST['firstname'])){
	 echo $invalidfname;
	 exit();
	 }
if(empty($_POST['lastname'])){
	echo $lnamealert;
	exit();
}
else if(!preg_match("#^[-A-Za-z' ]*$#", $_POST['lastname'])){
	 echo $invalidlname;
	 exit();
	 }
if(empty($_POST['gender'])){
	echo $genderalert;
	exit();
}
if(empty($_POST['date'])){
	echo $dobdalert;
	exit();
}
if(empty($_POST['month'])){
	echo $dobmalert;
	exit();
}
if(empty($_POST['gender'])){
	echo $dobyalert;
	exit();
}
if(empty($_POST['username'])){
	echo $unamealert;
	exit();
}
if(strlen($_POST['username']) > 15){
	echo $unamecountalert;
	exit();
}
else{
include "includes/connect.php";
$user = $pdo->prepare("SELECT * FROM userdetails WHERE Username = :Username");
$user->execute(array(
			'Username'=>$_POST['username']
			));
if($user->rowCount()==1){
	echo $unameexistalert;
	exit();
}
}
if(empty($_POST['password'])){
	echo $passalert;
	exit();
}
if(strlen($_POST['password']) > 15){
	echo $passcountalert;
	exit();
}
elseif($_POST['password']!==$_POST['confpass']){
	echo $passconfalert;
	exit();
}
if(empty($_POST['mailid'])){
	echo $mailidalert;
	exit();
}
elseif(!filter_var($_POST['mailid'], FILTER_VALIDATE_EMAIL)){
	echo $invalidemail;
	exit();
}
else{
include "includes/connect.php";
$mail = $pdo->prepare("SELECT * FROM userdetails WHERE Email = :Email");
$mail->execute(array(
			'Email'=>$_POST['mailid']
			));
if($mail->rowCount()==1){
	echo $emlexistalert;
	exit();
}
if(empty($_POST['terms'])){
	echo $termsalert;
	exit();
}
}
$signup = new signup();
$signup->setUserId(rand(000000,999999));
$signup->setFirstName($_POST['firstname']);
$signup->setLastName($_POST['lastname']);
$signup->setGender($_POST['gender']);
$dt = $_POST['date'];
$mnth = $_POST['month'];
$yr = $_POST['year'];
$signup->setDob($yr . $mnth . $dt);
$signup->setUserName($_POST['username']);
$signup->setPassword(md5($_POST['password']));
$signup->setEmail($_POST['mailid']);
$signup->SignUpUser();
}
?>
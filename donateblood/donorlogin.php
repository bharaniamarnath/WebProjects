<?php
ob_start();
session_start();
include('includes/connect.php');
?>

<?php
if(isset($_POST['dlogin'])){
$usrname = $_POST['dluname'];
$passwd = md5($_POST['dlpass']);
if(empty($usrname) && empty($passwd)){
echo "<div class='alert alert-info'>Login failed. Check username and password.</div>";
echo "<a class='btn btn-primary' href='index.php'>Login Panel</a>";
}
else{
$result = $pdo->prepare("SELECT * FROM donors WHERE duname=:username AND dpasswd=:password");
$result->execute(array(
				"username"=>$usrname,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['duname'] == $usrname && $row['dpasswd'] == $passwd){
$_SESSION['donor'] = $usrname;
header('Location: donorscreen.php');
exit();
}
else{
echo "<div class='alert alert-info'>Login failed. Invalid username and password match.</div><a class='btn btn-primary' href='index.php'>Login Panel</a>";
}
}
}
?>
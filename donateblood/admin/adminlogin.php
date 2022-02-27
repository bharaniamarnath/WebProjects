<?php
ob_start();
session_start();
include('includes/connect.php');
?>

<?php
if(isset($_POST['alogin'])){
$usrname = $_POST['aluname'];
$passwd = md5($_POST['alpass']);
if(empty($usrname) && empty($passwd)){
echo "<div class='alert alert-info'>Login failed. Check username and password.</div>";
echo "<a class='btn btn-primary' href='index.php'>Login Panel</a>";
}
else{
$result = $pdo->prepare("SELECT * FROM admin WHERE auname=:username AND apasswd=:password");
$result->execute(array(
				"username"=>$usrname,
				"password"=>$passwd
				));
$row = $result->fetch();
if($row['auname'] == $usrname && $row['apasswd'] == $passwd){
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
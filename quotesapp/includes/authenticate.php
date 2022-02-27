<?php
require_once 'config.php';
require_once 'Database.php';
if(isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){
	$user = trim($_POST['username']);
	$pswd = trim($_POST['password']);
	try{
		$pdo = new Database();
		$conn = $pdo->connect();
		$stmt = $conn->prepare("SELECT * FROM admin WHERE qadmin=:username AND qpswd=:password");
		$stmt->execute(array(
					"username"=>$user,
					"password"=>md5($pswd)
					));
		if($stmt->rowCount() == 1){
			session_start();
			$_SESSION['qadmin'] = $user;
			$redir = $BASE_URL . "main.php";
			header('Location:'.$redir);
		}
		else{
			$redir = $BASE_URL . "index.php?err=1";
			header('Location:'.$redir);
		}
	}catch(PDOException $e){
		die($e->getMessage());
	}
}
else{
	$redir = $BASE_URL . "index.php?err=2";
	header('Location:'.$redir);
}
?>
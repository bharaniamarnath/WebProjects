<?php
require_once 'config.php';
require_once 'Database.php';
if(isset($_POST['quote']) && isset($_POST['author']) && !empty($_POST['quote']) && !empty($_POST['author'])){
	$quot = trim($_POST['quote']);
	$auth = trim($_POST['author']);
	try{
		$pdo = new Database();
		$conn = $pdo->connect();
		$stmt = $conn->prepare("INSERT INTO quotes (quote,author) VALUES (:quote,:author)");
		$stmt->execute(array(
					"quote"=>$quot,
					"author"=>$auth
					));
		if($stmt->rowCount() == 1){
			$redir = $BASE_URL . "main.php?status=1";
			header('Location:'.$redir);
		}
		else{
			$redir = $BASE_URL . "main.php?status=0";
			header('Location:'.$redir);
		}
	}catch(PDOException $e){
		die($e->getMessage());
	}
}
else{
	$redir = $BASE_URL . "main.php?err=1";
	header('Location:'.$redir);
}
?>
<?php
if(isset($_GET['id'])){
$data = array();
$c = 0;
require_once 'includes/Database.php';
try{
	$pdo = new Database();
	$conn = $pdo->connect();
	$stmt = $conn->prepare("SELECT id,quote,author FROM quotes ORDER BY RAND() LIMIT 1");
	$stmt->execute();
	while($row = $stmt->fetch()){
		$data[$c]["id"] = stripslashes($row["id"]);
		$data[$c]["quote"] = stripslashes($row["quote"]);
		$data[$c]["author"] = stripslashes($row["author"]);
		$c++;
	}
	header("Content-Type:Application/json");
	echo json_encode($data);
}catch(PDOException $e){
	die('Error: '.$e->getMessage());
}
}
?>
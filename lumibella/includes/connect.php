<?php
try{
	$pdo = new PDO("mysql:host=localhost;dbname=lumibella","root","");
}catch(Exception $e){
	die("Error: " . $e->getMessage());
}
?>
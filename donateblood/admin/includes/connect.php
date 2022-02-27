<?php
try{
	$pdo = new PDO("mysql:host=localhost;dbname=donateblood","root","");
}catch(Exception $e){
	die("Error: " . $e->getMessage());
}
?>
<?php
try{
	$pdo = new PDO("mysql:host=localhost;dbname=baffoons","root","");
}catch(Exception $e){
	die("Error: " . $e->getMessage());
}
?>
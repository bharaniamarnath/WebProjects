<?php
try{
	$pdo = new PDO("mysql:host=bluedentindia.in;dbname=bluedent","bdiroot","b1u3d3ntindi@");
}catch(Exception $e){
	die("Error: " . $e->getMessage());
}
?>

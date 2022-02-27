<?php
try{
	$pdo = new PDO("mysql:host=localhost;dbname=timetable","root","");
}catch(Exception $e){
	die("Error: " . $e->getMessage());
}
?>
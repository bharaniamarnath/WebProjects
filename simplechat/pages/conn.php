<?php
		try{
			$bdd = new PDO("mysql:host=localhost;dbname=mychat","root","");
		}
		catch(Exception $e){
			die("ERROR: ".$e->getMessage());
		}
?>
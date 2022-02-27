<?php
session_start();
include('connect.php');
$stockpid = $_REQUEST['stockpid'];
$stockamt = $_REQUEST['stockamt'];
$updatestock = $pdo->prepare("UPDATE stocks SET quantity=quantity+:atockamt, updated=now() WHERE pid=:stockpid");
$updatestock->execute(array(
					"atockamt"=>$stockamt,
					"stockpid"=>$stockpid
					));
echo "<div id='stockupdated'><span class='glyphicon glyphicon-ok'></span> Stock Updated. Refresh page for changes.</div>";
?>
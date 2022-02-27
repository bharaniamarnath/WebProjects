<?php
session_start();
include('connect.php');
if(!isset($_SESSION['customer'])){
	header("Location: customer.php");
}
$cid = $_SESSION['customer'];
$rpoint = $_POST['prate'];
$rproid = $_POST['prid'];
$rptotal = $_POST['prtot'];
$rpcount = $_POST['prcnt'];
$addprt = $rptotal + $rpoint;
$addprc = $rpcount + 1;
$addrate = $pdo->prepare("UPDATE ratings SET rtotal=:rtotal, rcount=:rcount WHERE pid=:pid");
$addrate->execute(array(
				"rtotal"=>$addprt,
				"rcount"=>$addprc,
				"pid"=>$rproid
				));
$addurate = $pdo->prepare("INSERT INTO rateduser (cid,pid,rateval) VALUES (:cid,:pid,:rateval)");
$addurate->execute(array(
				"cid"=>$cid,
				"pid"=>$rproid,
				"rateval"=>$rpoint
				));
if($addrate && $addurate){
echo "<div></div>";
}
else{
echo "<div></div>";
}
?>

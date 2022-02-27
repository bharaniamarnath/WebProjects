<?php
include "connect.php";
$result = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
$result->execute(array('UserID'=>$suid));
while($row = $result->fetch())
{
$userid = $row['UserID'];
$usrnme = $row['Username'];
$fname = $row['Firstname'];
$lname = $row['Lastname'];
$gend = $row['Gender'];
$mail = $row['Email'];
$dob = $row['Dob'];
$age = floor( (strtotime(date('Y-m-d')) - strtotime($dob)) / 31556926);
}
$imgresult = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
$imgresult->execute(array('UserID'=>$suid));
while($row = $imgresult->fetch()){
$imgloc = $row['Image'];
$thumbloc = $row['Thumb'];
}
?>
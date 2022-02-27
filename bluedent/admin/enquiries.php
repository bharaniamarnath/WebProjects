<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/validateDeleteEnquiry.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
// Delete Enquiry
$deleteEnquiryStatus = '';
if(isset($_REQUEST['denq'])){
$feedid = trim($_REQUEST['denq']);
$validateDeleteEnquiry = new validateDeleteEnquiry();
$deleteEnquiry = $validateDeleteEnquiry->deleteEnquiry($feedid);
if($deleteEnquiry == true){
$deleteEnquiryStatus = $validateDeleteEnquiry->deleteEnquirySuccess();
}
else if($deleteEnquiry == false){
$deleteEnquiryStatus = $validateDeleteEnquiry->deleteEnquiryFailed();
}
else{
$deleteEnquiryStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="bluedent india, bluedent chennai, rediscover dentistry" />
<meta name="description" content="Welcome to Bluedent India. Rediscover Dentistry.">
<meta name="copyright" content="&copy; Copyright 2014. Bluedent India. All rights reserved.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Enquiries</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php 
if($deleteEnquiryStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $deleteEnquiryStatus; ?></div>
<?php
}
?>
<?php
$vf = $pdo->prepare("SELECT * FROM enquiry ORDER BY date DESC");
$vf->execute();
if($vf->rowCount() == 0){
echo "<div class='alert alert-warning'>No enquiries available</div>";
}
else{
while($frow = $vf->fetch()){
$feid = $frow['feid'];
$name = $frow['name'];
$email = $frow['email'];
$phone = $frow['phone'];
$feed = $frow['enquiry'];
$date = $frow['date'];
echo "<div class='row enquiries'>";
echo "<div class='col-md-12 col-lg-12'>";
echo "<p><label>Enquiry ID:</label>".$feid."</p>";
echo "<p><label>Costumer Name:</label>".$name."</p>";
echo "<p><label>Costumer Email:</label>".$email."</p>";
echo "<p><label>Costumer Contact:</label>".$phone."</p>";
echo "<p><label>Enquiry Date:</label>".$date."</p>";
echo "<p><label>Enquiry:</label>".$feed."</p>";
echo "<a href='".$CP_URL."reply.php?feid=$feid&femail=$email' class='btn btn-success btn-sm pull-left'>Reply</a>";
echo "<a href='".$CP_URL."enquiries.php?denq=$feid' class='btn btn-danger btn-sm'>Delete</a>";
echo "</div>";
echo "</div>";
}
}
?>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead><tr><td>Go to admin control panel</td><td><a class="btn btn-primary btn-sm" href="<?php echo $CP_URL; ?>dashboard.php">Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

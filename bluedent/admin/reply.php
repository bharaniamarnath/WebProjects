<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/mailReplyEnquiry.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
// Declare variables
$replyEnquiryStatus = '';
// Get form data
if(isset($_REQUEST['sendReply'])){
$replyTo = trim($_REQUEST['replyTo']);
$replySubject = trim($_REQUEST['replySubject']);
$replyMessage = trim($_REQUEST['replyMessage']);
//create class and objects
$replyStatus = mailReplyEnquiry($replyTo,$replySubject,$replyMessage);
if($replyStatus == 0){
$replyEnquiryStatus = "Enquiry reply message mailed to recipient successfully";
}
else if($replyStatus == 1){
$replyEnquiryStatus = "Unable to mail enquiry reply message to recipient.";
}
else{
$replyEnquiryStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
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
<h2>Enquiry Reply</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php 
if($replyEnquiryStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $replyEnquiryStatus; ?></div>
<?php
}
?>
<h4 class="table-heading">Reply to Enquiry</h4>
<hr>
<?php
if(isset($_REQUEST['feid']) && isset($_REQUEST['femail'])){
$feedid = $_REQUEST['feid'];
$feedmail = $_REQUEST['femail'];
$getfeed = $pdo->prepare("SELECT enquiry FROM enquiry WHERE feid=:feid");
$getfeed->execute(array("feid"=>$feedid));
$fetchfeed = $getfeed->fetch();
$feed = $fetchfeed['enquiry'];
echo "<form id='replyEnquiryForm' action='".$CP_URL."reply.php' method='POST'>";
echo "<div class='form-group'><label for='enquiryid'>Enquiry ID:&nbsp;</label>$feedid</div>";
echo "<div class='form-group'><label for='enquired'>Enquired Message:&nbsp;</label>$feed</div>";
echo "<div class='form-group'><label for='replyingto'>Replying To</label><input type='text' class='form-control' name='replyTo' id='replyTo' value='$feedmail' /></div>";
echo "<div class='form-group'><label for='subject'>Subject</label><input type='text' class='form-control' name='replySubject' id='replySubject' value='BLUEDENT INDIA - Enquiry: $feedid' /></div>";
echo "<div class='form-group'><label for='replymessage'>Reply Message</label><textarea class='form-control' name='replyMessage' id='replyMessage'></textarea></div>";
echo "<input type='submit' class='btn btn-success btn-lg btn-block' name='sendReply' id='sendReply' value='Send Reply' />";
echo "</form>";
}
?>
</div>
</div>

<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href="<?php echo $CP_URL; ?>dashboard.php">Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/validateReplyEnquiry.js"></script>
</body>
</html>

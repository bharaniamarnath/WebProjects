<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/enquiryValidate.php');
include('includes/enquirySubmit.php');
if(!isset($_SESSION['order'])){
header('Location: expired.php');
exit();
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
<link rel="shortcut icon" href="<?php echo $BASE_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/jquery.atwho.css" />
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Product Enquiry</h2></div></div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<h4 class="table-heading">Please enter your contact information below:</h4>
<?php 
if($enquiryStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $enquiryStatus; ?></div>
<?php
}
?>
<form id="enquiryForm" action="<?php echo $BASE_URL; ?>enquiry.php" method="POST">
<div class="form-group"><label for="ename">Enter Name</label><input type="text" name="ename" id="ename" class="form-control" placeholder="Enter your full name" /></div>
<div class="form-group"><label for="eemail">Enter Email ID</label><input type="text" name="eemail" id="eemail" class="form-control" placeholder="Example: myemail@example.com" /></div>
<div class="form-group"><label for="ephone">Enter contact number</label><input type="text" name="ephone" id="ephone" maxlength="10" class="form-control" placeholder="Example - Mobile: 9870123456, Landline: 4422334455" /></div>
<div class="form-group"><label for="eenquiry">Products Required</label><textarea name="eenquiry" id="eenquiry" maxlength="1024" class="form-control" placeholder="Enter required products"></textarea></div>
<input class="btn btn-success btn-lg btn-block" type="submit" value="Submit" name="submit" id="submit" />
</form>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<?php
$except = 'Dental Instruments';
$except2 = 'Oral Surgery';
$products = $pdo->prepare("SELECT name FROM products WHERE category != '$except' AND category != '$except2'");
$products->execute();
$list = array();
while($data = $products->fetch()){
$list[] = $data;
}
?>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/validateEnquiry.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery.caret.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery.atwho.js"></script>
<script type="text/javascript">
var list = <?php echo json_encode($list); ?>;
$('#eenquiry').atwho({
    at: "",
    data: list
})
</script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>
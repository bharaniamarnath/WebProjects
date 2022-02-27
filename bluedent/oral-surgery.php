<?php
session_start();
include('includes/config.php');
include('connect.php');
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
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Products</h2>
<h4>Oral Surgery</h4>
</div>
</div>

<div class="row product">

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/axe-minor-major-ot.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=AXE_Minor_and_Major_OT_Instruments"><h6>AXE Minor & Major OT Instruments</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/cleft-general-kit.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Cleft_and_General_Kit"><h6>Cleft and General Kit</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/distraction-osteogenesis.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Distraction_Osteogenesis_and_Trauma_Kit"><h6>Distraction Osteogenesis and Trauma kit</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/impaction-kit.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Impaction_kit"><h6>Impaction kit</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/micro-surgery-kit.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Micro_Surgery_kit_OS"><h6>Micro Surgery kit </h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/osteotomy-kit.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Osteotomy_and_Tracheotomy_Kits"><h6>Osteotomy & Tracheotomy kits</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Oral-Surgery/plate-and-screw-kits.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>oral-surgery-list.php?product=Plate_and_Screws_Kit"><h6>Plate and Screws Kit</h6></a></div>
</div></div>

</div>

<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>

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
<h4>Dental Instruments</h4>
</div>
</div>

<div class="row product">

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/daignostics.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Diagnostics"><h6>Diagnostics</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/conservative.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Conservative_Treatment"><h6>Conservative Treatment</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/periodontology.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Periodontology"><h6>Periodontology</h6></a></div></div>
</div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/extraction.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Extraction"><h6>Extraction</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/elevators.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Root_Elevators"><h6>Root Elevators</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/syringes.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Syringes"><h6>Syringes</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/retractors.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Retractors"><h6>Retractors</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/mallets.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Mallets"><h6>Mallets</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/raspatories.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Raspatories_,_Sharp_Spoons_,_Elevators"><h6>Raspatories / Sharp Spoons / Elevators</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/suction.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Suction_Tubes"><h6>Suction Tubes</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/tweezer.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Tweezers"><h6>Tweezers</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/scissors.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Scissors"><h6>Scissors</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/needle.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Needle_Holders"><h6>Needle Holders</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/scalpel.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Scalpel_Handles"><h6>Scalpel Handles</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/haemostatic.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Haemostatic_Forceps"><h6>Haemostatic Forceps</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/rongeurs.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Bone_Rongeurs"><h6>Bone Rongeurs</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/prosthetics.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Prosthetics"><h6>Prosthetics</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/electrodes.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Dental_Electrodes"><h6>Dental Electrodes</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/impression-tray.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Impression_Trays"><h6>Impression Trays</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/trays.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Instrument_Trays"><h6>Instrument Trays</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/implantology.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Implantology"><h6>Implantology</h6></a></div>
</div></div>

<div class='col-md-4 col-lg-3 col-sm-6'><div class="product-box">
<img class="img-responsive img-center" src="<?php echo $BASE_URL; ?>images/products/Dental/Dental-Instruments/ortho-ins.png" /><div class='title'><a href="<?php echo $BASE_URL; ?>instruments.php?product=Ortho_Instruments"><h6>Ortho Instruments</h6></a></div>
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

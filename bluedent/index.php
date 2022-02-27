<?php
ob_start();
session_start();
include('connect.php');
include('includes/config.php');
if(!isset($_SESSION['order'])){
$sid = rand(000000,999999);
$_SESSION['order'] = $sid;
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

<!--Products Carousel-->
<div class="row slider">
<div class="col-md-12 col-sm-12 slider-inner">
<div id="slideCarousel" class="carousel slide hidden-xs" data-ride="carousel">
<div class="carousel-inner carousel-inner-border">

<?php
for($i=1;$i<3;$i++){
$tposition = "top";
$tslide = $i;
$tactive = '';
if($tslide == 1){
$tactive = "active";
}
else{
$tactive = '';
}
echo "<div class='item $tactive'>";
echo "<div class='row carousel-row'>";
$tslider = $pdo->prepare("SELECT * FROM sliders WHERE position=:position AND slide=:slide");
$tslider->execute(array("position"=>$tposition,"slide"=>$tslide));
while($tsrow = $tslider->fetch()){
$tsid = $tsrow['pid'];
$tsname = $tsrow['name'];
$tssname = substr($tsname,0,35);
$tslink = $tsrow['link'];
echo "<div class='col-md-3 col-sm-3'><a href='".$BASE_URL."productdetail.php?detail=$tsid'><img class='img-responsive thumbnail' src='".$BASE_URL."$tslink' alt='$tsname' /><p>$tssname</p></a></div>";
}
echo "</div>";
echo "</div>";
}
?>

</div>
</div>
</div>
</div>

<!--Products Mobile Carousel-->
<div class="row slider">
<div class="col-md-12 col-sm-12 slider-inner">
<div id="mobileSlideCarousel" class="carousel slide hidden-lg hidden-md hidden-sm" data-ride="carousel">
<div class="carousel-inner carousel-inner-border">
<?php
$tposition = "top";
$tmactive = '';
$tmslider = $pdo->prepare("SELECT * FROM sliders WHERE position=:position");
$tmslider->execute(array("position"=>$tposition));
while($tmsrow = $tmslider->fetch()){
$tmid = $tmsrow['id'];
$tmsid = $tmsrow['pid'];
$tmsname = $tmsrow['name'];
$tmssname = substr($tmsname,0,35);
$tmslink = $tmsrow['link'];
if($tmid == 1){
$tmactive = 'active';
}
else{
$tmactive = '';
}
echo "<div class='item $tmactive'>";
echo "<div class='row carousel-row'>";
echo "<div class='col-xs-12'>";
echo "<a href='".$BASE_URL."productdetail.php?detail=$tmsid'><img class='img-responsive thumbnail' src='".$BASE_URL."$tmslink' alt='$tmsname' /><p>$tmssname</p></a>";
echo "</div>";
echo "</div>";
echo "</div>";
}
?>

</div>
</div>
</div>
</div>

<!--carousel-->
<div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">
<div class="carousel-inner">
<div class="item active">
<img src="<?php echo $BASE_URL; ?>images/banner/1.jpg" alt="Bluedent India" />
</div>
<div class="item">
<img src="<?php echo $BASE_URL; ?>images/banner/2.jpg" alt="Dental" />
<div class="carousel-caption dental-caption">
<ul class="banner-links">
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Oral_Medicine_and_Radiology">Oral Medicine and Radiology</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Periodontics">Periodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Orthodontics">Orthodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Endodontics">Endodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Pedodontics">Pedodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Prosthodontics">Prosthodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Oral_Pathology">Oral Pathology</a></li>
<li><a href="<?php echo $BASE_URL; ?>oral-surgery.php">Oral Surgery</a></li>
<li><a href="<?php echo $BASE_URL; ?>dental-instruments.php">Dental Instruments</a></li>
</ul>
</div>
</div>
<div class="item">
<img src="<?php echo $BASE_URL; ?>images/banner/3.jpg" alt="Medical" />
<div class="carousel-caption medical-caption">
<ul class="banner-links">
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Gynaecology">Gynaecology</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Iontophoresis Machine">Iontophoresis Machine</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=X-Ray Apron">X-Ray Apron</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=X-Ray Viewers">X-Ray Viewers</a></li>
</ul>
</div>
</div>
<div class="item">
<img src="<?php echo $BASE_URL; ?>images/banner/4.jpg" alt="Associates" />
</div>
</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>

<!--Products Carousel-->
<div class="row slider">
<div class="col-md-12 col-sm-12 slider-inner">
<div id="slideCarousel" class="carousel slide hidden-xs" data-ride="carousel">
<div class="carousel-inner carousel-inner-border">

<?php
for($j=1;$j<3;$j++){
$bposition = "bottom";
$bslide = $j;
$bactive = '';
if($bslide == 1){
$bactive = "active";
}
else{
$bactive = '';
}
echo "<div class='item $bactive'>";
echo "<div class='row carousel-row'>";
$bslider = $pdo->prepare("SELECT * FROM sliders WHERE position=:position AND slide=:slide");
$bslider->execute(array("position"=>$bposition,"slide"=>$bslide));
while($bsrow = $bslider->fetch()){
$bsid = $bsrow['pid'];
$bsname = $bsrow['name'];
$bssname = substr($bsname,0,35);
$bslink = $bsrow['link'];
echo "<div class='col-md-3 col-sm-3'><a href='".$BASE_URL."productdetail.php?detail=$bsid'><img class='img-responsive thumbnail' src='".$BASE_URL."$bslink' alt='$bsname' /><p>$bssname</p></a></div>";
}
echo "</div>";
echo "</div>";
}
?>

</div>
</div>
</div>
</div>

<!--Products Mobile Carousel-->
<div class="row slider">
<div class="col-md-12 col-sm-12 slider-inner">
<div id="mobileSlideCarousel" class="carousel slide hidden-lg hidden-md hidden-sm" data-ride="carousel">
<div class="carousel-inner carousel-inner-border">
<?php
$bposition = "bottom";
$bmactive = '';
$bmslider = $pdo->prepare("SELECT * FROM sliders WHERE position=:position");
$bmslider->execute(array("position"=>$bposition));
while($bmsrow = $bmslider->fetch()){
$bmid = $bmsrow['id'];
$bmsid = $bmsrow['pid'];
$bmsname = $bmsrow['name'];
$bmssname = substr($bmsname,0,35);
$bmslink = $bmsrow['link'];
if($bmid == 9){
$bmactive = 'active';
}
else{
$bmactive = '';
}
echo "<div class='item $bmactive'>";
echo "<div class='row carousel-row'>";
echo "<div class='col-xs-12'>";
echo "<a href='".$BASE_URL."productdetail.php?detail=$bmsid'><img class='img-responsive thumbnail' src='".$BASE_URL."$bmslink' alt='$bmsname' /><p>$bmssname</p></a>";
echo "</div>";
echo "</div>";
echo "</div>";
}
?>

</div>
</div>
</div>
</div>

<div class="row page-title">
<div class="col-md-12 col-lg-12">
<h2>About Us</h2>
<p>
<?php
$aboutxml = $BASE_URL."xml/about.xml";
$about = simplexml_load_file($aboutxml);
echo $about->paraone . "<br><br>";
echo $about->paratwo . "<br><br>";
echo $about->parathree . "<br><br>";
?>
</p>
</div>
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
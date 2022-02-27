<?php
ob_start();
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
<div class="row page-title">
<div class="col-md-12 col-lg-12">
<h2>Downloads</h2>
</div>
</div>
<div class="row downloads">
<div class="col-md-12 col-lg-12">
<div class="col-md-4 col-lg-4">
<?php
$dcat = 'Catalogue';
$dfiles = $pdo->prepare("SELECT * FROM downloads WHERE category=:category ORDER BY date");
$dfiles->execute(array("category"=>$dcat));
if($dfiles->rowCount() == 0){
echo "<div class='alert alert-info'>No downloads available in catalogue section</div>";
}
else{
echo "<table class='table-condensed'><thead><tr><th>$dcat<span>s</span></th></tr></thead>";
while($getfiles = $dfiles->fetch()){
$filename = $getfiles['name'];
$filelink = $getfiles['link'];
//$filesize = formatSizeUnits(filesize($filelink));
echo "<tr><td><a class='button' href='".$BASE_URL."$filelink'>$filename</a></td></tr>";
}
}
echo "</table>";
?>
</div>
<div class="col-md-4 col-lg-4">
<?php
$vcat = 'Video';
$vfiles = $pdo->prepare("SELECT * FROM downloads WHERE category=:category ORDER BY date");
$vfiles->execute(array("category"=>$vcat));
if($vfiles->rowCount() == 0){
echo "<div class='alert alert-info'>No downloads available in video section</div>";
}
else{
echo "<table class='table-condensed'><thead><tr><th><span>$vcat<span>s</span></th></tr></thead>";
while($vgetfiles = $vfiles->fetch()){
$vfilename = $vgetfiles['name'];
$vfilelink = $vgetfiles['link'];
echo "<tr><td><a class='button' href='".$BASE_URL."$vfilelink'>$vfilename</a></td></tr>";
}
}
echo "</table>";
?>
</div>
<div class="col-md-4 col-lg-4">
<?php
$pcat = 'Presentation';
$pfiles = $pdo->prepare("SELECT * FROM downloads WHERE category=:category ORDER BY date");
$pfiles->execute(array("category"=>$pcat));
if($pfiles->rowCount() == 0){
echo "<div class='alert alert-info'>No downloads available in presentation section</div>";
}
else{
echo "<table class='table-condensed'><thead><tr><th><span>$pcat<span>s</span></th></tr></thead>";
while($pgetfiles = $pfiles->fetch()){
$pfilename = $pgetfiles['name'];
$pfilelink = $pgetfiles['link'];
echo "<tr><td><a class='button' href='".$BASE_URL."$pfilelink'>$pfilename</a></td></tr>";
}
}
echo "</table>";
?>
</div>
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

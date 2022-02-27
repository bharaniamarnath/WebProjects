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

<?php
$dititle = str_replace('_',' ',$_GET['product']);
$getdititle = $pdo->prepare("SELECT * FROM products WHERE classified=:subcategory LIMIT 1");
$getdititle->execute(array("subcategory"=>$dititle));
if($getdititle->rowCount() < 1){
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Oral Surgery</h2><h4>Category does not exist</h4></div></div>";
}
else{
while($ditrow = $getdititle->fetch()){
$dit = $ditrow['classified'];
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Oral Surgery</h2><h4>$dit</h4></div></div>";
}
?>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php
$dins = $pdo->prepare("SELECT * FROM products WHERE classified=:subcategory ORDER BY date ASC");
$dins->execute(array("subcategory"=>$dititle));
while($dirow = $dins->fetch()){
$didesc = stripslashes(utf8_encode($dirow['description']));
echo "<div class='col-md-6 col-lg-6'><table class='table instruments'>" . $didesc . "</table></div>";
}
?>
<?php 
echo "<input class='btn btn-danger btn-lg pull-right' type='button' onClick=parent.location='".$BASE_URL."oral-surgery.php' value='Back' />"; 
echo "</div>";
echo "</div>";
}
?>
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

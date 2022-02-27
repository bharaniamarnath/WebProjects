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
<div class='row page-title'>
<div class="col-md-12 col-lg-12">
<h2>Search Result</h2>
</div>
</div>
<div class='row order'>
<div class="col-md-12 col-lg-12">
<?php 
if(isset($_GET['search_key'])){
$search_key = $_GET['search_key'];
if($search_key == ""){
echo "<div class='alert alert-warning'>Empty search. Provide a keyword in search</div>";
echo "<form action='".$BASE_URL."search.php' role='search' name='search' id='search'>";
echo "<div class='form-group'>";
echo "<input type='text' class='form-control sm-search' placeholder='Search products' name='keyword' id='keyword'>";
echo "</div>";
echo "<button class='btn btn-primary btn-block' type='submit' name='search' role='button'>Search</button>";
echo "</form>";
}
else{
$except = 'Dental Instruments';
$listsearch  = $pdo->prepare("SELECT * FROM products WHERE pid LIKE '%$search_key%' AND category != '$except' ORDER BY subcategory ASC");
$listsearch->execute();
if($listsearch->rowCount() == 0){
echo "<div class='alert alert-danger'>No search results found for the keyword</div><a href='".$BASE_URL."index.php' class='btn btn-primary pull-right' role='button'>Home</a>";
}
else{
echo "<div class='row product'>";
while($row = $listsearch->fetch()){
$pid = $row['pid'];
$pname = $row['name'];
$pcat = $row['category'];
$psubcat = $row['subcategory'];
$image = $row['image'];
echo "<div class='col-md-4 col-lg-3 col-sm-6'><div class='product-box'>";
echo "<a href='".$BASE_URL."productdetail.php?detail=$pid'><img class='img-responsive img-center' src='".$BASE_URL."images/products/$pcat/".str_replace(' ','-',$psubcat)."/thumbs/$pid.png' alt='$pname' /></a>";
echo "<div class='title'><a href='".$BASE_URL."productdetail.php?detail=$pid'><h6>$pname</h6></a></div>";
echo "</div></div>";
}
echo "</div>";
}
}
}
?>

<?php 
if(isset($_GET['keyword'])){
$keyword = $_GET['keyword'];
if($keyword == ""){
echo "<div class='alert alert-warning'>Empty search. Provide a keyword in search</div>";
echo "<form action='".$BASE_URL."search.php' role='search' name='search' id='search'>";
echo "<div class='form-group'>";
echo "<input type='text' class='form-control sm-search' placeholder='Search products' name='keyword' id='keyword'>";
echo "</div>";
echo "<button class='btn btn-primary btn-block' type='submit' name='search' role='button'>Search</button>";
echo "</form>";
}
else{
$except = 'Dental Instruments';
$listsearch  = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$keyword%' AND category != '$except' ORDER BY subcategory ASC");
$listsearch->execute();
if($listsearch->rowCount() == 0){
echo "<div class='alert alert-danger'>No search results found for the keyword '$keyword'</div><a href='".$BASE_URL."index.php' class='btn btn-primary pull-right' role='button'>Home</a>";
}
else{
echo "<div class='alert alert-info'>Search result for '". $keyword . "'</div>";
echo "<div class='row product'>";
while($row = $listsearch->fetch()){
$pid = $row['pid'];
$pname = $row['name'];
$pcat = $row['category'];
$psubcat = $row['subcategory'];
$image = $row['image'];
echo "<div class='col-md-4 col-lg-3 col-sm-6'><div class='product-box'>";
echo "<a href='".$BASE_URL."productdetail.php?detail=$pid'><img class='img-responsive img-center' src='".$BASE_URL."images/products/$pcat/".str_replace(" ","-",$psubcat)."/thumbs/$pid.png' alt='$pname' /></a>";
echo "<div class='title' style='height: 65px; line-height: 65px;'><a href='".$BASE_URL."productdetail.php?detail=$pid'><h6>$pname<br /><small id='subcategory'>$psubcat</small></h6></a></div>";
echo "</div></div>";
}
}
echo "</div>";
}
}
?>
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

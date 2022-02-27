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
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/ekko-lightbox.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BASE_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include('header.php'); ?>
<?php 
$pid = $_GET['detail'];
$title = $pdo->prepare("SELECT subcategory from products WHERE pid=:pid LIMIT 1");
$title->execute(array("pid"=>$pid));
if($title->rowCount() < 1){
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Products </h2><h4>Product does not exist</h4></div></div>";
}
while($pt = $title->fetch()){
$pagetitle = $pt['subcategory'];
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Products </h2><h4>$pagetitle</h4></div></div>";
}
?>
<div class="row detail">
<div class="col-md-12 col-sm-12">
<?php 
$listpro  = $pdo->prepare("SELECT * FROM products WHERE pid=:pid LIMIT 1");
$listpro->execute(array("pid"=>$pid));
if($listpro->rowCount() < 1){
echo "<h5><span class='glyphicon glyphicon-exclamation-sign'></span> This product does not exist in the database</h5>";
}
else{
while($row = $listpro->fetch()){
$pid = $row['pid'];
$pname = $row['name'];
$cat = $row['category'];
$subcat = $row['subcategory'];
$desc = stripslashes(utf8_encode($row['description']));
$image = $row['image'];
$thumb = 'images/products/'.$cat.'/'.str_replace(' ','-',$subcat).'/thumbs/'.$pid.'.png';
echo "<div class='col-md-5 col-sm-5 col-lg-5'>";
$progall = $pdo->prepare("SELECT * FROM gallery WHERE pid=:pid");
$progall->execute(array("pid"=>$pid));
if($progall->rowCount() == 0){
echo "<a class='image-box-link' href='".$BASE_URL.$image."' data-toggle='lightbox' data-title='$pname'><img class='img-responsive img-center image-box' src='".$BASE_URL.$thumb."'></img></a>";
}
else{
echo "<ul id='imgul'>";
echo "<li>";
echo "<a class='image-box-link' href='".$BASE_URL.$image."' data-toggle='lightbox' data-title='$pname'><img class='img-responsive img-center image-box' src='".$BASE_URL.$thumb."'></img></a>";
echo "</li>";
while($rowgall = $progall->fetch()){
$imgid = $rowgall['imageid'];
$gallink = $rowgall['link'];
echo "<li>";
echo "<a class='image-box-link' href='".$BASE_URL.$gallink."' data-toggle='lightbox' data-title='$pname'><img class='img-responsive img-center image-box' src='".$BASE_URL."images/gallery/thumbs/$imgid.png' alt='$imgid'></img></a>";
echo "</li>";
}
echo "</ul>";
echo "<div class='imgulbtn'>";
echo "<button class='btn btn-primary btn-sm' id='previtem' name='nextitem'><span class='glyphicon glyphicon-chevron-left'></span></button>";
echo "<button class='btn btn-primary btn-sm' id='nextitem' name='nextitem'><span class='glyphicon glyphicon-chevron-right'></span></button>";
echo "</div>";
}
echo "</div>";
echo "<div class='col-md-7 col-lg-7 col-sm-7'>";
echo "<h4>".$pname."</h4>";
echo "<div id='descscroll'>".$desc."</div>";
echo "<form id='cart' action='#'>";
echo "<input type='hidden' id='qnty'" . $pid ." name='cqnty' value='1' />";
echo "<input type='hidden' name='cpid' value='".$pid."' />";
echo "<input class='btn btn-success pull-right' type='button' id='fbtn'" . $pid ." name='addtocart' value='Add to Cart' onclick='validateCart(cpid.value, cqnty.value); this.disabled=true;'/>";
echo "</form>";
echo "<input type='button' class='btn btn-danger pull-left' onClick='window.history.back()' value='Back' />";
echo "<table class='table qalert-row'><tr><td><div id='qalert" . $pid . "' class='qalert pull-right'></td></tr></table>";
echo "</div>";
}
}
?>
</div>
</div>
<?php include('footer.php'); ?>
</div>
</div>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/loadFunction.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/ekko-lightbox.min.js"></script>
<script>
$(document).delegate('[data-toggle="lightbox"]', 'click', function(event) { 
event.preventDefault(); 
$(this).ekkoLightbox(); 
}); 
</script>
<script type="text/javascript">
$(document).ready(function(){
$('#previtem').attr('disabled',true);
$('#imgul').css({'list-style-type':'none','padding':'0px','margin':'0px'});
$('#imgul li').first().addClass('first').addClass('current');
$('#imgul li').last().addClass('last');
$('#imgul li').hide();
$('.current').show();
$('#nextitem').click(function(){
$('.current').removeClass('current').hide().next().show().addClass('current');
if($('.current').hasClass('last')){
$('#nextitem').attr('disabled',true);
}
$('#previtem').attr('disabled',null);
});

$('#previtem').click(function(){
$('.current').removeClass('current').hide().prev().show().addClass('current');
if($('.current').hasClass('first')){
$('#previtem').attr('disabled',true);
}
$('#nextitem').attr('disabled',null);
});
});
</script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
</body>
</html>

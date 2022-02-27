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
<?php 
$pname = str_replace('_',' ',$_GET['product']);
$title = $pdo->prepare("SELECT subcategory from products WHERE subcategory=:subcategory LIMIT 1");
$title->execute(array("subcategory"=>$pname));
if($title->rowCount() < 1){
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Products</h2><h4>Category does not exist</h4></div></div>";
}
else{
while($pt = $title->fetch()){
$pagetitle = $pt['subcategory'];
echo "<div class='row page-title'><div class='col-md-12 col-lg-12'><h2>Products</h2><h4>".$pagetitle."</h4></div></div>";
}
?>
<div class="row product">
<div class="col-md-12 col-lg-12">
<?php 
$result = $pdo->prepare("SELECT * FROM products WHERE subcategory=:subcategory ORDER BY subcategory, date, date");
$result->execute(array("subcategory"=>$pname));
if($result->rowCount()){
$groups = array();
while ($row = $result->fetch()) {
$pimage = 'images/products/'.$row['category'].'/'.str_replace(' ','-',$row['subcategory']).'/thumbs/'.$row['pid'].'.png';
$groups[$row['subcategory']][$row['classified']][] = "<div class='col-md-4 col-lg-3 col-sm-6'><div class='product-box'>
<a href='".$BASE_URL."productdetail.php?detail=$row[pid]'><img class='img-responsive img-center' src='".$BASE_URL.$pimage."' alt='$row[name]' /></a><div class='title'><a data-toggle='modal' href='".$BASE_URL."description.php?detail=$row[pid]' data-target='#descModal'><h6>$row[name]</h6></a></div></div></div>";
}
echo "<div class='panel-group' id='accordion'>";
foreach ($groups AS $group => $categories){
foreach ($categories AS $category => $brands){
if($category == NULL) 
$category = str_replace(" ", "-", $group);
echo "<div class='panel panel-default'>";
echo "<div class='panel-heading'>";
echo "<h4 class='panel-title'>";
echo "<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion' href='#$category'>" . str_replace("-", " ", $category) . "</a>";
echo "</h4>";
echo "</div>";
echo "<div id='$category' class='panel-collapse collapse in'>";
echo "<div class='panel-body'>";
foreach ($brands AS $brand){
echo $brand ;
}
echo "</div>";
echo "</div>";
echo "</div>";
}
}
echo "</div>";
}
echo "</div>";
echo "</div>";
}
?>
<div id="descModal" class="modal fade slow">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <div class="modal-header">
        <button type="button" class="close modal-close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h5><span><img class="img-responsive modal-logo" src="<?php echo $BASE_URL; ?>logos/Bluedent.png" /></h5>
      </div>
      <div class="modal-body">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $BASE_URL; ?>js/countcart.js"></script>
<!-- Modal Script -->
<script type="text/javascript">
$(document).ready(function() {
	$('a[data-toggle="modal"]').on('click', function(e) {
		var target_modal = $(e.currentTarget).data('target');
		var remote_content = e.currentTarget.href;
		var modal = $(target_modal);
		var modalBody = $(target_modal + ' .modal-body');
		modal.on('show.bs.modal', function () {
            modalBody.html('<h5>Loading</h5>').load(remote_content);
        }).modal();
    return false;
  });
});
</script>
<!-- Lightbox Script -->
<script type="text/javascript">
$(document).delegate('[data-toggle="lightbox"]', 'click', function(event) { 
event.preventDefault(); 
$(this).ekkoLightbox(); 
}); 
</script>
<script type="text/javascript">
$(".autosearch").hide();
</script>
<!-- Accordion Script -->
<script type="text/javascript">
$('.collapse').collapse('hide');
$('#accordion').on('show.bs.collapse', function () {
	$('#accordion .in').collapse('hide');
});
</script>
</body>
</html>
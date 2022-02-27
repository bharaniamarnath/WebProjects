<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/validateUpdateProduct.php');
include('includes/validateProductImage.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
//Assign error variables
$pnameErr = '';
$pcategoryErr = '';
$psubcategoryErr = '';
$pgroupErr = '';
$pdescErr = '';
$pimageErr = '';
$pupdatestatus = '';
//get valuese from html form
if(isset($_REQUEST['updateproduct'])){
$pid = trim($_REQUEST['prodid']);
$pname = trim($_REQUEST['pname']);
$pcategory = trim($_REQUEST['pcategory']);
$psubcategory = trim($_REQUEST['psubcategory']);
$pgroup = trim($_REQUEST['pgroup']);
$pdescription = trim($_REQUEST['pdescription']);
//image file values
$imgpath = str_replace(" ","-","images/products/$pcategory/$psubcategory/$pid.png");
$imgthumbpath = str_replace(" ","-","images/products/$pcategory/$psubcategory/thumbs/$pid.png");
$imagename = $_FILES['image']['name'];
$source = $_FILES['image']['tmp_name'];
$file_size = $_FILES['image']['size'];
$size_limit = '10485760';
$target = str_replace(" ","-","../images/products/$pcategory/$psubcategory/$pid.png");
$file_type = $_FILES['image']['type'];
//create class and objects
$validateUpdateProduct = new validateUpdateProduct();
$validateName = $validateUpdateProduct->validateName($pname);
$validateCategory = $validateUpdateProduct->validateCategory($pcategory);
$validateSubCategory = $validateUpdateProduct->validateSubCategory($psubcategory);
$validateGroup = $validateUpdateProduct->validateGroup($pgroup);
$validateDescription = $validateUpdateProduct->validateDescription($pdescription);
//check if objects are true and add product
if($validateName == false){
$pnameErr = $validateUpdateProduct->pnameErr();
}
if($validateCategory == false){
$pcategoryErr = $validateUpdateProduct->pcategoryErr();
}
if($validateSubCategory == false){
$psubcategoryErr = $validateUpdateProduct->psubcategoryErr();
}
if($validateGroup == false){
$pgroupErr = $validateUpdateProduct->pgroupErr();
}
if($validateDescription == false){
$pdescErr = $validateAddProduct->pdescErr();
}
$validateProductImage = new validateProductImage();
$addImage = $validateProductImage->validateImageUpload($pid,$pcategory,$psubcategory,$file_size,$size_limit,$source,$target,$file_type);
if($addImage == false){
$pimageErr = $validateProductImage->imageError();
}
if($validateName !== false && $validateCategory !== false && $validateSubCategory !== false && $validateGroup !== false && $validateDescription !== false && $addImage !== false){
$updateProduct = $validateUpdateProduct->updateProduct($pid,$pname,$pcategory,$psubcategory,$pgroup,$pdescription,$imgpath,$imgthumbpath);
if($updateProduct == true){
$pupdatestatus = $validateUpdateProduct->proUpdateSuccess();
}
else if($updateProduct == false){
$pupdatestatus = $validateUpdateProduct->proUpdateFailed();
}
else{
$pupdatestatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
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
<h2>Edit Product</h2>
</div>
</div>
<div class="row order">

<?php
if(isset($_GET['pid'])){
$proid = $_GET['pid'];
$prodet = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$prodet->execute(array("pid"=>$proid));
while($rowdet = $prodet->fetch()){
$pdid = $rowdet['pid'];
$pdname = $rowdet['name'];
$pdcat = $rowdet['category'];
$pdsubcat = $rowdet['subcategory'];
$pdgroup = $rowdet['classified'];
$pddesc = stripslashes(utf8_encode($rowdet['description']));
$pddimage = $rowdet['image'];
$pddate = $rowdet['date'];
$pdimage = str_replace(" ","-","images/products/$pdcat/$pdsubcat/thumbs/$pdid.png");
}
}
?>
<form id="editProductForm" action="<?php echo $CP_URL; ?>editproduct.php?pid=<?php echo $proid; ?>" method="POST" enctype="multipart/form-data">
<div class="col-md-12 col-lg-12">
<h4 class="table-heading">Edit Product</h4>
<?php 
if($pupdatestatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $pupdatestatus; ?></div>
<?php
}
?>
<div class="form-group"><label for="pname">Product Name</label><input class="form-control" type="text" name="pname" id="pname" value="<?php echo $pdname; ?>" /></div>
<label class="verror"><?php echo $pnameErr; ?></label>
<div class="form-group"><label for="pcategory">Category</label><select class="form-control" name="pcategory" id="pcategory">
<option value="<?php echo $pdcat; ?>"><?php echo $pdcat; ?></option>
<option value="Dental">Dental</option>
<option value="Medical">Medical</option>
</select></div>
<label class="verror"><?php echo $pcategoryErr; ?></label>
<div class="form-group"><label for="psubcategory">Sub-Category</label><select class="form-control" name="psubcategory" id="psubcategory">
<option value="<?php echo $pdsubcat; ?>"><?php echo $pdsubcat; ?></option>
<option value="Oral Medicine and Radiology">Oral Medicine and Radiology</option>
<option value="Periodontics">Periodontics</option>
<option value="Orthodontics">Orthodontics</option>
<option value="Endodontics">Endodontics</option>
<option value="Pedodontics">Pedodontics</option>
<option value="Prosthodontics">Prosthodontics</option>
<option value="Oral Pathology">Oral Pathology</option>
<option value="Oral Surgery">Oral Surgery</option>
<option value="Dental Instruments">Dental Instruments</option>
<option value="Gynaecology">Gynaecology</option>
<option value="Iontophoresis Machine">Iontophoresis Machine</option>
<option value="X-Ray Apron">X-Ray Apron</option>
<option value="X-Ray Viewers">X-Ray Viewers</option>
</select></div>
<label class="verror"><?php echo $psubcategoryErr; ?></label>
<div class="form-group"><label for="pgroup">Group</label><select class="form-control" name="pgroup" id="pgroup">
<option value="<?php echo $pdgroup; ?>"><?php echo $pdgroup; ?></option>
<option value="">-</option>
<option value="Accessories">Accessories</option>
<option value="Articulators-and-Accessories">Articulators and Accessories</option>
<option value="Consumables">Consumables</option>
<option value="Crowns">Crowns</option>
<option value="Cephalometric-Software">Cephalometric Software</option>
<option value="Education-Models">Education Models</option>
<option value="Equipments">Equipments</option>
<option value="Instruments">Instruments</option>
<option value="Loupes">Loupes</option>
<option value="Microscopes">Microscopes</option>
<option value="Microtomes">Microtomes</option>
<option value="Models">Models</option>
<option value="Positioning-Devices">Positioning Devices</option>
<option value="Processors">Processors</option>
<option value="Scanners-and-Camera">Scanners and Camera</option>
<option value="Softwares">Softwares</option>
<option value="Speciality-Instruments">Speciality Instruments</option>
<option value="Storage-Units">Storage Units</option>
<option value="Viewers">Viewers</option>
<option value="Viewers-and-Tracing">Viewers and Tracing</option>
<option value="X-Ray-Accessories">X Ray Accessories</option>
<option value="X-Ray-Protective-Apparels">X Ray Protective Apparels</option>
<option value="AXE Minor and Major OT Instruments">AXE Minor and Major OT Instruments</option>
<option value="Cleft and General Kit">Cleft and General Kit</option>
<option value="Distraction Osteogenesis and Trauma Kit">Distraction Osteogenesis and Trauma Kit</option>
<option value="Impaction kit">Impaction kit</option>
<option value="Micro Surgery kit OS">Micro Surgery kit OS</option>
<option value="Osteotomy and Tracheotomy Kits">Osteotomy and Tracheotomy Kits</option>
<option value="Plate and Screws Kit">Plate and Screws Kit</option>
<option value="Diagnostics">Diagnostics</option>
<option value="Conservative Treatment">Conservative Treatment</option>
<option value="Periodontology">Periodontology</option>
<option value="Extraction">Extraction</option>
<option value="Root Elevators">Root Elevators</option>
<option value="Syringes">Syringes</option>
<option value="Retractors">Retractors</option>
<option value="Mallets">Mallets</option>
<option value="Raspatories , Sharp Spoons , Elevators">Raspatories / Sharp Spoons / Elevators</option>
<option value="Suction Tubes">Suction Tubes</option>
<option value="Tweezers">Tweezers</option>
<option value="Scissors">Scissors</option>
<option value="Needle Holders">Needle Holders</option>
<option value="Scalpel Handles">Scalpel Handles</option>
<option value="Haemostatic Forceps">Haemostatic Forceps</option>
<option value="Bone Rongeurs">Bone Rongeurs</option>
<option value="Prosthetics">Prosthetics</option>
<option value="Dental Electrodes">Dental Electrodes</option>
<option value="Impression Trays">Impression Trays</option>
<option value="Instrument Trays">Instrument Trays</option>
<option value="Implantology">Implantology</option>
<option value="Ortho Instruments">Ortho Instruments</option>
</select></div>
<label class="verror"><?php echo $pgroupErr; ?></label>
<div class="form-group"><label for="pdescription">Description</label><textarea class="form-control" id="pdescription" name="pdescription"><?php echo $pddesc; ?></textarea></div>
<label class="verror"><?php echo $pdescErr; ?></label>
<div class="form-group" id="textcontrol">
<?php
$para = "&lt;p&gt;&#92;n&#92;n&lt;&#47;p&gt;";
$ol = "&lt;ol&gt;&#92;n&lt;li&gt;&#92;n&lt;&#47;ol&gt;&#92;n";
$li = "&lt;li&gt;&#92;n";
$link = "&lt;a href=&quot;#&quot;&gt;&lt;&#47;a&gt;&#92;n";
$bold = "&lt;b&gt;&lt;&#47;b&gt;&#92;n";
$break = "&lt;br &#47;&gt;&#92;n";
$italics = "&lt;i&gt;&lt;&#47;i&gt;&#92;n";
$image = "&lt;a href=&quot;#&quot; data&#45;toggle=&quot;lightbox&quot;&gt;&lt;img class=&quot;img&#45;responsive&quot; src=&quot;#&quot; &#47;&gt;&lt;&#47;a&gt;&#92;n";
$div = "&lt;div&gt;&lt;&#47;div&gt;&#92;n";
?>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $para; ?>'); return false">p</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $ol; ?>'); return false">ol</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $li; ?>'); return false">li</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $link; ?>'); return false">lk</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $bold; ?>'); return false">b</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $break; ?>'); return false">br</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $italics; ?>'); return false">i</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $image; ?>'); return false">im</button>
<button type="button" unselectable="on" class="btn btn-primary btn-sm" onmousedown="insertAtCursor('<?php echo $div; ?>'); return false">dv</button>

<button type="button" class="btn btn-primary btn-sm" onclick="countit(this)" id="editbutton" />c</button>
<div class="col-sm-2 pull-right"><input class="form-control" type="text" name="displaycount" size="6"></div>
</div>
<div class="form-group"><label for="product-image">Product Image</label><img class='img-responsive img-edit' src="<?php echo $BASE_URL.$pdimage; ?>" /></div>
<div class="form-group"><label for="product-image">Update Product Image <i>(Optional)</i></label><br /><label class="btn btn-warning btn-file">Browse Image<input type="file" name="image" id="image" style="display: none;" /></label></div>
<div class="form-group"><label for="date-added">Date Added: <?php echo $pddate; ?></label></div>
<input type="hidden" value="<?php echo $pdid; ?>" name="prodid" />
<button class="btn btn-success btn-lg pull-right" type="submit" name="updateproduct" id="updateproduct">Update</button>
<a class="btn btn-danger btn-lg" id="deletelink" role="button" href="<?php echo $CP_URL; ?>editlist.php?del=<?php echo $pdid; ?>">Delete</a>
</form>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Instructions to edit a product</th></tr></thead>
<tr><td><h4><small>General Formats:</small></h4><ul><li>Enter the product name in upper-case characters</li>
<li>Select the appropriate category and sub-category from the drop-down options before adding the product.</li></ul>
<h4><small>Product Description Formats:</small></h4>
<ul>
<li>Description cannot contain more than 10000 characters.</li>
<li>p - To insert a paragraph</li>
<li>ol - To insert a ordered list</li>
<li>li - To insert a list item</li>
<li>lk - To insert a link (Replace '#' with your link)</li>
<li>b - Bold character</li>
<li>br - Break line</li>
<li>i - Italics character</li>
<li>im - To insert a image in description (Replace '#' with your link)</li>
<li>dv - To insert a division</li>
<li>c - To count characters in description</li>
</ul>
</td></tr>
<tr><td>
<h4><small>Product Image Formats:</small></h4>
<ul>
<li>Using images of size with square dimensions is recommended. <i>example: 200px width &amp; 200px height</i></li>
<li>PNG format images are recommended for good quality.</li><br />
</ul></td></tr></table>

<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead>
<form action="<?php echo $CP_URL; ?>editlist.php" method="POST" enctype="multipart/form-data">
<tr><td>Search Product: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</form>
<tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href="<?php echo $CP_URL; ?>dashboard.php">Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/validateEditProduct.js"></script>
<script type="text/javascript">
function insertAtCursor(text) {   
var field = document.getElementById("pdescription");

if (document.selection) {
var range = document.selection.createRange();

if (!range || range.parentElement() != field) {
field.focus();
range = field.createTextRange();
range.collapse(false);
}
range.text = text;
range.collapse(false);
range.select();
} else {
field.focus();
var val = field.value;
var selStart = field.selectionStart;
var caretPos = selStart + text.length;
field.value = val.slice(0, selStart) + text + val.slice(field.selectionEnd);
field.setSelectionRange(caretPos, caretPos);
}
}
function countit(what){
formcontent=what.form.pdescription.value
what.form.displaycount.value=formcontent.length
}
</script>
</body>
</html>

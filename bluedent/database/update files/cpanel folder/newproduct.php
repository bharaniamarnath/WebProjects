<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script>
function insertAtCursor(text) {   
var field = document.getElementById("description");

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
formcontent=what.form.description.value
what.form.displaycount.value=formcontent.length
}
</script>
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'><div class='col-md-12'><h2>Add Product</h2></div></div>
<div class="row order">
<form action="http://www.bluedentindia.in/addproduct.php" method="POST" enctype="multipart/form-data" name="productdetail">
<div class="col-md-12"><table class="table edit-box"><thead><tr><th colspan="2">Add a New Product</th></tr></thead>
<tr><td>Product Name</td><td><input class="form-control" type="text" name="pname" /></td></tr>
<tr><td>Category</td><td><select class="form-control" name="category">
<option value="Dental">Dental</option>
<option value="Medical">Medical</option>
<option value="Oral Surgery">Oral Surgery</option>
<option value="Dental Instruments">Dental Instruments</option>
</select></td></tr>
<tr><td>Sub-Category</td><td><select class="form-control" name="subcategory">
<option value="Oral Medicine and Radiology">Oral Medicine and Radiology</option>
<option value="Periodontics">Periodontics</option>
<option value="Orthodontics">Orthodontics</option>
<option value="Endodontics">Endodontics</option>
<option value="Pedodontics">Pedodontics</option>
<option value="Prosthodontics">Prosthodontics</option>
<option value="Oral Pathology">Oral Pathology</option>
<option value="Oral Surgery">Oral Surgery</option>
<option value="Gynaecology">Gynaecology</option>
<option value="Iontophoresis Machine">Iontophoresis Machine</option>
<option value="X-Ray Apron">X-Ray Apron</option>
<option value="X-Ray Viewers">X-Ray Viewers</option>
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
<option value="Raspatories / Sharp Spoons / Elevators">Raspatories / Sharp Spoons / Elevators</option>
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
</select></td></tr>
<tr><td>Group</td><td><select class="form-control" name="group">
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
</select></td></tr>
<tr><td colspan="2">Description</td></tr><td colspan="2"><textarea class="form-control" id="description" name="description"></textarea></td></tr>
<tr><td colspan="2"><div id="textcontrol">
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
<div class="col-md-2 pull-right"><input class="form-control" type="text" name="displaycount" size="6"></div>
</div>
</td></tr>
<tr><td>Select Product Image</td><td><span class="btn btn-warning btn-file">Browse Image<input type="file" name="image" id="image" /></span></td></tr>
<tr><td colspan="2">
<button class="btn btn-success btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-success btn-lg pull-right" type="submit" name="addproduct" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add Product</button></td></tr>
</table>
</form>

<table class="table cart"><thead><tr><th colspan="2">Instructions to add a product</th></tr></thead>
<tr><td><h4><small>General Formats:</small></h4><ul><li>Enter the product name in upper-case characters<i>(Optional)</i></li>
<li>Select the appropriate category and sub-category from the drop-down options before adding the product.</li></ul>
<h4><small>Product Description Formats:</small></h4>
<ul>
<li>Description cannot contain more than 10000 characters. Count the characters after filling the product description using the <i>c (count)</i> button</li>
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
<form action="editlist.php" method="POST" enctype="multipart/form-data">
<tr><td>Search Product: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</form>
<tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='admincontrol.php'>Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>

</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

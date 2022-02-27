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
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'><div class='col-md-12'><h2>Edit Product</h2></div></div>
<div class="row order">
<div class="col-md-12">
<form action="editlist.php" method="POST" enctype="multipart/form-data">
<table class="table cart"><thead><tr><th colspan="2">Option 1: Select product category</th></tr></thead>
<tr><td>Select the product category: </td><td><select class="form-control" name="selectcategory">
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
<tr><td colspan="2"><button class="btn btn-success btn-lg pull-right" type="submit" name="selectproduct">Select</button></td></tr>
</table>
</form>

<form action="editlist.php" method="POST" enctype="multipart/form-data">
<table class="table cart"><thead><tr><th colspan="2">Option 2: Search Product to edit</th></tr></thead>
<tr><td>Enter Product Name: </td><td><input type="text" class="form-control" name="findproduct"></tr><tr><td colspan="2"><button type="submit" class="btn btn-primary btn-lg pull-right" name="searchproduct">Search</button></td></tr>
</table>
</form>

<?php
if(isset($_POST['selectproduct'])){
$cat = $_POST['selectcategory'];
$selcat = $pdo->prepare("SELECT * FROM products WHERE subcategory=:subcategory ORDER BY name ASC");
$selcat->execute(array("subcategory"=>$cat));
echo "<table class='table edit-box'><thead><tr><th colspan='3'><h4>$cat</h4></th></tr><tr><th>Product ID</th><th>Product Name</th><th>Actions</th></tr></thead>";
while($rowcat = $selcat->fetch()){
$catid = $rowcat['pid'];
$catname = $rowcat['name'];
$catdate = $rowcat['date'];
echo "<tr><td>$catid</td><td>$catname</td><td><form action='editproduct.php' method='POST'><input type='hidden' name='proid' value='$catid'><button class='btn btn-primary btn-sm pull-left' type='submit' name='editproduct'>Edit</button></form><form action='http://www.bluedentindia.in/addgallery.php' method='POST'><input type='hidden' name='progid' value='$catid'><button class='btn btn-success btn-sm pull-left' type='submit' name='addgallery'>Images</button></form></td></tr>";
}
echo "</table>";
}
?>
<?php
if(isset($_POST['searchproduct'])){
$pkey = $_POST['findproduct'];
$selp = $pdo->prepare("SELECT * FROM products WHERE name LIKE '%$pkey%' ORDER BY name ASC");
$selp->execute();
if($selp->rowCount() == 0){
echo "<div class='alert alert-warning'>No product(s) found for the search</div>";
}
else{
echo "<table class='table edit-box'><thead><tr><th colspan='3'><h4>$pkey</h4></th></tr><tr><th>Product ID</th><th>Product Name</th><th>Actions</th></tr></thead>";
while($rowcat = $selp->fetch()){
$catid = $rowcat['pid'];
$catname = $rowcat['name'];
$catsc = $rowcat['subcategory'];
$catdate = $rowcat['date'];
echo "<tr><td>$catid</td><td>$catname</td><td><form action='editproduct.php' method='POST'><input type='hidden' name='proid' value='$catid'><button class='btn btn-primary btn-sm pull-left' type='submit' name='editproduct'>Edit</button></form><form action='http://www.bluedentindia.in/addgallery.php' method='POST'><input type='hidden' name='progid' value='$catid'><button class='btn btn-success btn-sm pull-left' type='submit' name='addgallery'>Images</button></form></td></tr>";
}
echo "</table>";
}
}
?>
<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='admincontrol.php'>Control Panel</a></td></tr></table>
</div>
</div>
<?php include('footer.php'); ?>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

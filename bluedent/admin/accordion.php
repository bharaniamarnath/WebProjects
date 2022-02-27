<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
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
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'><div class='col-md-12 col-lg-12'>
<h2>Edit Accordion</h2>
</div>
</div>
<div class="row order">

<?php
if(isset($_POST['update'])){
$index = $_POST['index'];
$subcat = $_POST['subcategory'];
$classified = $_POST['group'];
$prodet = $pdo->prepare("UPDATE products SET panel=:panel WHERE subcategory=:subcategory AND classified=:classified");
$prodet->execute(array(
				"panel"=>$index,
				"subcategory"=>$subcat,
				"classified"=>$classified
				));
if($prodet){
echo "<div class='alert alert-success'>Panel index updated</div>";
echo "<a class='btn btn-primary pull-right' href='".$CP_URL."accordion.php'>Back</a>";
}
else{
echo "<div class='alert alert-danger'>Panel index update failed</div>";
echo "<a class='btn btn-primary pull-right' href='".$CP_URL."accordion.php'>Back</a>";
}
}
?>
<form action="<?php echo $CP_URL; ?>accordion.php" method="POST" enctype="multipart/form-data">
<div class="col-md-12 col-lg-12">
<table class="table edit-box"><thead><tr><th colspan="2">Edit Accordion</th></tr></thead>
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
<tr><td>Index</td><td><input type="text" name="index" class="form-control" /></td></tr>
<tr><td colspan="2"><input class="btn btn-success btn-lg pull-right" type="submit" name="update" value="Update" /></td></tr>
</table>
</form>

</div>
</div>
<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
</body>
</html>

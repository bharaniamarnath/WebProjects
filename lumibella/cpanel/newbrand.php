<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateAddBrand.php');
//Assign exception values
$brandStatus = "Result status will be updated and displayed here";
$brandErr = '';
if(isset($_REQUEST['addbrand'])){
//get form values
$brand = trim($_REQUEST['pbrand']);
//create class and object
$validateAddBrand = new validateAddBrand();
$validateBrand = $validateAddBrand->validateBrand($brand);
$validateDuplicateBrand = $validateAddBrand->validateDuplicateBrand($brand);
//throw exceptions
if($validateBrand == false){
$brandErr = $validateAddBrand->brandErr();
}
if($validateDuplicateBrand == false){
$brandStatus = $validateAddBrand->duplicateErr();
}
if($validateBrand !== false && $validateDuplicateBrand !== false){
$addNewBrand = $validateAddBrand->addNewBrand($brand);
if($addNewBrand == true){
$brandStatus = $validateAddBrand->brandAddSuccess();
}
else if($addNewBrand == false){
$brandStatus = $validateAddBrand->brandAddFailed();
}
else{
$brandStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Stores</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content">
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Add new brand</h4>
<hr>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="customerRegister"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $brandStatus; ?></div></div>
<form action="newbrand.php" method="POST" enctype="multipart/form-data" name="productdetail">


<div class="form-group"><label for="product-category">Brand Name</label>
<input type="text" name="pbrand" class="form-control" placeholder="Enter Brand Name" maxlength="20" /><span class="exception"><?php echo $brandErr; ?></span></div>


<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-primary btn-lg pull-right" type="submit" name="addbrand" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add Brand</button>
</form>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateAddCategory.php');
//Assign exception values
$categoryStatus = "Result status will be updated and displayed here";
$categoryErr = '';
$subcategoryErr = '';
$sectionErr = '';
if(isset($_REQUEST['addcategory'])){
//get form values
$section = trim($_REQUEST['psection']);
$category = trim($_REQUEST['pcategory']);
$subcategory = trim($_REQUEST['psubcategory']);
//create class and object
$validateAddCategory = new validateAddCategory();
$validateSection = $validateAddCategory->validateSection($section);
$validateCategory = $validateAddCategory->validateCategory($category);
$validateSubcategory = $validateAddCategory->validateSubcategory($subcategory);
$validateDuplicateCategory = $validateAddCategory->validateDuplicateCategory($section, $category, $subcategory);
//throw exceptions
if($validateSection == false){
$sectionErr = $validateAddCategory->sectionErr();
}
if($validateCategory == false){
$categoryErr = $validateAddCategory->categoryErr();
}
if($validateSubcategory == false){
$subcategoryErr = $validateAddCategory->subcategoryErr();
}
if($validateDuplicateCategory == false){
$categoryStatus = $validateAddCategory->duplicateErr();
}
if($validateSection !== false && $validateCategory !== false && $validateSubcategory !== false && $validateDuplicateCategory !== false){
$addNewCategory = $validateAddCategory->addNewCategory($section, $category, $subcategory);
if($addNewCategory == true){
$categoryStatus = $validateAddCategory->categoryAddSuccess();
}
else if($addNewCategory == false){
$categoryStatus = $validateAddCategory->categoryAddFailed();
}
else{
$categoryStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
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
<h4 class="heading">Add new category</h4>
<hr>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="customerRegister"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $categoryStatus; ?></div></div>
<form action="newcategory.php" method="POST" enctype="multipart/form-data" name="productdetail">

<div class="form-group"><label for="product-section">Product Section</label>
<select class="form-control" name="psection">
<option value="Kids">Kids</option>
<option value="Men">Men</option>
<option value="Women">Women</option>
</select>
<span class="exception"><?php echo $sectionErr; ?></span>
</div>

<div class="form-group"><label for="product-category">Product Category</label>
<input type="text" name="pcategory" class="form-control" placeholder="Enter Product Category" maxlength="20" /><span class="exception"><?php echo $categoryErr; ?></span></div>

<div class="form-group"><label for="product-subcategory">Product Subcategory</label>
<input type="text" name="psubcategory" class="form-control" placeholder="Enter Product Subcategory" maxlength="20" /><span class="exception"><?php echo $subcategoryErr; ?></span></div>

<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-primary btn-lg pull-right" type="submit" name="addcategory" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add Category</button>
</form>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
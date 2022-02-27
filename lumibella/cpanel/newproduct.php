<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateAddProduct.php');
include('includes/validateProductImage.php');
//Assign error variables
$pnameErr = '';
$psectionErr = '';
$pcategoryErr = '';
$psubcatErr = '';
$pbrandErr = '';
$pdescErr = '';
$ppriceErr = '';
$pstockErr = '';
$pimageErr = '';
$paddStatus = 'Status message will be displayed here';
//get valuese from html form
if(isset($_REQUEST['addproduct'])){
$pid = sprintf("%06d", mt_rand(100000,999999));
$pname = trim($_REQUEST['pname']);
$psection = trim($_REQUEST['psection']);
$pcategory = trim($_REQUEST['pcategory']);
$psubcategory = trim($_REQUEST['psubcategory']);
$pbrand = trim($_REQUEST['pbrand']);
$pdescription = trim($_REQUEST['pdescription']);
$pprice = trim($_REQUEST['pprice']);
$pstock = trim($_REQUEST['pstock']);
//image file values
$imgpath = "images/products/$psection/$pcategory/$psubcategory/$pid.jpg";
$imgthumbpath = "images/products/$psection/$pcategory/$psubcategory/thumbs/$pid.jpg";
$imagename = $_FILES['image']['name'];
$source = $_FILES['image']['tmp_name'];
$file_size = $_FILES['image']['size'];
$size_limit = '1000000';
$target = "../images/products/$psection/$pcategory/$psubcategory/$pid.jpg";
$file_type = $_FILES['image']['type'];
//create class and objects
$validateAddProduct = new validateAddProduct();
$validateName = $validateAddProduct->validateName($pname);
$validateSection = $validateAddProduct->validateSection($psection);
$validateCategory = $validateAddProduct->validateCategory($pcategory);
$validateSubcategory = $validateAddProduct->validateSubcategory($psubcategory);
$validateBrand = $validateAddProduct->validateBrand($pbrand);
$validateDescription = $validateAddProduct->validateDescription($pdescription);
$validatePrice = $validateAddProduct->validatePrice($pprice);
$validateStock = $validateAddProduct->validateStock($pstock);
$validateImage = $validateAddProduct->validateImage($file_size,$size_limit);
$getCategoryID = $validateAddProduct->getCategoryID($psection,$pcategory,$psubcategory);
$getBrandID = $validateAddProduct->getBrandID($pbrand);
$checkProduct = $validateAddProduct->checkProduct($pname,$getCategoryID);
//check if objects are true and add product
if($validateName == false){
$pnameErr = $validateAddProduct->pnameErr();
}
if($validateSection == false){
$psectionErr = $validateAddProduct->psectionErr();
}
if($validateCategory == false){
$pcategoryErr = $validateAddProduct->pcategoryErr();
}
if($validateSubcategory == false){
$psubcatErr = $validateAddProduct->psubcatErr();
}
if($validateBrand == false){
$pbrandErr = $validateAddProduct->pbrandErr();
}
if($validateDescription == false){
$pdescErr = $validateAddProduct->pdescErr();
}
if($validatePrice == false){
$ppriceErr = $validateAddProduct->ppriceErr();
}
if($validateStock == false){
$pstockErr = $validateAddProduct->pstockErr();
}
if($validateImage == false){
$pimageErr = $validateAddProduct->pimageErr();
}
if($checkProduct == false){
$paddStatus = $validateAddProduct->proexistErr();
}
$validateProductImage = new validateProductImage();
$addImage = $validateProductImage->validateImageUpload($pid,$psection,$pcategory,$psubcategory,$file_size,$size_limit,$source,$target,$file_type);
if($addImage == false){
$pimageErr = $validateProductImage->imageError();
}
if($validateName !== false && $validateSection !== false && $validateCategory !== false && $validateSubcategory !== false && $validateDescription !== false && $validatePrice !== false && $validateStock !== false && $validateImage !== false && $checkProduct !== false && $addImage !== false){
$addProduct = $validateAddProduct->addProduct($pid,$pname,$getCategoryID,$pdescription,$getBrandID,$pprice,$pstock,$imgpath,$imgthumbpath);
if($addProduct == true){
$paddStatus = $validateAddProduct->proAddSuccess();
}
else if($addProduct == false){
$paddStatus = $validateAddProduct->proAddFailed();
}
else{
$paddStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
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
<h4 class="heading">Add new product</h4>
<hr>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="customerRegister"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $paddStatus; ?></div></div>
<form action="newproduct.php" method="POST" enctype="multipart/form-data" name="productdetail">
<div class="form-group"><label for="product-name">Product Name</label>
<input type="text" name="pname" class="form-control" placeholder="Enter Product Name" maxlength="50" /><span class="exception"><?php echo $pnameErr; ?></span></div>

<div class="form-group"><label for="product-section">Product Section</label>
<select class="form-control" name="psection">
<?php
$selectsec = $pdo->prepare("SELECT DISTINCT section FROM categories ORDER BY section");
$selectsec->execute();
while($ss = $selectsec->fetch()){
$secname = $ss['section'];
?>
<option value="<?php echo $secname; ?>"><?php echo $secname; ?></option>
<?php
}
?>
</select>
<span class="exception"><?php echo $psectionErr; ?></span>
</div>

<div class="form-group"><label for="product-category">Product Category</label>
<select class="form-control" name="pcategory">
<?php
$selectcat = $pdo->prepare("SELECT DISTINCT category FROM categories ORDER BY category");
$selectcat->execute();
while($sc = $selectcat->fetch()){
$catname = $sc['category'];
?>
<option value="<?php echo $catname; ?>"><?php echo $catname; ?></option>
<?php
}
?>
</select>
<span class="exception"><?php echo $pcategoryErr; ?></span>
</div>

<div class="form-group"><label for="product-subcategory">Product Subcategory</label>
<select class="form-control" name="psubcategory">
<?php
$selectsubcat = $pdo->prepare("SELECT DISTINCT subcategory FROM categories ORDER BY subcategory");
$selectsubcat->execute();
while($ssub = $selectsubcat->fetch()){
$subcatname = $ssub['subcategory'];
?>
<option value="<?php echo $subcatname; ?>"><?php echo $subcatname; ?></option>
<?php
}
?>
</select>
<span class="exception"><?php echo $psubcatErr; ?></span>
</div>

<div class="form-group"><label for="product-brand">Product Brand</label>
<select class="form-control" name="pbrand">
<?php
$selectbrand = $pdo->prepare("SELECT * FROM brands ORDER BY brandname");
$selectbrand->execute();
while($sbrand = $selectbrand->fetch()){
$brandname = $sbrand['brandname'];
?>
<option value="<?php echo $brandname; ?>"><?php echo $brandname; ?></option>
<?php
}
?>
</select>
<span class="exception"><?php echo $pbrandErr; ?></span>
</div>

<div class="form-group"><label for="product-description">Product Description</label><textarea class="form-control" id="description" name="pdescription" maxlength="1024"></textarea><span class="exception"><?php echo $pdescErr; ?></span></div>
<div class="form-group"><label for="product-price">Product Price (INR)</label>
<div class='input-group'><span class='input-group-addon'>Rs.</span><input type="text" name="pprice" class="form-control" placeholder="Enter Product Price (Decimal Format)" maxlength="8" /></div><span class="exception"><?php echo $ppriceErr; ?></span></div>
<div class="form-group"><label for="product-stock">Product Stock</label>
<input type="text" name="pstock" class="form-control" placeholder="Enter Product Stock Quantity" maxlength="3" /><span class="exception"><?php echo $pstockErr; ?></span></div>
<div class="form-group"><label for="product-image">Product Image</label><input type="file" name="image" /><span class="exception"><?php echo $pimageErr; ?></span></div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-primary btn-lg pull-right" type="submit" name="addproduct" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add Product</button>
</form>
</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
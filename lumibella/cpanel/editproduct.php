<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateUpdateProduct.php');
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
$pupdatestatus = 'Status message will be displayed here';
//get valuese from html form
if(isset($_REQUEST['updateproduct'])){
$pid = trim($_REQUEST['prodid']);
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
$size_limit = '2000000';
$target = "../images/products/$psection/$pcategory/$psubcategory/$pid.jpg";
$file_type = $_FILES['image']['type'];
//create class and objects
$validateUpdateProduct = new validateUpdateProduct();
$validateName = $validateUpdateProduct->validateName($pname);
$validateSection = $validateUpdateProduct->validateSection($psection);
$validateCategory = $validateUpdateProduct->validateCategory($pcategory);
$validateSubcategory = $validateUpdateProduct->validateSubcategory($psubcategory);
$validateBrand = $validateUpdateProduct->validateBrand($pbrand);
$validateDescription = $validateUpdateProduct->validateDescription($pdescription);
$validatePrice = $validateUpdateProduct->validatePrice($pprice);
$validateStock = $validateUpdateProduct->validateStock($pstock);
$getCategoryID = $validateUpdateProduct->getCategoryID($psection,$pcategory,$psubcategory);
$getBrandID = $validateUpdateProduct->getBrandID($pbrand);
//check if objects are true and add product
if($validateName == false){
$pnameErr = $validateUpdateProduct->pnameErr();
}
if($validateSection == false){
$psectionErr = $validateUpdateProduct->psectionErr();
}
if($validateCategory == false){
$pcategoryErr = $validateUpdateProduct->pcategoryErr();
}
if($validateSubcategory == false){
$psubcatErr = $validateUpdateProduct->psubcatErr();
}
if($validateBrand == false){
$pbrandErr = $validateUpdateProduct->pbrandErr();
}
if($validateDescription == false){
$pdescErr = $validateUpdateProduct->pdescErr();
}
if($validatePrice == false){
$ppriceErr = $validateUpdateProduct->ppriceErr();
}
if($validateStock == false){
$pstockErr = $validateUpdateProduct->pstockErr();
}
$validateProductImage = new validateProductImage();
$addImage = $validateProductImage->validateImageUpload($pid,$psection,$pcategory,$psubcategory,$file_size,$size_limit,$source,$target,$file_type);
if($addImage == false){
$pimageErr = $validateProductImage->imageError();
}
if($validateName !== false && $validateSection !== false && $validateCategory !== false && $validateSubcategory !== false && $validateDescription !== false &&$validatePrice !== false && $validateStock !== false && $addImage !== false){
$updateProduct = $validateUpdateProduct->updateProduct($pid,$pname,$getCategoryID,$pdescription,$getBrandID,$pprice,$pstock,$imgpath,$imgthumbpath);
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
<?php
if(isset($_GET['pid'])){
$proid = $_GET['pid'];
$prodet = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$prodet->execute(array("pid"=>$proid));
while($rowdet = $prodet->fetch()){
$pdid = $rowdet['pid'];
$pdname = $rowdet['pname'];
$pdcat = $rowdet['pcategory'];
$getcatdet = $pdo->prepare("SELECT * FROM categories WHERE categoryid=:catid");
$getcatdet->execute(array("catid"=>$pdcat));
$gcval = $getcatdet->fetch();
$gcsection = $gcval['section'];
$gccat = $gcval['category'];
$gcsubcat = $gcval['subcategory'];
$pddesc = stripslashes($rowdet['pdescription']);
$pdbrand = $rowdet['pbrand'];
$getbranddet = $pdo->prepare("SELECT * FROM brands WHERE brandid=:brandid");
$getbranddet->execute(array("brandid"=>$pdbrand));
$gbdet = $getbranddet->fetch();
$gbname = $gbdet['brandname'];
$pdprice = $rowdet['pprice'];
$getstockq = $pdo->prepare("SELECT * FROM stocks WHERE pid=:sid");
$getstockq->execute(array("sid"=>$pdid));
$gsqrow = $getstockq->fetch();
$pdstock = $gsqrow['quantity'];
$pddimage = $rowdet['pimage'];
$pddate = $rowdet['created'];
$pdimage = "../images/products/$gcsection/$gccat/$gcsubcat/thumbs/$pdid.jpg";
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
<?php include('header.php'); ?>
<div class="row content">
<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Edit Product</h4>
<hr>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<div class="customerRegister"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $pupdatestatus; ?></div></div>
<form action="editproduct.php?pid=<?php echo $proid; ?>" method="POST" enctype="multipart/form-data" name="productdetail">
<div class="form-group"><label for="product-name">Product Name</label>
<input type="text" name="pname" value="<?php echo $pdname; ?>" class="form-control" placeholder="Enter Product Name" /><span class="exception"><?php echo $pnameErr; ?></span></div>

<div class="form-group"><label for="product-section">Product Section</label>
<select class="form-control" name="psection">
<option value="<?php echo $gcsection; ?>"><?php echo $gcsection; ?></option><hr>
<?php
$selectsec = $pdo->prepare("SELECT DISTINCT section FROM categories WHERE section != :skipsec ORDER BY section");
$selectsec->execute(array("skipsec"=>$gcsection));
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
<option value="<?php echo $gccat; ?>"><?php echo $gccat; ?></option><hr>
<?php
$selectcat = $pdo->prepare("SELECT DISTINCT category FROM categories WHERE category != :skipcat ORDER BY category");
$selectcat->execute(array("skipcat"=>$gccat));
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

<div class="form-group"><label for="product-category">Product Subcategory</label>
<select class="form-control" name="psubcategory">
<option value="<?php echo $gcsubcat; ?>"><?php echo $gcsubcat; ?></option>
<?php
$selectsubcat = $pdo->prepare("SELECT DISTINCT subcategory FROM categories WHERE subcategory != :skipsubcat ORDER BY subcategory");
$selectsubcat->execute(array("skipsubcat"=>$gcsubcat));
while($subc = $selectsubcat->fetch()){
$subcatname = $subc['subcategory'];
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
<option value="<?php echo $gbname; ?>"><?php echo $gbname; ?></option>
<?php
$selectbrand = $pdo->prepare("SELECT * FROM brands WHERE brandname != :skipbrand ORDER BY brandname");
$selectbrand->execute(array("skipbrand"=>$gbname));
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

<div class="form-group"><label for="product-name">Product Price (INR)</label><div class='input-group'><span class='input-group-addon'>Rs.</span>
<input type="text" name="pprice" value="<?php echo $pdprice; ?>" class="form-control" placeholder="Enter Product Price" /></div><span class="exception"><?php echo $ppriceErr; ?></span></div>

<div class="form-group"><label for="product-name">Product Stock</label><input type="text" name="pstock" value="<?php echo $pdstock; ?>" class="form-control" placeholder="Enter Stock Quantity" /><span class="exception"><?php echo $pstockErr; ?></span></div>

<div class="form-group"><label for="product-description">Product Description</label><textarea class="form-control" id="description" name="pdescription"><?php echo $pddesc; ?></textarea><span class="exception"><?php echo $pdescErr; ?></span></div>
</div>
<div class="col-md-6 col-lg-6"><img src="<?php echo $pdimage; ?>" class="img-responsive" /><br />
<div class="form-group"><label for="product-image">Update Image (Optional)</label><input type="file" name="image" /><span class="exception"><?php echo $pimageErr; ?></span></div>
</div>
</div>
<div class="row">
<div class="col-md-12 col-lg-12">
<input type="hidden" value="<?php echo $proid; ?>" name="prodid" />
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-primary btn-lg pull-right" type="submit" name="updateproduct" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Update Product</button>
</form>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
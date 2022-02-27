<?php
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Fashions</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>
<div class="row content animsition fade-in-down">
<div class="col-md-12 col-lg-12">
<?php
if(isset($_GET['category'])){
$i = '';
$setbrand = '';
$setmultibrand = '';
$setprice = '';
$where = '';
$orderby = '';
if(isset($_REQUEST['getbrand'])){
$brandcount = count($_REQUEST['getbrand']);
if($brandcount == 1){
$setbrand .= "AND pbrand='" . $_REQUEST['getbrand'][0] . "'";
}
else{
for($i=1;$i<$brandcount;$i++){
$setmultibrand .= " OR pbrand='" . $_REQUEST['getbrand'][$i] . "'";
}
$setbrand .= "AND (pbrand='" . $_REQUEST['getbrand'][0] . "'" . $setmultibrand . ")";
}
}
if(isset($_REQUEST['getprice'])){
$setprice .= "AND (pprice " . str_replace("_"," ",$_REQUEST['getprice']) . ")";
}
$where .= $setbrand . " " . $setprice;
if(isset($_REQUEST['getsort'])){
$orderby = "ORDER BY " . str_replace("_"," ",$_REQUEST['getsort']);
}
$where .= $setbrand . " " . $setprice;
$sec = $_GET['section'];
$cat = $_GET['category'];
$subcat = $_GET['subcategory'];
$checkcat = $pdo->prepare("SELECT * FROM categories WHERE section=:section AND category=:category AND subcategory=:subcategory");
$checkcat->execute(array(
				"section"=>$sec,
				"category"=>$cat,
				"subcategory"=>$subcat
				));
$ccget = $checkcat->fetch();
$ccid = $ccget['categoryid'];
echo "<div class='row'>";
echo "<div class='col-md-12 col-lg-12'>";
echo "<h4 class='heading product-heading'>" . $sec . " " . $cat . " - " . $subcat . "</h4><hr>";
echo "</div>";
echo "</div>";
?>
<div class="row">
<div class="col-md-2 col-lg-2 filters">
<h5 class='filter-heading'>Filters</h5>
<hr>
<?php
echo "<form action='products.php' method='GET'>";
echo "<h4>Choose Brand</h4>";
$selbrand = $pdo->prepare("SELECT * FROM brands");
$selbrand->execute();
while($selb = $selbrand->fetch()){
$selbid = $selb['brandid'];
$selbname = $selb['brandname'];
echo "<input type='checkbox' name='getbrand[]' value='" . $selbid . "' /><label>" . $selbname . "</label><br />";
}
echo "<h4>Price Range</h4>";
echo "<input type='radio' name='getprice' value='>_5000' /><label>Above Rs.5000</label><br />";
echo "<input type='radio' name='getprice' value='BETWEEN_2000_AND_5000' /><label>Rs.2000 to Rs.5000</label><br />";
echo "<input type='radio' name='getprice' value='BETWEEN_1000_AND_2000' /><label>Rs.1000 to Rs.2000</label><br />";
echo "<input type='radio' name='getprice' value='BETWEEN_500_AND_1000' /><label>Rs.500 to Rs.1000</label><br />";
echo "<input type='radio' name='getprice' value='<_500' /><label>Below Rs.500</label><br />";
echo "<h4>Sort Type</h4>";
echo "<input type='radio' name='getsort' value='created_DESC' /><label>Latest</label><br />";
echo "<input type='radio' name='getsort' value='pname_ASC' /><label>Name A-Z</label><br />";
echo "<input type='radio' name='getsort' value='pprice_DESC' /><label>High to Low Price</label><br />";
echo "<input type='radio' name='getsort' value='pprice_ASC' /><label>Low to High Price</label><br />";
echo "<input type='hidden' name='section' value='$sec' /><br />";
echo "<input type='hidden' name='category' value='$cat' /><br />";
echo "<input type='hidden' name='subcategory' value='$subcat' /><br />";
echo "<input class='btn btn-primary btn-sm apply-filter' type='submit' name='filter' value='Apply Filter' />";
echo "</form>";
?>
</div>
<div class="col-md-10 col-lg-10">

<!-- carousel begin -->
<?php 
$carouselpath = "images/carousel/$sec/$cat/";
if(file_exists($carouselpath)){
?>
<div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
</ol>
<div class="carousel-inner">
<div class="item active">
<img src="images/carousel/<?php echo $sec; ?>/<?php echo $cat; ?>/1.jpg" alt="Slide One" />
</div>
<div class="item">
<img src="images/carousel/<?php echo $sec; ?>/<?php echo $cat; ?>/2.jpg" alt="Slide Two" />
</div>
</div>
<a class="carousel-control left" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="carousel-control right" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
<?php
}
?>

<!-- carousel end -->

<?php
$perpage = 9;
$procount = $pdo->prepare("SELECT * FROM products WHERE pcategory=:pcategory $where");
$procount->execute(array("pcategory"=>$ccid));
$pages = ceil($procount->rowCount() / $perpage);
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$start = ($page - 1) * $perpage;
$getcatproducts = $pdo->prepare("SELECT * FROM products WHERE pcategory=:pcategory $where $orderby LIMIT $start, $perpage");
$getcatproducts->execute(array("pcategory"=>$ccid));
if($getcatproducts->rowCount() == 0){
echo "<div class='no-product'><img class='img-responsive' src='images/contents/no-product.png' /><h2>No products available in $cat - $subcat section</h2></div>";
}
else{
while($gprow = $getcatproducts->fetch()){
$gpid = $gprow['pid'];
$gpname = $gprow['pname'];
$gpcategory = $gprow['pcategory'];
$gpdesc = $gprow['pdescription'];
$gpprice = $gprow['pprice'];
$gpimage = $gprow['pimage'];
$gpthumb = $gprow['pthumb'];
echo "<div class='col-md-4 col-lg-4 product-block'>";
echo "<div class='product col-md-12 col-lg-12'>";
echo "<div class='row'><div class='col-md-12 col-lg-12'><img src='$gpthumb' class='img-responsive product-image' /></div></div>";
echo "<div class='row'><div class='col-md-12 col-lg-12'><h4>$gpname</h4><p>$gpdesc</p></div></div>";
echo "<div class='row'>";

$getrate = $pdo->prepare("SELECT * FROM ratings WHERE pid=:rid");
$getrate->execute(array("rid"=>$gpid));
while($gpr = $getrate->fetch()){
$grpid = $gpr['pid'];
$grate = $gpr['rtotal'];
$grc = $gpr['rcount'];
$rate = $grate/$grc;
$roundrate = round($rate,1);

echo "<div class='col-md-6 col-lg-6 rate-label'>Rating: " . $roundrate . "/5";
if($roundrate == 1){ echo "<img src='images/contents/stars/1.png' class='img-responsive rate-star' />"; }
elseif($roundrate > 1 && $roundrate < 2){ echo "<img src='images/contents/stars/1-5.png' class='img-responsive rate-star' />"; }
elseif($roundrate == 2){ echo "<img src='images/contents/stars/2.png' class='img-responsive rate-star' />"; }
elseif($roundrate > 2 && $roundrate < 3){ echo "<img src='images/contents/stars/2-5.png' class='img-responsive rate-star' />"; }
elseif($roundrate == 3){ echo "<img src='images/contents/stars/3.png' class='img-responsive rate-star' />"; }
elseif($roundrate > 3 && $roundrate < 4){ echo "<img src='images/contents/stars/3-5.png' class='img-responsive rate-star' />"; }
elseif($roundrate == 4){ echo "<img src='images/contents/stars/4.png' class='img-responsive rate-star' />"; }
elseif($roundrate > 4 && $roundrate < 5){ echo "<img src='images/contents/stars/4-5.png' class='img-responsive rate-star' />"; }
elseif($roundrate == 5){ echo "<img src='images/contents/stars/5.png' class='img-responsive rate-star' />"; }
echo "</div>";
echo "<div class='col-md-4 col-lg-4 product-price pull-right'><h5><span>Rs. </span>$gpprice</h5></div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col-md-12 col-lg-12'>";
if(!isset($_SESSION['customer'])){
echo "";
}
else{
$checkrateuser = $pdo->prepare("SELECT * FROM rateduser WHERE cid=:cid AND pid=:pid");
$checkrateuser->execute(array(
						"cid"=>$_SESSION['customer'],
						"pid"=>$grpid
						));
$cru = $checkrateuser->fetch();
$crurate = $cru['rateval'];
if($checkrateuser->rowCount() == 1){
echo "<div class='col-md-5 col-lg-5 user-rate'>You Rated:<br /><h5>" . $crurate ."</h5></div>";
}
else{
echo "<form id='rate' action='#'><div class='col-md-4 col-lg-4 form-group'><label for='product-rate'>Rate:</label>";
echo "<select class='form-control rate-select' name='prate'>";
echo "<option value='1'>1</option>";
echo "<option value='2'>2</option>";
echo "<option value='3'>3</option>";
echo "<option value='4'>4</option>";
echo "<option value='5'>5</option>";
echo "</select>";
echo "<input type='hidden' name='prid' value='".$grpid."'>";
echo "<input type='hidden' name='prtot' value='".$grate."'>";
echo "<input type='hidden' name='prcnt' value='".$grc."'>";
echo "<input class='btn btn-primary btn-sm product-button pull-right' type='button' id='rate' name='submit' value='Rate' onclick='loadRate(prate.value, prid.value, prtot.value, prcnt.value); this.disabled=true;' />";
echo "</form>";
echo "<div id='rateRes'></div>";
echo "</div>";
}
}

$checkstock = $pdo->prepare("SELECT quantity FROM stocks WHERE pid=:id");
$checkstock->execute(array("id"=>$gpid));
$cs = $checkstock->fetch();
$quantity = $cs['quantity'];
if($quantity == 0 || $quantity < 0){
echo "<div class='col-md-4 col-lg-4 pull-right stock-alert'><span class='glyphicon glyphicon-exclamation-sign'></span> Sold Out</div>";
}
else{
echo "<div class='col-md-3 col-lg-3 add-cart pull-right'>";
echo "<form id='cart' action=''>";
echo "<label for='addtocart'>Quantity:</label>";
echo "<input type='text' id='qnty'" . $gpid ." name='cqnty' maxlength='3' class='form-control' />";
echo "<input type='hidden' name='cpid' value='".$gpid."' />";
echo "<input type='hidden' name='cpstock' value='".$quantity."' />";
echo "<input class='btn btn-primary btn-sm product-button pull-right' type='button' id='fbtn'" . $gpid ." name='addtocart' value='Add to Cart' onclick='validateCart(cpid.value, Number(cqnty.value), cpstock.value); this.disabled=true; cqnty.disabled=true;'/>";
echo "</form>";
echo "</div>";
}
echo "</div>";
echo "</div>";

echo "<div class='row'>";
echo "<div class='col-md-12 col-lg-12'>";
echo "<div class='qalert pull-right' id='qalert" . $gpid . "'></div>";
echo "</div></div>";
echo "</div>";
echo "</div>";
}
}
echo "<div class='row'><div class='col-md-12 col-lg-12'>";
echo "<h4 class='paginate-head'>Browse: </h4><ul class='pagination'>";
if($pages>=1 && $page<=$pages){
for($x = 1; $x <= $pages ; $x++){
echo ($x == $page) ? "<li><a id='selected' href='" . $_SERVER['REQUEST_URI'] . "&page=$x'>$x</a> </li>" : "<li><a id='notselected' href='" . $_SERVER['REQUEST_URI'] . "&page=$x'>$x</a> </li>";
}
}
echo "</ul></div></div>";
}
}
?>
</div>
</div>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/loadFunction.js"></script>
<script src="js/countcart.js"></script>
<script type="text/javascript">
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;
</script>
</body>
</html>
<?php
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">Search Result</h4>
<hr>
<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
<?php
if(isset($_POST['search'])){
$keyword = $_POST['keyword'];
echo "<h4 class='checkout-heading'>Showing search result for keyword <b>'" . $keyword . "'</b></h4>";
if(empty($keyword)){
echo "<div class='alert alert-info'>No keyword was given. Try again with a keyword</div>";
}
else{
$searchkey = $pdo->prepare("SELECT * FROM products WHERE pname LIKE '%$keyword%'");
$searchkey->execute();
if($searchkey->rowCount() == 0){
echo "<div class='alert alert-info'>No products found for keyword - $keyword</div>";
}
else{
while($gprow = $searchkey->fetch()){
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
echo "<form id='cart' action='#'>";
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
}
}
}
?>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/loadFunction.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
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
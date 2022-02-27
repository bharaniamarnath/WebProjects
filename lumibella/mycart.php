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
<h4 class="heading">My Cart</h4>
<hr>
<div class="col-md-12 col-lg-12">
<?php
if(isset($_POST['clearcart'])){
unset($_SESSION['cart']);
}
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
	echo "<div class='empty-cart'><img class='img-responsive' src='images/contents/empty-cart.png' /><h2>There are no items in the cart</h2><center><a href='mycart.php' class='btn btn-primary'>Reload Cart</a></center></div>";
}
else{
	$max = count($_SESSION['cart']);
	$qemsg = "";
	if(isset($_REQUEST['qerr'])){
		$qerror = $_REQUEST['qerr'];
		$errpid = $_REQUEST['errpid'];
		if($qerror == 0){
			$qemsg = "Ok";
		}
		if($qerror == 1){
			$qemsg = "Invalid quantity";
		}
		if($qerror == 2){
			$qemsg = "Invalid quantity";
		}
		if($qerror == 3){
			$qemsg = "Stock limit exceeded";
		}
		if($qerror == 4){
			$qemsg = "Invalid quantity";
		}
	}
	echo "<table class='table cart-table'>";
	echo "<tr><thead><th colspan='2'>Product</th><th>Quantity</th><th>Update Quantity</th><th>Availability</th><th>Price</th><th>Total Price</th><th colspan='2'>Action</th></thead></tr>";
	for($i=0;$i<$max;$i++){
		$pid = $_SESSION['cart'][$i]['pid'];
		$pqty = $_SESSION['cart'][$i]['pq'];
		$getname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
		$getname->execute(array("id"=>$pid));
		$checkstock = $pdo->prepare("SELECT quantity FROM stocks WHERE pid=:id");
		$checkstock->execute(array("id"=>$pid));
		$cs = $checkstock->fetch();
		$quantity = $cs['quantity'];
		$gnrow = $getname->fetch();
		$pname = $gnrow['pname'];
		$price = $gnrow['pprice'];
		$pthumb = $gnrow['pthumb'];
		$tprice = number_format((float)($price * $pqty),2,'.','');
		echo "<tr><td><img class='img-responsive cart-image' src='" . $pthumb . "' /></td>";
		echo "<td>" . $pname . "</td>";
		echo "<form action='#' id='cart'><td>";
		echo "<div class='col-md-4 col-lg-4'><input type='text' name='cqnty' id='cqnty' maxlength='2' class='form-control' value='" . $pqty . "' /></div></td>";
		echo "<td>";
		echo "<input type='hidden' name='cpid' value='".$pid."' />";
		echo "<input type='hidden' name='cpstock' value='".$quantity."' />";
		echo "<input class='btn btn-primary btn-sm update-quantity' type='button' id='fbtn'" . $pid ." name='updatequant' value='Update' onclick='validateUpdateCart(cpid.value, cqnty.value, cpstock.value); this.disabled=false; cqnty.disabled=false;' />";
		echo "</td></form>";
		echo "<td><span class='qalert' id='qalert" . $pid . "'></span></td>";
		echo "<td>Rs." . $price . "</td><td>Rs." . $tprice . "</td>";
		echo "<td><form action='removecart.php' method='POST'><input type='hidden' value='" . $pid .  "' name='remid'><input class='btn btn-primary btn-sm' type='submit' value='remove' name='remove' /></form></td>";
		echo "</tr>";		
	}
	$sum=0;
	for($i=0;$i<$max;$i++){
		$tpid = $_SESSION['cart'][$i]['pid'];
		$tpq = $_SESSION['cart'][$i]['pq'];
		$getprice = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
		$getprice->execute(array("id"=>$tpid));
		$gtrow = $getprice->fetch();
		$totalprice = $gtrow['pprice'];
		$sum += $totalprice * $tpq;
	}
	$tamount = number_format((float)$sum,2,'.','');
	echo "<tr><td colspan='5'></td><td id='tamount'>Total Amount</td><td id='tamount'>Rs." . $tamount . "</td>";
	echo "<td><form action='mycart.php' method='POST'><input type='submit' class='btn btn-primary btn-sm' name='clearcart' value='Clear Cart' /></form></td></tr>";
	echo "<tr><td><a class='btn btn-primary pull-right' href='javascript:history.go(0)'>Reload Cart</a></td>";
	echo "<td colspan='6'></td><td><a href='checkout.php' class='btn btn-primary btn-lg'>Check Out</a></td></tr>";
	echo "</table>";
}
?>
</div>
<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
<h3 class="heading">Products you may like</h3>
<hr>
<div id="likeCarousel" class="carousel slide hidden-xs" data-ride="carousel" data-interval="false">
<div class="carousel-inner">
<div class="item active">
<?php
$getcatproducts = $pdo->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 3");
$getcatproducts->execute();
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
?>
</div>
<?php for($i=0;$i<2;$i++){ ?>
<div class="item">
<?php
$getcatproducts = $pdo->prepare("SELECT * FROM products ORDER BY RAND() LIMIT 3");
$getcatproducts->execute();
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
?>
</div>
<?php } ?>
</div>
<a class="carousel-control left" href="#likeCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
<a class="carousel-control right" href="#likeCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>
</div>
</div>
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
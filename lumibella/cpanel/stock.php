<?php
ob_start();
session_start();
include('includes/connect.php');
include('includes/validateDeleteProduct.php');
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
<h4 class="heading">Manage Stock</h4>
<hr>
</div>
</div>

<div class="row">
<div class="col-md-12 col-lg-12">
<table class="table cart-table">
<tr><thead><th>Stock Details</th></thead></tr>
<?php
$empty = 0;
$getstockcnt = $pdo->prepare("SELECT * FROM stocks");
$getstockcnt->execute();
$getzstockcnt = $pdo->prepare("SELECT * FROM stocks WHERE quantity=:empty");
$getzstockcnt->execute(array("empty"=>$empty));
$getavstockcnt = $pdo->prepare("SELECT * FROM stocks WHERE NOT quantity=:empty");
$getavstockcnt->execute(array("empty"=>$empty));
$gsc = $getstockcnt->rowCount();
$gzsc = $getzstockcnt->rowCount();
$gavsc = $getavstockcnt->rowCount();
echo "<tr><td>Total Products in Stock: " . $gsc . "</td></tr>";
echo "<tr><td>Total Products Out of Stock: " . $gzsc . "</td></tr>";
echo "<tr><td>Total Products Available in Stock: " . $gavsc . "</td></tr>";
?>
</table>
<h4 class="checkout-heading">Out of Stock</h4>
<?php
$empty = 0;
$getstock = $pdo->prepare("SELECT * FROM stocks WHERE quantity=:empty");
$getstock->execute(array("empty"=>$empty));
echo "<table class='table cart-table'>";
if($getstock->rowCount() == 0){
echo "<tr><thead><th>No out of stock products</th></thead></tr>";
}
else{
echo "<tr><thead><th>Product Name</th><th>Current Stock</th><th>Last Updated On</th><th>Update Stock</th></thead></tr>";
while($gsrow = $getstock->fetch()){
$pid = $gsrow['pid'];
$pstock = $gsrow['quantity'];
$pdate = $gsrow['updated'];
$getpdet = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$getpdet->execute(array("pid"=>$pid));
$gpdrow = $getpdet->fetch();
$gpdname = $gpdrow['pname'];
echo "<tr><td>" . $gpdname . "</td><td>" . $pstock . "</td><td>" . $pdate . "</td>";
echo "<td>";
echo "<form id='stock' action=''>";
echo "<div class='col-md-5 col-lg-5 input-group'><span class='input-group-addon'>" . $pstock . " + </span><input class='form-control' type='text' name='stockamt' maxlength='3' />";
echo "<input type='hidden' name='stockpid' value='$pid' />";
echo "<span class='input-group-btn'><input class='btn btn-primary' type='button' name='updatestock' value='Update Stock'  onclick='validateStock(stockpid.value, stockamt.value);' /></span></div>";
echo "<span><div class='qalert' id='qalert" . $pid . "'></div></span></td>";
echo "</form>";
echo "</td>";
echo "</tr>";
}
}
echo "</table>";
?>
</div>
</div>

<div class="row">
<div class="col-md-12 col-lg-12">
<h4 class="checkout-heading">Available Stock</h4>
<?php
$empty = 0;
$getavstock = $pdo->prepare("SELECT * FROM stocks WHERE NOT quantity=:empty ORDER BY quantity DESC");
$getavstock->execute(array("empty"=>$empty));
echo "<table class='table cart-table'>";
echo "<tr><thead><th>Product Name</th><th>Current Stock</th><th>Last Updated On</th><th>Update Stock</th></thead></tr>";
while($gsrow = $getavstock->fetch()){
$pid = $gsrow['pid'];
$pstock = $gsrow['quantity'];
$pdate = $gsrow['updated'];
$getpdet = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
$getpdet->execute(array("pid"=>$pid));
$gpdrow = $getpdet->fetch();
$gpdname = $gpdrow['pname'];
echo "<tr><td>" . $gpdname . "</td><td>" . $pstock . "</td><td>" . $pdate . "</td>";
echo "<td>";
echo "<form id='allstockform' action=''>";
echo "<div class='col-md-5 col-lg-5 input-group'><span class='input-group-addon'>" . $pstock . " + </span><input class='form-control' type='text' name='allstockamt' maxlength='3' />";
echo "<input type='hidden' name='allstockpid' value='$pid' />";
echo "<span class='input-group-btn'><input class='btn btn-primary' type='button' name='updatestock' value='Update Stock' onclick='validateStock(allstockpid.value, Number(allstockamt.value));' /></span></div>";
echo "</div>";
echo "<span><div class='qalert' id='qalert" . $pid . "'></div></span></td>";
echo "</form>";
echo "</td>";
echo "</tr>";
}
echo "</table>";
?>
</div>
</div>

</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/updatestock.js"></script>
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
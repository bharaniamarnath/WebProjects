<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store-Order-<?php echo $_REQUEST['billid']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class='plain-background'>
<div class="row content">
<div class="row">
<div class="col-md-8 col-lg-8 bill-header">
<img src="images/logo/bill-logo.png" class="img-responsive bill-logo">
</div>
<div class="col-md-4 col-lg-4 bill-header">
<p><b>Lumibella Fashions,</b><br /> No.1, 1st Street, Velachery, Chennai, Tamilnadu, India<br /><b>Website:</b> www.lumibellastore.com<br /><b>Email:</b> lumibellastore@gmail.com<br /><b>Phone:</b> 9876543210</p>
</div>
</div>
<div class="row">
<div class="col-md-12 col-lg-12 bill-page">
<div class="row">
<div class="col-md-6 col-lg-6">
<?php
if(isset($_REQUEST['getbill'])){
$oid = $_REQUEST['billid'];
$genoid = "LBO" . $oid;
$delivered = 1;
$setstatus = $pdo->prepare("UPDATE orders SET status=:status WHERE orderid=:oid");
$setstatus->execute(array(
					"status"=>$delivered,
					"oid"=>$oid
					));
echo "<table class='table bill-table'>";
echo "<tr><thead><th colspan='2'>Order Summary</th></thead></tr>";
$getamount = $pdo->prepare("SELECT SUM(price) AS tamount, SUM(quantity) AS tqnty FROM orderdetail WHERE orderid=:aoid");
$getamount->execute(array("aoid"=>$oid));
$gares = $getamount->fetch();
$tamount = $gares['tamount'];
$tqnty = $gares['tqnty'];
$getdate = $pdo->prepare("SELECT added FROM orders WHERE orderid=:oid");
$getdate->execute(array("oid"=>$oid));
$gdfetch = $getdate->fetch();
$ddate = date('Y-m-d',strtotime(date("Y-m-d H:i:s")));
$gdate = date('Y-m-d',strtotime($gdfetch['added']));
$deltime = ceil(abs(strtotime($ddate) - strtotime($gdate))/86400);
echo "<tr><td>Order ID:</td><td>" . $genoid . "</td></tr>";
echo "<tr><td>Total Quantity Products:</td><td>" . $tqnty . "</td></tr>";
echo "<tr><td>Total Cash Amount Payable:</td><td>Rs. " . $tamount . "</td></tr>";
echo "<tr><td>Payment Method:</td><td>CASH ON DELIVERY</td></tr>";
echo "<tr><td>Order Date:</td><td>" . $gdate ."</td></tr>";
echo "<tr><td>Invoice Date:</td><td>" . $ddate ."</td></tr>";
echo "<tr><td>Delivery Time:</td><td>" . $deltime . " Day(s)</td></tr>";
echo "</table>";
?>
</div>
<div class="col-md-6 col-lg-6">
<?php
$orderaddr = $pdo->prepare("SELECT * FROM orderdelivery WHERE orderid=:doid");
$orderaddr->execute(array("doid"=>$oid));
$goaddr = $orderaddr->fetch();
$goname = $goaddr['name'];
$goaddress = $goaddr['address'];
$gophone = $goaddr['phone'];
$goemail = $goaddr['email'];
$gopincode = $goaddr['pincode'];
echo "<table class='table bill-table'>";
echo "<tr><thead><th colspan='2'>Shipping Address</th></thead></tr>";
echo "<tr><td>Customer Name:</td><td>" . $goname ."</tr>";
echo "<tr><td>Delivery Address:</td><td>" . $goaddress ."</tr>";
echo "<tr><td>Contact Phone/Mobile:</td><td>" . $gophone ."</tr>";
echo "<tr><td>Contact Email:</td><td>" . $goemail ."</tr>";
echo "<tr><td>Location Pincode:</td><td>" . $gopincode ."</tr>";
echo "</table>";
}
?>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<?php
$getod = $pdo->prepare("SELECT * FROM orderdetail WHERE orderid=:oid");
$getod->execute(array(
				"oid"=>$oid
				));
echo "<table class='table bill-table'>";
echo "<tr><thead><th colspan='3'>Product Summary</th></thead></tr>";
echo "<tr><thead><th>Product</th><th>Quantity</th><th>Price</th></thead></tr>";
while($godet = $getod->fetch()){
$proid = $godet['productid'];
$qnty = $godet['quantity'];
$price = $godet['price'];
$getproname = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
$getproname->execute(array("id"=>$proid));
while($gnrow = $getproname->fetch()){
$pname = $gnrow['pname'];
echo "<tr><td>" . $pname . "</td><td>" . $qnty . "</td><td>Rs. " . $price . "</td></tr>";
}
}
echo "<tr><th colspan='2'>Grand Total:</th><th>Rs. " . $tamount . "</th></tr>";
echo "</table>";
?>
</div>
<div class="col-md-6 col-lg-6">
<?php
$enurl = urlencode('http://localhost/lumibella/viewpurchase.php?viewpid='.$oid);
?>
<table class='table qr-table'>
<tr><td><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=$enurl&choe=UTF-8"  /></td><td><p>Use this QR code to view this order purchase details online in our website</p></td></tr>
</table>
</div>
</div>
<div class="bill-footer">
<p>This is a computer generated invoice. No signature required.</p>
<p>Contact us for more details</p>
<p>Lumibella Fashions, Velachery, Chennai.&nbsp; Website: www.lumibellastore.com &nbsp; Phone: 9876543210</p>
</div>
</div>
</div>
</div>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
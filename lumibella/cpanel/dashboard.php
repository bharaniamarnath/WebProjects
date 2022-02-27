<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['admin'])){
header("Location: index.php");
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
<h4 class="heading">Lumibella Dashboard</h4>
<hr>
</div>
</div>

<div class="row dash-menu">

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>View Orders</h4>
<?php
$neworders = $pdo->prepare("SELECT * FROM orders WHERE added BETWEEN concat(date(date_sub(now(),interval 1 day)),' 16:30:00') AND concat(date(now()),' 16:30:00')");
$neworders->execute();
$countorders = $neworders->rowCount();
if($countorders == 0){
echo "<p>No orders available today</p>";
}
else if($countorders == 1){
echo "<p><b>" . $countorders . "</b> new order</p>";
}
else{
echo "<p><b>" . $countorders . "</b> new orders</p>";
}
?>

<a class="btn btn-primary pull-right" href="orderlist.php" role="button">View Orders</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Add new product</h4>
<p>Add a new product to the database</p>
<a class="btn btn-primary pull-right" href="newproduct.php" role="button">Add Product</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Edit product</h4>
<p>Edit or modify an existing product in the database</p>
<a class="btn btn-primary pull-right" href="editlist.php" role="button">Edit Product</a>
</div>
</div>

</div>

<div class="row dash-menu">

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Enquiries</h4>
<p>View and manage enquiries sent by the customers</p>
<a class="btn btn-primary pull-right" href="enquiries.php" role="button">View Enquiries</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Add Category</h4>
<p>Add product categories</p>
<a class="btn btn-primary pull-right" href="newcategory.php" role="button">Add Category</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Add Message</h4>
<p>Add new message or news for customers</p>
<a class="btn btn-primary pull-right" href="newmessage.php" role="button">Add Message</a>
</div>
</div>

</div>

<div class="row dash-menu">

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Stock Update</h4>
<?php
$empty = 0;
$getstock = $pdo->prepare("SELECT * FROM stocks WHERE quantity=:empty");
$getstock->execute(array("empty"=>$empty));
$countstock = $getstock->rowCount();
?>
<p><b><?php echo $countstock; ?></b> products are out of stock</p>
<a class="btn btn-primary pull-right" href="stock.php" role="button">Manage stock</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Add Brand</h4>
<p>Add product brand</p>
<a class="btn btn-primary pull-right" href="newbrand.php" role="button">Add Brand</a>
</div>
</div>

<div class="col-md-4 col-lg-4">
<div class="dash-holder">
<h4>Account</h4>
<p">Website administrator page control</p>
<a class="btn btn-primary pull-right" href="clogout.php" role="button"><span class="glyphicon glyphicon-off"></span> Log Out</a>
<a class="btn btn-primary pull-right" href="account.php" role="button" style="margin-right:10px;">Change Credentials</a>
</div>
</div>

</div>

</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
$(".loader").fadeOut("slow");
});
</script>
</body>
</html>
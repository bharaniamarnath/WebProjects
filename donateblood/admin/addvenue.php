<?php
include('includes/connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Blood Donation Management Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12">
<?php
include('includes/header.php');
?>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<h2>Add Venue</h2>
<?php
if(isset($_POST['submit'])){
if(empty($_POST['vphone']) || empty($_POST['vaddress']) || empty($_POST['vpin']) || empty($_POST['vstate']) || empty($_POST['vcity'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields require valid information</div>";
}
if(!is_numeric($_POST['vphone'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Contact Number can contain only numbers</div>";
}
if(strlen($_POST['vphone'])>10 || strlen($_POST['vphone'])<10){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Contact number can only be in 10 digit format</div>";
}
if(strlen($_POST['vaddress']) > 1024){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enquiry is too long. Only 1024 characters taken.</div>";
}
if(!is_numeric($_POST['vpin'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Pin Code can contain only numbers</div>";
}
if(strlen($_POST['vpin']) > 6){
	echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Pincode should not exceed 6 digits</div>";
}
else{
$vid = rand(000000,999999);
$vpin = $_POST['vpin'];
$vcity = $_POST['vcity'];
$vstate = $_POST['vstate'];
$vphone = $_POST['vphone'];
$vaddress = $_POST['vaddress']; 

$insfeed = $pdo->prepare("INSERT INTO venues (vid,vaddr,vcity,vstate,vpin,vcon) VALUES (:vid,:vaddr,:vcity,:vstate,:vpin,:vcon)");
$insfeed->execute(array(
				"vid"=>$vid,
				"vaddr"=>$vaddress,
				"vcity"=>$vcity,
				"vstate"=>$vstate,
				"vpin"=>$vpin,
				"vcon"=>$vphone
				));

if($insfeed){
echo "<div class='alert alert-danger'>Venue added successfully</div>";
echo "<a href='dashboard.php'>Go to Index</a>";
exit();
}
else{
echo "<div class='alert alert-danger'>Error adding venue. Try again later</div>";
echo "<a href='dashboard.php'>Go to Index</a>";
exit();
}
}
}
?>
<form id="donorRegistration" action="addvenue.php" method="POST">
<h4>Please enter information below</h4>
<div class="form-group"><label for="address">Address </label>
<textarea name="vaddress" id="address" maxlength="1024" class="form-control" placeholder="Enter Address"><?php if(isset($_POST['vaddress'])) echo $_POST['vaddress']; ?></textarea></div>

<div class="form-group"><label for="city">Enter City </label>
<input type="text" name="vcity" class="form-control" value="<?php if(isset($_POST['vcity'])) echo $_POST['vcity']; ?>" placeholder="Enter City Name" />
</div>

<div class="form-group"><label for="state">Select State</label>
<select name="vstate" class="form-control">
<option value="" selected="selected">Select</option>
<option value="Tamilnadu">Tamilnadu</option>
<option value="Karnataka">Karnataka</option>
<option value="Gujarat">Gujarat</option>
<option value="Delhi">Delhi</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Punjab">Punjab</option>
<option value="Assam">Assam</option>
<option value="Orissa">Orissa</option>
</select>
</div>

<div class="form-group"><label for="phone">Enter Pin Code</label>
<input type="text" name="vpin" maxlength="6" class="form-control" value="<?php if(isset($_POST['vpin'])) echo $_POST['vpin']; ?>" placeholder="Enter pin code" /></div>

<div class="form-group"><label for="phone">Enter contact number</label>
<input type="text" name="vphone" maxlength="10" class="form-control" value="<?php if(isset($_POST['vphone'])) echo $_POST['vphone']; ?>" placeholder="Example(Mobile): 9870123456, Example(Landline): 4422334455" /></div>


<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Add" name="submit" id="submit"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>

</form>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
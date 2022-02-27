<?php
ob_start();
session_start();
if(!isset($_SESSION['donor'])){
header('Location:donorpanel.php');
exit();
}
include('includes/connect.php');
$duname = $_SESSION['donor'];
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
include('includes/donorheader.php');
?>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<h2>Donate Blood</h2>
<?php
if(isset($_POST['submit'])){
if(empty($_POST['dvenue']) || empty($_POST['ddate']) || empty($_POST['dmonth']) || empty($_POST['dyear'])){
echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields require valid information</div>";
}
else{
$cid = rand(000000,999999);
$cname = $_POST['duname'];
$cvenue = $_POST['dvenue'];
$cdob = $_POST['ddate'] . "-" . $_POST['dmonth'] . "-" . $_POST['dyear'];
$cverify = "Unverified";
$insfeed = $pdo->prepare("INSERT INTO donation (doid,donorun,venueid,donatedate,verify) VALUES (:did,:duname,:venueid,:ddate,:dverify)");
$insfeed->execute(array(
				"did"=>$cid,
				"duname"=>$cname,
				"venueid"=>$cvenue,
				"ddate"=>$cdob,
				"dverify"=>$cverify
				));


/* MAIL ENQUIRY BEGIN*/

$to = "cephilo@gmail.com";
$subject = "DONOR ID: " . $cid;

$message ="
<html> 
  <body>
	<table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #000000; \">
		<tr><th colspan=\"2\" style=\"background-color: #ff0000; color: #fff;\">DONOR ID: $cid</th></tr>
		<tr><td><b>NAME:</b></td><td>$cname</td></tr>
		<tr><td><b>GENDER:</b></td><td>$cvenue</td></tr>
		<tr><td><b>DOB:</b></td><td>$cdob</td></tr>
	</table>
  </body>
</html>";

$headers = "Content-type: text/html\r\n";


if(@mail($to,$subject,$message,$headers)){
echo "<div class='alert alert-danger'>Donation registered successfully</div>";
echo "<a href='donorscreen.php'>Go to Index</a>";
exit();
}
else{
echo "<div class='alert alert-danger'>Error in registering donation. Try again later</div>";
echo "<a href='donorscreen.php'>Go to Index</a>";
exit();
}

/* MAIL END */
}
}
?>
<form id="donorRegistration" action="donate.php" method="POST">
<h4>Please enter your information below</h4>

<div class="form-group">
<label for=" ">Select Date of Donation: </label>
<div class="row">
<div class="col-md-4">
<select class="form-control" name="ddate">
<option value="">Date</option>
<?php for($i=ltrim(date('d'),0);$i<=31;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="dmonth">
<option value="">Month</option>
<?php for($i=date('n');$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="dyear">
<option value="">Year</option>
<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
</select>
</div>
</div>
</div>

<div class="form-group"><label for="dvenue">Select Donation Venue</label>
<select name="dvenue" class="form-control">
<option value="" selected="selected">Select</option>
<?php
$getvenue = $pdo->prepare("SELECt * FROM venues");
$getvenue->execute();
while($gv = $getvenue->fetch()){
$gvid = $gv['vid'];
$gvname = $gv['vcity'];
?>
<option value="<?php echo $gvid; ?>"><?php echo $gvname; ?></option>
<?php
}
?>
</select>
</div>
<input type="hidden" name="duname" value="<?php echo $duname; ?>" />
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Submit" name="submit" id="submit"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>

</form>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
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
<h2>Reciever Registration</h2>
<?php
if(isset($_POST['submit'])){
if(empty($_POST['cname']) || empty($_POST['cemail']) || empty($_POST['cphone']) || empty($_POST['caddress']) || empty($_POST['cblood'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>All fields require valid information</div>";
}
if(!preg_match("#^[-A-Za-z' ]*$#", $_POST['cname'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter a valid name</div>";
}
if(!filter_var($_POST['cemail'], FILTER_VALIDATE_EMAIL)){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enter a valid e-mail address</div>";
}
if(!is_numeric($_POST['cphone'])){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Contact Number can contain only numbers</div>";
}
if(strlen($_POST['cphone'])>10 || strlen($_POST['cphone'])<10){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Contact number can only be in 10 digit format</div>";
}
if(strlen($_POST['caddress']) > 1024){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enquiry is too long. Only 1024 characters taken.</div>";
}
if(strlen($_POST['cuname']) > 15){
	echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Username should not exceed 15 characters</div>";
}
$user = $pdo->prepare("SELECT * FROM recievers WHERE duname = :Username");
$user->execute(array(
			'Username'=>$_POST['cuname']
			));
if($user->rowCount()==1){
	echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Username already exists</div>";
}
if(empty($_POST['cpasswd'])){
	echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password cannot be empty</div>";
}
if(strlen($_POST['cpasswd']) > 15){
	echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Password should not exceed 15 characters</div>";
}
else{
$cid = rand(000000,999999);
$cname = $_POST['cname'];
$cgender = $_POST['cgender'];
$cdob = $_POST['cdate'] . "-" . $_POST['cmonth'] . "-" . $_POST['cyear'];
$cuname = $_POST['cuname'];
$cpasswd = md5($_POST['cpasswd']);
$cblood = $_POST['cblood'];
$cemail = $_POST['cemail'];
$cphone = $_POST['cphone'];
$caddress = $_POST['caddress']; 

$insfeed = $pdo->prepare("INSERT INTO recievers (did,duname,dpasswd,dname,dgender,dob,btype,demail,dphone,daddr) VALUES (:cid,:cuname,:cpasswd,:cname,:cgender,:cdob,:cblood,:cemail,:cphone,:caddress)");
$insfeed->execute(array(
				"cid"=>$cid,
				"cuname"=>$cuname,
				"cpasswd"=>$cpasswd,
				"cname"=>$cname,
				"cgender"=>$cgender,
				"cdob"=>$cdob,
				"cblood"=>$cblood,
				"cemail"=>$cemail,
				"cphone"=>$cphone,
				"caddress"=>$caddress
				));

				
/* MAIL ENQUIRY BEGIN*/

$to = "cephilo@gmail.com";
$subject = "DONOR ID: " . $cid;

$message ="
<html> 
  <body>
	<table cellpadding=\"10\" cellspacing=\"0\" style=\"border: 1px solid #000000; \">
		<tr><th colspan=\"2\" style=\"background-color: #243c55; color: #fff;\">DONOR ID: $cid</th></tr>
		<tr><td><b>NAME:</b></td><td>$cname</td></tr>
		<tr><td><b>GENDER:</b></td><td>$cgender</td></tr>
		<tr><td><b>DOB:</b></td><td>$cdob</td></tr>
		<tr><td><b>BLOOD TYPE:</b></td><td>$cblood</td></tr>
		<tr><td><b>EMAIL:</b></td><td>$cemail</td></tr>
		<tr><td><b>PHONE:</b></td><td>$cphone</td></tr>
		<tr><td><b>ADDRESS:</b></td><td>$caddress</td></tr>
	</table>
  </body>
</html>";

$headers = "Content-type: text/html\r\n";

@mail($to,$subject,$message,$headers);

/* MAIL END */

if($insfeed){
echo "<div class='alert alert-danger'>Reciever registered successfully</div>";
echo "<a href='index.php'>Go to Index</a>";
exit();
}
else{
echo "<div class='alert alert-danger'>Error in registration. Try again later</div>";
echo "<a href='index.php'>Go to Index</a>";
exit();
}
}
}
?>
<form id="donorRegistration" action="registergetter.php" method="POST">
<h4>Please enter your information below</h4>
<div class="form-group"><label for="name">Enter Name </label>
<input type="text" name="cname" class="form-control" value="<?php if(isset($_POST['cname'])) echo $_POST['cname']; ?>" placeholder="Enter your full name" /></div>


<div class="form-group"><label for=" ">Select Gender:</label>
<div class="radio">
<label>
<input type="radio" name="cgender" value="Male">Male
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="cgender" value="Female">Female
</label>
</div>
</div>


<div class="form-group">
<label for=" ">Date of Birth: </label>
<div class="row">
<div class="col-md-4">
<select class="form-control" name="cdate">
<option value="">Date</option>
<?php for($i=1;$i<=31;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="cmonth">
<option value="">Month</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="cyear">
<option value="">Year</option>
<?php for($i=date('Y');$i>=1910;$i--):?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
</div>
</div>

<div class="form-group"><label for="username">Enter Username: </label>
<input type="text" name="cuname" class="form-control" value="<?php if(isset($_POST['cuname'])) echo $_POST['cuname']; ?>" placeholder="Enter a new username" /></div>

<div class="form-group"><label for="password">Enter New Password: </label>
<input type="password" name="cpasswd" class="form-control" value="<?php if(isset($_POST['cpasswd'])) echo $_POST['cpasswd']; ?>" placeholder="Enter a new password" /></div>

<div class="form-group"><label for="blood">Select Blood Type</label>
<select name="cblood" class="form-control">
<option value="" selected="selected">Select</option>
<option value="A+ve">A +ve</option>
<option value="A-ve">A -ve</option>
<option value="B+ve">B +ve</option>
<option value="B-ve">B -ve</option>
<option value="AB+ve">AB +ve</option>
<option value="AB-ve">AB -ve</option>
<option value="O+ve">O +ve</option>
<option value="O-ve">O -ve</option>
</select>
</div>

<div class="form-group"><label for="email">Enter Email ID </label>
<input type="text" name="cemail" class="form-control" value="<?php if(isset($_POST['cemail'])) echo $_POST['cemail']; ?>" placeholder="Example: myemail@example.com" /></div>

<div class="form-group"><label for="phone">Enter contact number </label>
<input type="text" name="cphone" maxlength="10" class="form-control" value="<?php if(isset($_POST['cphone'])) echo $_POST['cphone']; ?>" placeholder="Example(Mobile): 9870123456, Example(Landline): 4422334455" /></div>

<div class="form-group"><label for="address">Address </label>
<textarea name="caddress" id="address" maxlength="1024" class="form-control" placeholder="Enter Address"><?php if(isset($_POST['address'])) echo $_POST['address']; ?></textarea></div>



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
<?php
ob_start();
include('connect.php');
include('includes/customerValidate.php');
include('includes/sendMail.php');
include('includes/activationValidate.php');
//Assign Error Message Variables
$nameError = '';
$emailError = '';
$passwordError = '';
$passwordRetypeError = '';
$phoneError = '';
$addressError = '';
$pincodeError = '';
$registerStatus = 'Registration status will be displayed here once you have completed your  Account registration process.';
if(isset($_REQUEST['submit'])){
//Fetch values from HTML form
$cid = rand(000000,999999);
$cname = trim($_REQUEST['cname']);
$cemail = trim($_REQUEST['cemail']);
$cpassword = trim($_REQUEST['cpassword']);
$crpassword = trim($_REQUEST['crpassword']);
$cphone = trim($_REQUEST['cphone']);
$caddress = trim($_REQUEST['caddress']);
$cpincode = trim($_REQUEST['cpincode']);
//Create Class Object and Pass Parameters
$customerValidate = new customerValidate();
$customerValidate->setCustomerID($cid);
$checkName = $customerValidate->validateName($cname);
$checkEmail = $customerValidate->validateEmail($cemail);
$checkUser = $customerValidate->checkUser($cemail);
$checkPassword = $customerValidate->validatePassword($cpassword);
$checkPasswordRetype = $customerValidate->validateRetypePassword($crpassword);
$checkPhone = $customerValidate->validatePhone($cphone);
$checkAddress = $customerValidate->validateAddress($caddress);
$checkPincode = $customerValidate->validatePincode($cpincode);
//Throw Exceptions
if($checkName == false){
$nameError = $customerValidate->nameError();
}
if($checkEmail == false){
$emailError = $customerValidate->emailError();
}
if($checkUser == false){
$emailError = $customerValidate->emailError();
}
if($checkPassword == false){
$passwordError = $customerValidate->passwordError();
}
if($checkPasswordRetype == false){
$passwordRetypeError = $customerValidate->passwordRetypeError();
}
if($checkPhone == false){
$phoneError = $customerValidate->phoneError();
}
if($checkAddress == false){
$addressError = $customerValidate->addressError();
}
if($checkPincode == false){
$pincodeError = $customerValidate->pincodeError();
}
//Throw Register Exception
if($checkName !== false && $checkEmail !== false && $checkPassword !== false && $checkPasswordRetype !== false && $checkPhone !== false && $checkAddress !== false && $checkPincode !== false){
$registerCustomer = $customerValidate->registerCustomer();
if($registerCustomer == true){
$registerStatus = $customerValidate->registerSuccess();
}
else if($registerCustomer == false){
$registerStatus = $customerValidate->registerFailed();
}
}
else{
$registerStatus = "<b>Error in registration. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}

/* MAIL ENQUIRY BEGIN */

$activationValidate = new activationValidate();			
$generateKey = 	$activationValidate->generateKey();
$setActivation = $activationValidate->setActivation($cid, $generateKey);
$to = $cemail;
$subject = "Lumibella Customer Account Activation";

$message = "<html><body><table style='border:1px solid #420340;'><tr><thead><th style='background-color:#420340;padding:10px;'><img src='images/logo/lumibella.png' style='width:300px;' /></th></thead></tr><tr><td style='color:#420340;padding:10px;font-size: 16px;'>Hello $cname ,<br /><br />Welcome to Lumibella Stores. You have received this email because you have registered an account through our online web store. Thank you for registering and becoming a member customer of Lumibella Stores. <br /><br /><b>Your Lumibella Customer Account Login Details:</b><br /><b>Your Username:</b> $cemail<br /><b>Your Password:</b> $cpassword<br /><br />Please click the below link to activate your Lumibella Store customer account.</td></tr><tr><thead><th><a style='color:#420340;text-decoration:underlined;padding:20px;text-align:center;font-size:18px;' href='http://localhost/lumibella/verify.php?customer=$cid&activation=$generateKey'>Activate  Customer Account</a></th></thead></tr><tr><td style='font-size:12px;background-color:#420340;color:#ffffff;padding:10px;'>Copyrights 2015. Lumibella Fashions. No.1, 1st Street, Velachery, Chennai - 600062 <a style='color:#ffe900;text-decoration:none;' href='www.lumibellastore.com'>www.lumibellastore.com</a></td></tr></table></body></html>";

$name = "Lumibella Store";

$mailStatus = sendmail($to,$subject,$message,$name);

/* MAIL ENQUIRY END */

}

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
<div class="loader"></div>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">Lumibella Customer</h4>
<hr>

<div class="row">

<!-- Login Column -->

<div class="col-md-6 col-lg-6">
<div class="customer-form">
<h4 class="heading">Login</h4>
<form action="authenticate.php" method="POST">
<div class="form-group"><label for="lemail">Email ID</label><input class="form-control" type="text" name="lemail" maxlength="50" placeholder="Enter Username" /></div>
<div class="form-group"><label for="lpassword">Password</label><input class="form-control" type="password" name="lpassword" maxlength="15" placeholder="Enter Password" /></div>
<input type="hidden" value="<?php echo $_GET['location']; ?>" name="redirect" />
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Login" name="login" id="login"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>
</div>
<img src="images/contents/customer-ad.jpg" class="img-responsive" />
</div>

<!-- Register Column -->

<div class="col-md-6 col-lg-6">
<div class="customer-form">
<h4 class="heading">Customer Registration</h4>
<h4>Not a Lumibella Member ? Register Now !</h4>
<div class="customerRegister"><div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $registerStatus; ?></div></div>
<form id="enquiryForm" action="customer.php" method="POST">
<div class="form-group"><label for="name">Enter Name </label>
<input type="text" name="cname" class="form-control" maxlength="25" value="<?php if(isset($_POST['cname'])) echo $_POST['cname']; ?>" placeholder="Enter your full name" /><span class="exception"><?php echo $nameError; ?></span></div>

<div class="form-group"><label for="cemail">Enter Email ID </label>
<input type="text" name="cemail" class="form-control" maxlength="50" value="<?php if(isset($_POST['cemail'])) echo $_POST['cemail']; ?>" placeholder="Example: myemail@example.com" /><span class="exception"><?php echo $emailError; ?></span></div>

<div class="form-group"><label for="cpassword">Enter New Password </label>
<input type="password" name="cpassword" class="form-control" value="" maxlength="15" placeholder="Alphanumeric. Less than 15 characters" /><span class="exception"><?php echo $passwordError; ?></span></div>

<div class="form-group"><label for="crpassword">Retype Password </label>
<input type="password" name="crpassword" class="form-control" value="" maxlength="15" placeholder="Retype the above new password" /><span class="exception"><?php echo $passwordRetypeError; ?></span></div>

<div class="form-group"><label for="phone">Enter contact number </label>
<input type="text" name="cphone" maxlength="10" class="form-control" value="<?php if(isset($_POST['cphone'])) echo $_POST['cphone']; ?>" placeholder="Example(Mobile): 9870123456, Example(Landline): 4422334455" /><span class="exception"><?php echo $phoneError; ?></span></div>

<div class="form-group"><label for="address">Address </label>
<textarea name="caddress" id="address" maxlength="1024" class="form-control" placeholder="Enter Address"><?php if(isset($_POST['caddress'])) echo $_POST['caddress']; ?></textarea><span class="exception"><?php echo $addressError; ?></span></div>

<div class="form-group"><label for="pincode">Enter Pincode </label>
<input type="text" name="cpincode" maxlength="6" class="form-control" value="<?php if(isset($_POST['cpincode'])) echo $_POST['cpincode']; ?>" placeholder="Example: 600001" /><span class="exception"><?php echo $pincodeError; ?></span></div>

<button class="btn btn-primary btn-lg pull-right" id="progressButtonReg" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Register" name="submit" id="submit"  onclick="this.style.display='none'; document.getElementById('progressButtonReg').style.display='inline'"; />
</form>
</div>
</div>
</div>
</div>
<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
</body>
</html>
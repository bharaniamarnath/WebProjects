<?php
ob_start();
session_start();
include('connect.php');
include('includes/accountUpdateValidate.php');
if(!isset($_SESSION['customer'])){
header("Location: customer.php?location=".urlencode($_SERVER['REQUEST_URI']));
}
//Assign Password Update Error Variables
$cPassError = '';
$nPassError = '';
$nPassRetypeError = '';
$cEmailError = '';
$cPhoneError = '';
$cAddressError = '';
$passUpdateStatus = 'Status message will be displayed here after password update';
//Assign Email Update Error Variables
$mailValError = '';
$mailPassError = '';
$mailUpdateStatus = 'Status message will be displayed here after email update';
if(isset($_REQUEST['updatePassword'])){
//Fetch Values from HTML form
$customerid = $_SESSION['customer'];
$cpass = trim($_REQUEST['aucpass']);
$npass = trim($_REQUEST['aunpass']);
$nrpass = trim($_REQUEST['aurnpass']);
//Create class object and pass parameters
$passwordUpdateValidate = new passwordUpdateValidate();
$validateCurrentPassword = $passwordUpdateValidate->validateCurrentPassword($cpass);
$checkCurrentPassword = $passwordUpdateValidate->checkCurrentPassword($cpass,$customerid);
$validateNewPassword = $passwordUpdateValidate->validateNewPassword($npass);
$validateNewRetypePassword = $passwordUpdateValidate->validateNewRetypePassword($nrpass);
//Throw Exceptions
if($validateCurrentPassword == false){
$cPassError = $passwordUpdateValidate->cPassError();
}
if($checkCurrentPassword == false){
$cPassError = $passwordUpdateValidate->cPassError();
}
if($validateNewPassword == false){
$nPassError = $passwordUpdateValidate->nPassError();
}
if($validateNewRetypePassword == false){
$nPassRetypeError = $passwordUpdateValidate->nPassRetypeError();
}
if($validateCurrentPassword !== false && $checkCurrentPassword !== false && $validateNewPassword !== false && $validateNewRetypePassword !== false){
$updatePassword = $passwordUpdateValidate->updatePassword($npass,$customerid);
if($updatePassword == true){
$passUpdateStatus = $passwordUpdateValidate->passUpdateSuccess();
}
else if($updatePassword == false){
$passUpdateStatus = $passwordUpdateValidate->passUpdateFailure();
}
else{
$passUpdateStatus = "<b>Error in update. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}
}
}
if(isset($_REQUEST['updateEmail'])){
//Fetch values from HTML forms
$customerid = $_SESSION['customer'];
$nemail = trim($_REQUEST['uemail']);
$nepass = trim($_REQUEST['uepass']);
//Create class objects and pass parameters
$emailValidateUpdate = new emailValidateUpdate();
$validateEmail = $emailValidateUpdate->validateEmail($nemail);
$checkEmail = $emailValidateUpdate->checkEmail($nemail, $customerid);
$emailPasswordValidate = new passwordUpdateValidate();
$emailPasswordFilter = $emailPasswordValidate->validateCurrentPassword($nepass);
$emailPasswordCheck = $emailPasswordValidate->checkCurrentPassword($nepass, $customerid);
//Throws Exceptions
if($validateEmail == false){
$mailValError = $emailValidateUpdate->mailValError();
}
if($checkEmail == false){
$mailValError = $emailValidateUpdate->mailValError();
}
if($emailPasswordFilter == false){
$mailPassError = $emailPasswordValidate->cPassError();
}
if($emailPasswordCheck == false){
$mailPassError = $emailPasswordValidate->cPassError();
}
if($validateEmail !== false && $checkEmail !== false && $emailPasswordFilter !== false && $emailPasswordCheck !== false){
$updateNewEmail = $emailValidateUpdate->updateNewEmail($nemail, $customerid);
if($updateNewEmail == true){
$mailUpdateStatus = $emailValidateUpdate->mailUpdateSuccess();
}
else if($updateNewEmail == false){
$mailUpdateStatus = $emailValidateUpdate->mailUpdateFailed();
}
else{
$mailUpdateStatus = "<b>Error in update. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content animsition fade-in-down">
<h4 class="heading">Customer Account Update</h4>
<hr>

<div class="col-md-3">
<div class="list-group">
<a href="index.php" class="list-group-item account-logo"><img class="img-responsive" src="images/logo/logo.png" /><h5>Lumibella Customer</h5></a>
<a href="account.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> My Feeds</a>
<a href="accountupdate.php" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Edit Account</a>
<a href="purchases.php" class="list-group-item"><span class="glyphicon glyphicon-shopping-cart"></span> My Purchases</a>
<a href="myratings.php" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> My Ratings</a>
<a href="messages.php" class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> Messages</a>
<a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-lock"></span> Log Out</a>
</div>
</div>

<div class="col-md-8 col-lg-8">
<div class="row">
<div class="col-md-12 col-lg-12">
<?php
$customer = $_SESSION['customer'];
$getcdetail = $pdo->prepare("SELECT * FROM customers WHERE cid=:id");
$getcdetail->execute(array(
					"id"=>$customer
					));
$gcd = $getcdetail->fetch();
$cname = $gcd['cname'];
$cemail = $gcd['cemail'];
?>
<div class="row">
<div class="col-md-12 col-lg-12 account-name">
<h3>Hello, <?php echo $cname; ?></h3>
<p><?php echo $cemail; ?></p>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12 col-lg-12 editaccount">
<h4 class="checkout-heading">Change My Account Password</h4>
<div class="alert alert-info"><?php echo $passUpdateStatus; ?></div>
<form action="accountupdate.php" method="POST">
<div class="form-group"><label for="aucpass">Current Password</label><input class="form-control" type="password" name="aucpass" maxlength="15" placeholder="Enter Current Password" /><span class="exception"><?php echo $cPassError; ?></span></div>
<div class="form-group"><label for="aunpass">New Password</label><input class="form-control" type="password" name="aunpass" maxlength="15" placeholder="Enter New Password" /><span class="exception"><?php echo $nPassError; ?></span></div>
<div class="form-group"><label for="aurnpass">Retype New Password</label><input class="form-control" type="password" name="aurnpass" maxlength="15" placeholder="Retype New Password" /><span class="exception"><?php echo $nPassRetypeError; ?></span></div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton1" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Update Password" name="updatePassword" id="updatePassword"  onclick="this.style.display='none'; document.getElementById('progressButton1').style.display='inline'"; />
</form>
</div>
</div>

<div class="row">
<div class="col-md-12 col-lg-12 editaccount">
<h4 class="checkout-heading">Change my Account Email Address</h4>
<div class="alert alert-info"><?php echo $mailUpdateStatus; ?></div>
<?php
$fetchmail = $pdo->prepare("SELECT * FROM customers WHERE cid=:customer");
$fetchmail->execute(array("customer"=>$customer));
$fmval = $fetchmail->fetch();
$fmemail = $fmval['cemail'];
?>
<form action="accountupdate.php" method="POST">
<div class="form-group"><label for="uemail">Email ID</label><input class="form-control" type="text" name="uemail" value="<?php echo $fmemail; ?>" maxlength="50" placeholder="Enter New Email ID" /><span class="exception"><?php echo $mailValError; ?></span></div>
<div class="form-group"><label for="uepass">Current Password</label><input class="form-control" type="password" name="uepass" maxlength="15" placeholder="Enter Current Password" /><span class="exception"><?php echo $mailPassError; ?></span></div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton2" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Update Email" name="updateEmail" id="updateEmail"  onclick="this.style.display='none'; document.getElementById('progressButton2').style.display='inline'"; />
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
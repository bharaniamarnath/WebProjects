<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateEnquiry.php');
include('includes/mailEnquiry.php');
if(!isset($_SESSION['customer'])){
header("Location: customer.php?location=".urlencode($_SERVER['REQUEST_URI']));
}
//assign exception variables
$enquiryStatus = "Status message will be displayed here";
$enquiryError = "";
//fetch form values
if(isset($_REQUEST['sendenq'])){
$ename = trim($_REQUEST['ename']);
$email = trim($_REQUEST['email']);
$ephone = trim($_REQUEST['ephone']);
$enquiry = trim($_REQUEST['enquiry']);
//create class and objects
$validateEnquiry = new validateEnquiry();
$validateMessage = $validateEnquiry->validateMessage($enquiry);
if($validateMessage == false){
$enquiryError = $validateEnquiry->enquiryError();
}
else if($validateMessage == true){
$eid = rand(111111,999999);
$insertEnquiry = $validateEnquiry->insertEnquiry($eid,$ename,$email,$ephone,$enquiry);
sendEnquiry($ename,$email,$enquiry);
if($insertEnquiry == true){
$enquiryStatus = $validateEnquiry->enquirySuccess();
}
else{
$enquiryStatus = $validateEnquiry->enquiryFailed();	
}
}
else{
$enquiryStatus = "Error occurred. Could not send the enquiry. try again later";
}
}
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
<?php include('header.php'); ?>
<div class="row content animsition fade-in-down">
<div class="col-md-12 col-lg-12">
<h4 class="heading">Lumibella Enquiry</h4>
<hr>
</div>
<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
<?php
$cid = $_SESSION['customer'];
$getcustomer = $pdo->prepare("SELECT cname,cemail,cphone FROM customers WHERE cid=:cid");
$getcustomer->execute(array("cid"=>$cid));
$gcdetails = $getcustomer->fetch();
$getcname = $gcdetails['cname'];
$getcemail = $gcdetails['cemail'];
$getcphone = $gcdetails['cphone'];
?>
<form id="enquiryForm" action="enquiry.php" method="POST">
<h4 class="checkout-heading">Please enter your contact information below</h4>
<div class="alert alert-info"><?php echo $enquiryStatus; ?></div>
<div class="form-group"><label for="name">Enter Name </label>
<input type="text" name="ename" class="form-control" value="<?php echo $getcname; ?>" placeholder="Enter your full name" /></div>

<div class="form-group"><label for="email">Enter Email ID </label>
<input type="text" name="email" class="form-control" value="<?php echo $getcemail; ?>" placeholder="Example: myemail@example.com" /></div>

<div class="form-group"><label for="phone">Enter contact number </label>
<input type="text" name="ephone" maxlength="10" class="form-control" value="<?php echo $getcphone; ?>" placeholder="Example(Mobile): 9870123456, Example(Landline): 4422334455" /></div>

<div class="form-group"><label for="enquiry">Enquiry Message </label>
<textarea name="enquiry" id="enquiry" maxlength="1024" class="form-control" placeholder="Enter Message"><?php if(isset($_POST['enquiry'])) echo $_POST['enquiry']; ?></textarea><span class="exception"><?php echo $enquiryError; ?></span></div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Send" name="sendenq" id="sendenq"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>
</div>
</div>
<?php include('footer.php'); ?>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
</body>
</html>
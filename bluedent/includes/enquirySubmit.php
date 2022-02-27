<?php
// Assign error variables
$enameErr = '';
$eemailErr = ''; 
$ephoneErr = ''; 
$eenquiryErr = '';
$enquiryStatus = '';
if(isset($_REQUEST['submit'])){
$ename = trim($_REQUEST['ename']);
$eemail = trim($_REQUEST['eemail']);
$ephone = trim($_REQUEST['ephone']);
$eenquiry = trim($_REQUEST['eenquiry']);
// Create class and object instance
$enquiryValidate = new enquiryValidate();
$validateName = $enquiryValidate->validateName($ename);
$validateEmail = $enquiryValidate->validateEmail($eemail);
$validatePhone = $enquiryValidate->validatePhone($ephone);
$validateEnquiry = $enquiryValidate->validateEnquiry($eenquiry);
// Throw exceptions
if($validateName == false){
$enameErr = $enquiryValidate->enameErr();
}
if($validateEmail == false){
$eemailErr = $enquiryValidate->eemailErr();
}
if($validatePhone == false){
$ephoneErr = $enquiryValidate->ephoneErr();
}
if($validateEnquiry == false){
$eenquiryErr = $enquiryValidate->eenquiryErr();
}
if($validateName !== false && $validateEmail !== false && $validatePhone !== false && $validateEnquiry !== false){
$submitEnquiry = $enquiryValidate->submitEnquiry($ename,$eemail,$ephone,$eenquiry);
if($submitEnquiry == true){
$enquiryStatus = $enquiryValidate->submitSuccess();
}
else if($submitEnquiry == false){
$enquiryStatus = $enquiryValidate->submitFailed();
}
}
else{
$enquiryStatus = "<b>Error in submission. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact us for more information.";
}
}
?>
<?php
class customerValidate{
	private $cid;
	private $cname;
	private $cemail;
	private $cpassword;
	private $crpassword;
	private $cphone;
	private $caddress;
	private $cpincode;
	private $cnameErr, $cemailErr, $cpasswordErr, $crpasswordErr, $cphoneErr, $caddressErr, $cpincodeErr, $registerOK, $registerErr;
	
	public function setCustomerID($cid){
		$this->cid = $cid;
	}
	
	public function validateName($cname){
		if($cname == ''){
			$this->cnameErr = "Name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z' ]*$#", $cname)){
			$this->cnameErr = "Name cannot contain special characters";
			return false;
		}
		else if(strlen($cname) > 20){
			$this->cnameErr = "Name cannot contain more than 20 characters";
			return false;
		}
		else{
			$this->cname = $cname;
			return true;
		}
	}
	
	public function validateEmail($cemail){
		if($cemail == ''){
			$this->cemailErr = "Email is required";
			return false;
		}
		else if(!filter_var($cemail, FILTER_VALIDATE_EMAIL)){
			$this->cemailErr = "Invalid Email address format";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checkUser($cemail){
		include('connect.php');
		$checkuser = $pdo->prepare("SELECT * FROM customers WHERE cemail=:email");
		$checkuser->execute(array("email"=>$cemail));
		if($checkuser->rowCount() == 1){
			$this->cemailErr = "Email already exists or registered";
			return false;
		}
		else{
			$this->cemail = $cemail;
			return true;
		}
	}

	public function validatePassword($cpassword){
		if($cpassword == ''){
			$this->cpasswordErr = "Password is required";
			return false;
		}
		else if(!ctype_alnum($cpassword)){
			$this->cpasswordErr = "Password can contain only alphanumeric characters";
			return false;
		}
		else if(strlen($cpassword) > 15){
			$this->cpasswordErr = "Password cannot contain more than 15 characters";
			return false;
		}
		else{
			$this->cpassword = $cpassword;
			return true;
		}
	}
	
	public function validateRetypePassword($crpassword){
		if($crpassword == ''){
			$this->crpasswordErr = "Re-type password is required";
			return false;
		}
		else if($this->cpassword !== $crpassword){
			$this->crpasswordErr = "Password re-type does not match";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validatePhone($cphone){
		if($cphone == ''){
			$this->cphoneErr = "Contact number is required";
			return false;
		}
		else if(!is_numeric($cphone)){
			$this->cphoneErr = "Contact Number can contain only numbers";
			return false;
		}
		else if(strlen($cphone) > 10 || strlen($cphone) < 10){
			$this->cphoneErr = "Contact number can contain only 10 digits";
			return false;
		}
		else{
			$this->cphone = $cphone;
			return true;
		}
	}
	
	public function validateAddress($caddress){
		if($caddress == ''){
			$this->caddressErr = "Address is required";
			return false;
		}
		else if(strlen($caddress) > 1024){
			$this->caddressErr = "Address can contain only 1024 characters";
			return false;
		}
		else{
			$this->caddress = $caddress;
			return true;
		}
	}
	
	public function validatePincode($cpincode){
		if($cpincode == ''){
			$this->cpincodeErr = "Pincode is required";
			return false;
		}
		else if(!is_numeric($cpincode)){
			$this->cpincodeErr = "Pincode can contain only numbers";
			return false;
		}
		else if(strlen($cpincode) > 6 || strlen($cpincode) < 6){
			$this->cpincodeErr = "Pincode can only be in 6 digit format";
			return false;
		}
		else{
			$this->cpincode = $cpincode;
			return true;
		}
	}
	
//Record values in database
	
	public function registerCustomer(){
		include('connect.php');
		$cactive = 0;
		$cstatus = 0;

		$inscus = $pdo->prepare("INSERT INTO customers (cid,cname,cemail,cpassword,caddress,cpincode,cphone,activated,status) VALUES (:id,:name,:email,:password,:address,:pincode,:phone,:activated,:status)");
		$inscus->execute(array(
						"id"=>$this->cid,
						"name"=>$this->cname,
						"email"=>$this->cemail,
						"password"=>md5($this->cpassword),
						"address"=>$this->caddress,
						"pincode"=>$this->cpincode,
						"phone"=>$this->cphone,
						"activated"=>$cactive,
						"status"=>$cstatus
						));

		if($inscus){
			$this->registerOK = "Your Lumibella customer account registration has been completed successfully. Please check your email for account activation link.";
			return true;
		}
		else{
			$this->registerErr = "Error in registering your customer account. Try again later. Contact us for more information";
			return false;
		}
	}
	
//Error and Exceptions

	public function nameError(){
		return $this->cnameErr;
	}
	
	public function emailError(){
		return $this->cemailErr;
	}
	
	public function passwordError(){
		return $this->cpasswordErr;
	}
	
	public function passwordRetypeError(){
		return $this->crpasswordErr;
	}
	
	public function phoneError(){
		return $this->cphoneErr;
	}
	
	public function addressError(){
		return $this->caddressErr;
	}
	
	public function pincodeError(){
		return $this->cpincodeErr;
	}
	
	public function registerSuccess(){
		return $this->registerOK;
	}
	
	public function registerFailed(){
		return $this->registerErr;
	}
}
?>
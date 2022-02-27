<?php
class orderValidate{
	private $cnameErr, $cemailErr, $cphoneErr, $caddressErr, $cpincodeErr, $stockErr;
	
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
			return true;
		}
	}
	

//Error and Exceptions

	public function nameError(){
		return $this->cnameErr;
	}
	
	public function emailError(){
		return $this->cemailErr;
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
	
	public function stockError(){
		return $this->stockErr;
	}
}
?>
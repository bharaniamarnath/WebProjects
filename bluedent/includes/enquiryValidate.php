<?php
class enquiryValidate{
	private $enameErr, $eemailErr, $ephoneErr, $eenquiryErr, $submitSuccess, $submitFailed;
	
	public function validateName($ename){
		if($ename == ''){
			$this->enameErr = "Name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z' ]*$#", $ename)){
			$this->enameErr = "Name cannot contain special characters";
			return false;
		}
		else if(strlen($ename) > 30){
			$this->enameErr = "Name cannot contain more than 20 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateEmail($eemail){
		if($eemail == ''){
			$this->eemailErr = "Email is required";
			return false;
		}
		else if(!filter_var($eemail, FILTER_VALIDATE_EMAIL)){
			$this->eemailErr = "Invalid Email address format";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validatePhone($ephone){
		if($ephone == ''){
			$this->ephoneErr = "Contact number is required";
			return false;
		}
		else if(!is_numeric($ephone)){
			$this->ephoneErr = "Contact Number can contain only numbers";
			return false;
		}
		else if(strlen($ephone) > 10 || strlen($ephone) < 10){
			$this->ephoneErr = "Contact number can contain only 10 digits";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateEnquiry($eenquiry){
		if($eenquiry == ''){
			$this->eaddressErr = "Enquiry message is required";
			return false;
		}
		else if(strlen($eenquiry) > 1024){
			$this->eaddressErr = "Enquiry message can contain only 1024 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	// Submit Information via Email
	
	public function submitEnquiry($ename,$eemail,$ephone,$eenquiry){
		include('connect.php');
		include('validateMailEnquiry.php');
		$eid = sprintf("%06d", mt_rand(100000,999999));
		$insenquiry = $pdo->prepare("INSERT INTO enquiry (feid,name,email,phone,enquiry) VALUES (:feid,:name,:email,:phone,:enquiry)");
		$insenquiry->execute(array(
						"feid"=>$eid,
						"name"=>$ename,
						"email"=>$eemail,
						"phone"=>$ephone,
						"enquiry"=>$eenquiry
						));
						
		/* MAIL ENQUIRY BEGIN*/

		validateMailEnquiry($eid,$ename,$ephone,$eemail,$eenquiry);

		/* MAIL ENQUIRY END*/

		if($insenquiry->rowCount() > 0){
			$this->submitSuccess= "Your enquiry has been submitted successfully to Bluedent India. We will notify you soon.";
			return true;
		}
		else{
			$this->submitFailed = "Error in submitting your enquiry. Try again later. Contact us for more information.";
			return false;
		}

		
		/* MAIL END */
	}
	
//Error and Exceptions

	public function enameErr(){
		return $this->enameErr;
	}
	
	public function eemailErr(){
		return $this->eemailErr;
	}
	
	public function ephoneErr(){
		return $this->ephoneErr;
	}

	public function eenquiryErr(){
		return $this->eaddressErr;
	}
	
	public function submitSuccess(){
		return $this->submitSuccess;
	}
	
	public function submitFailed(){
		return $this->submitFailed;
	}
}
?>
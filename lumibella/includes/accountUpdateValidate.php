<?php

//Password Validation Class

class passwordUpdateValidate{
	private $newPassword;
	private $newRetypePassword;
	private $cPassError, $nPassError, $nPassRetypeError, $uPassOKStatus, $uPassFailStatus;
	
	public function validateCurrentPassword($cpass){
		if($cpass == ''){
			$this->cPassError = "Current Password is required";
			return false;
		}
		else if(!ctype_alnum($cpass)){
			$this->cPassError = "Password can contain only alpha-numeric characters";
			return false;
		}
		else if(strlen($cpass) > 15){
			$this->cPassError = "Password cannot contain more than 15 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checkCurrentPassword($cpass,$customerid){
		include('connect.php');
		$checkpass = $pdo->prepare("SELECT * FROM customers WHERE cid=:id");
		$checkpass->execute(array("id"=>$customerid));
		$cp = $checkpass->fetch();
		$cpval = $cp['cpassword'];
		if(md5($cpass) == $cpval){
			return true;
		}
		else{
			$this->cPassError = "Current password is incorrect";
			return false;
		}
	}
	
		public function validateNewPassword($npass){
		if($npass == ''){
			$this->nPassError = "Current Password is required";
			return false;
		}
		else if(!ctype_alnum($npass)){
			$this->nPassError = "Password can contain only alpha-numeric characters";
			return false;
		}
		else if(strlen($npass) > 15){
			$this->nPassError = "Password cannot contain more than 15 characters";
			return false;
		}
		else{
			$this->newPassword = $npass;
			return true;
		}
	}
	
	public function validateNewRetypePassword($nrpass){
		if($nrpass == ''){
			$this->nPassRetypeError = "Re-type password is required";
			return false;
		}
		if($nrpass !== $this->newPassword){
			$this->nPassRetypeError = "Password re-type  does not match";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function updatePassword($npass, $customerid){
		include('connect.php');
		$updatepass = $pdo->prepare("UPDATE customers SET cpassword=:password WHERE cid=:id");
		$updatepass->execute(array(
							"password"=>md5($npass),
							"id"=>$customerid
							));
		if($updatepass){
			$this->uPassOKStatus = "New password updated successfully";
			return true;
		}
		else{
			$this->uPassFailStatus = "Could not new password.";
			return false;
		}
	}
	
//Exception functions

	public function cPassError(){
		return $this->cPassError;
	}
	
	public function nPassError(){
		return $this->nPassError;
	}
	
	public function nPassRetypeError(){
		return $this->nPassRetypeError;
	}
	
	public function passUpdateSuccess(){
		return $this->uPassOKStatus;
	}
	
	public function passUpdateFailure(){
		return $this->uPassFailStatus;
	}
}

//Email Validation Class

class emailValidateUpdate{
	private $newEmail;
	private $nEmailErr, $updateEmailOK, $updateEmailFail;
	
	public function validateEmail($nemail){
		if($nemail == ''){
			$this->nEmailErr = "Email is required";
			return false;
		}
		else if(!filter_var($nemail, FILTER_VALIDATE_EMAIL)){
			$this->nEmailErr = "Invalid Email address format";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function checkEmail($nemail, $customerid){
		include('connect.php');
		$checkuser = $pdo->prepare("SELECT * FROM customers WHERE cemail=:email");
		$checkuser->execute(array("email"=>$nemail));
		if($checkuser->rowCount() == 1){
			$this->nEmailErr = "Email already exists or registered";
			return false;
		}
		else{
			$this->newEmail = $nemail;
			return true;
		}
	}
	
	public function updateNewEmail($nemail, $customerid){
		include('connect.php');
		$updatemail = $pdo->prepare("UPDATE customers SET cemail=:email WHERE cid=:id");
		$updatemail->execute(array(
							"email"=>$nemail,
							"id"=>$customerid
							));
		if($updatemail){
			$this->updateEmailOk = "New Email updated successfully";
			return true;
		}
		else{
			$this->updateEmailFail = "COuld not update new Email";
			return false;
		}
	}
	
//Errors and Exceptions
	
	public function mailValError(){
		return $this->nEmailErr;
	}
	
	public function mailUpdateSuccess(){
		return $this->updateEmailOk;
	}
	
	public function mailUpdateFailed(){
		return $this->updateEmailFail;
	}
	
}

?>
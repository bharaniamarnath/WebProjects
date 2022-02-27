<?php
class validateEnquiry{
private $messageError, $enquirySuccess, $enquiryFailed;

public function validateMessage($enquiry){
	if($enquiry == ''){
		$this->messageError = "Enquiry message is required";
		return false;
	}
	else if(strlen($enquiry) > 1024){
		$this->messageError = "Only 1024 characters allowed";
		return false;
	}
	else{
		return true;
	}
}
public function insertEnquiry($eid,$ename,$email,$ephone,$enquiry){
	include("connect.php");
	$insenquiry = $pdo->prepare("INSERT INTO enquiries (eid,ename,email,ephone,enquiry) VALUES (:eid,:ename,:email,:ephone,:enquiry)");
	$ieexecute = $insenquiry->execute(array(
					"eid"=>$eid,
					"ename"=>$ename,
					"email"=>$email,
					"ephone"=>$ephone,
					"enquiry"=>$enquiry
					));
	if($ieexecute == true){
		$this->enquirySuccess = "Enquiry submitted successfully";
		return true;
	}
	else{
		$this->enquiryFailed = "Error submitting the enquiry. Try again later";
		return false;
	}
}

//Errors and Exceptions

public function enquiryError(){
	return $this->messageError;
}

public function enquirySuccess(){
	return $this->enquirySuccess;
}

public function enquiryFailed(){
	return $this->enquiryFailed;
}

}
?>
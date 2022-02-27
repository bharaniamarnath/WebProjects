<?php
class validateDeleteEnquiry{
	
	private $deleteenquirySuccess, $deleteenquiryFailed;
	
	public function deleteEnquiry($feedid){
		include('connect.php');
		$deletefeed = $pdo->prepare("DELETE FROM enquiry WHERE feid=:feid");
		$deletefeed->execute(array("feid"=>$feedid));
		if($deletefeed->rowCount() > 0){
			$this->deleteenquirySuccess = "Enquiry ".$feedid." deleted.";
			return true;
		}
		else{
			$this->deleteenquiryFailed = "Error Occurred. Could not delete enquiry " . $feedid;
			return false;
		}
	}
	
	//Errors and Exceptions
	
	public function deleteEnquirySuccess(){
		return $this->deleteenquirySuccess;
	}
	
	public function deleteEnquiryFailed(){
		return $this->deleteenquiryFailed;
	}
}
?>
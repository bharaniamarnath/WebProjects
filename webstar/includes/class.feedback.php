<?php

class feedback{

	private $FeedId;
	private $From;
	private $Subject;
	private $Message;
	
	public function getFeedId(){
		return $this->FeedId;
	}	
	public function setFeedId($FeedId){
		$this->FeedId = $FeedId;
	}
	
	public function getFrom(){
		return $this->From;
	}	
	public function setFrom($From){
		$this->From = $From;
	}
	
	public function getSubject(){
		return $this->Subject;
	}	
	public function setSubject($Subject){
		$this->Subject = $Subject;
	}
	
	public function getMessage(){
		return $this->Message;
	}	
	public function setMessage($Message){
		$this->Message = $Message;
	}
	
	public function SendFeedback(){
		include "connect.php";
		include "alerts.php";
		
		$feedbck = $pdo->prepare("INSERT INTO feedbacks (ID, FeedFrom, Subject, Feedback, Date) VALUES (:ID, :FeedFrom, :Subject, :Feedback, now())");
		$feedbck->execute(array(
						'ID'=>$this->getFeedId(),
						'FeedFrom'=>$this->getFrom(),
						'Subject'=>$this->getSubject(),
						'Feedback'=>$this->getMessage()
						));
		
		if($feedbck){
			echo $fbacksentalert;
		}
		else{
			echo $fbackfalert;
		}
	}
	
}
?>
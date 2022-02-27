<?php
class report{
	
	private $ReportId;
	private $ReportedUser;
	private $ReportUser;
	private $ReportMessage;
	private $ReportLocation;
	
	public function getReportId(){
		return $this->ReportId;
	}	
	public function setReportId($ReportId){
		$this->ReportId = $ReportId;
	}
	
	public function getReportedUser(){
		return $this->ReportedUser;
	}	
	public function setReportedUser($ReportedUser){
		$this->ReportedUser = $ReportedUser;
	}
	
	public function getReportUser(){
		return $this->ReportUser;
	}	
	public function setReportUser($ReportUser){
		$this->ReportUser = $ReportUser;
	}
	
	public function getReportMessage(){
		return $this->ReportMessage;
	}	
	public function setReportMessage($ReportMessage){
		$this->ReportMessage = $ReportMessage;
	}
	
	public function getReportLocation(){
		return $this->ReportLocation;
	}	
	public function setReportLocation($ReportLocation){
		$this->ReportLocation = $ReportLocation;
	}
	
	public function MessageReport(){
		include "connect.php";
		include "alerts.php";
		
		$repentry = $pdo->prepare("INSERT INTO reports (ID, UserID, Reported, Report, Location, Date) VALUES (:ID, :UserID, :Reported, :Report, :Location, now())");
		$repentry->execute(array(
						'ID'=>$this->getReportId(), 
						'UserID'=>$this->getReportUser(), 
						'Reported'=>$this->getReportedUser(), 
						'Report'=>$this->getReportMessage(), 
						'Location'=>$this->getReportLocation()
						));
		if($repentry){
		echo $reportconalert;
		}
		else{
		echo $reportfailalert;
		}
	}
}
?>
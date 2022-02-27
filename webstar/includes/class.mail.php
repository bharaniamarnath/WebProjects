<?php
class mail{
	
	private $UserSession;
	private $MailId;
	private $MailReciever;
	private $MailSubject;
	private $MailMessage;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getMailId(){
		return $this->MailId;
	}	
	public function setMailId($MailId){
		$this->MailId = $MailId;
	}
	
	public function getMailReciever(){
		return $this->MailReciever;
	}	
	public function setMailReciever($MailReciever){
		$this->MailReciever = $MailReciever;
	}
	
	public function getMailSubject(){
		return $this->MailSubject;
	}	
	public function setMailSubject($MailSubject){
		$this->MailSubject = $MailSubject;
	}
	
	public function getMailMessage(){
		return $this->MailMessage;
	}	
	public function setMailMessage($MailMessage){
		$this->MailMessage = $MailMessage;
	}
	
	public function SendMail(){
		include "connect.php";
		include "alerts.php";
		
		$mailres = $pdo->prepare("INSERT INTO maildetails (ID, Sender, Reciever, Subject, Mail, Date) VALUES (:ID, :Sender, :Reciever, :Subject, :Mail, now())");
		$mailres->execute(array(
						'ID'=>$this->getMailId(),
						'Sender'=>$this->getUserSession(),
						'Reciever'=>$this->getMailReciever(),
						'Subject'=>$this->getMailSubject(),
						'Mail'=>$this->getMailMessage()
		));
		if($mailres){
			echo $mailsentalert;
		}
		else{
			echo $mailfalert;
		}
	}
	
	public function DeleteMail(){
		include "connect.php";
		include "alerts.php";
		
		$deletemail = $pdo->prepare("DELETE FROM maildetails WHERE ID=:ID AND Reciever=:Reciever");
		$deletemail->execute(array(
							'ID'=>$this->getMailId(),
							'Reciever'=>$this->getUserSession()
							));
		if(!$deletemail){
		echo $maildelfalert;
		exit();
		}
		}
		
	public function DeleteAllMail(){
		include "connect.php";
		include "alerts.php";
		
		$deleteallmail = $pdo->prepare("DELETE FROM maildetails WHERE Reciever=:Reciever");
		$deleteallmail->execute(array('Reciever'=>$this->getMailReciever()));
		if($deleteallmail){
		echo $allmaildelalert;
		exit();
		}
		else{
		echo $maildelfalert;
		exit();
		}
	}
	
	public function AllMailRead(){
		include "connect.php";
		include "alerts.php";
		
		$readallmail = $pdo->prepare("UPDATE maildetails SET Status='R' WHERE Reciever=:Reciever");
		$readallmail->execute(array(
							'Reciever'=>$this->getMailReciever()
							));
		if($readallmail){
		echo $mailreadalert;
		exit();
		}
		else{
		echo $mailreadfalert;
		exit();
		}
	}
}
?>
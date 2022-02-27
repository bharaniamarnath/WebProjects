<?php
class message{

	private $UserSession;
	private $PostMessage;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getPostMessage(){
		return $this->PostMessage;
	}	
	public function setPostMessage($PostMessage){
		$this->PostMessage = $PostMessage;
	}
	
	public function InsertMessage(){
		include "connect.php";
		include "alerts.php";
		
		$pstquery = $pdo->prepare("INSERT INTO messages (UserID, Message, Time) VALUES (:UserID, :Message, now())");
		$pstquery->execute(array(
						'UserID'=>$this->getUserSession(), 
						'Message'=>$this->getPostMessage()
		));
		if(!$pstquery){
		echo $msgerralert;
		}
	}

	
	public function InsertBulletin(){
		include "connect.php";
		include "alerts.php";
		
		$pstquery = $pdo->prepare("INSERT INTO bulletin (UserID, Message, Time) VALUES (:UserID, :Message, now())");
		$pstquery->execute(array(
						'UserID'=>$this->getUserSession(),
						'Message'=>$this->getPostMessage() 
		));
		if(!$pstquery){
			echo $msgerralert;
		}
	}
	
	public function DeleteMessage(){
		include "connect.php";
		include "alerts.php";
		
		$delmsg = $pdo->prepare("DELETE FROM messages WHERE Time=:Time AND UserID=:UserID");
		$delmsg->execute(array(
						'Time'=>$this->getPostMessage(),
						'UserID'=>$this->getUserSession()
						));
		if(!$delmsg){
			echo $delpostalert;
		}
	}
	
	public function DeleteBulletin(){
		include "connect.php";
		include "alerts.php";
		
		$delmsg = $pdo->prepare("DELETE FROM bulletin WHERE Time=:Time AND UserID=:UserID");
		$delmsg->execute(array(
						'Time'=>$this->getPostMessage(),
						'UserID'=>$this->getUserSession()
						));
		if(!$delmsg){
			echo $delpostalert;		
		}
	}
}
?>
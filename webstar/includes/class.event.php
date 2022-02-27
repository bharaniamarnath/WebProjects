<?php
class event{
	
	private $UserSession;
	private $EventName;
	private $EventDay;
	private $EventType;
	private $EventDescription;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getEventName(){
		return $this->EventName;
	}	
	public function setEventName($EventName){
		$this->EventName = $EventName;
	}
	
	public function getEventDay(){
		return $this->EventDay;
	}	
	public function setEventDay($EventDay){
		$this->EventDay = $EventDay;
	}
	
	public function getEventType(){
		return $this->EventType;
	}	
	public function setEventType($EventType){
		$this->EventType = $EventType;
	}
	
	public function getEventDescription(){
		return $this->EventDescription;
	}	
	public function setEventDescription($EventDescription){
		$this->EventDescription = $EventDescription;
	}
	
	public function InsertEvent(){
		include "connect.php";
		include "alerts.php";
		$chkevent = $pdo->prepare("SELECT * FROM events WHERE UserID=:UserID AND Event=:Event");
		$chkevent->execute(array(
						'UserID'=>$this->getUserSession(),
						'Event'=>$this->getEventName()
		));
		if($chkevent->rowCount()==1){
			echo $eventexstalert;
			exit();
		}
		$insertevent = $pdo->prepare("INSERT INTO events (UserID, Event, Date, Type, Description,Included) VALUES (:UserID, :Event, :Date, :Type, :Description, now())");
		$insertevent->execute(array(
							'UserID'=>$this->getUserSession(),
							'Event'=>$this->getEventName(),
							'Date'=>$this->getEventDay(),
							'Type'=>$this->getEventType(),
							'Description'=>$this->getEventDescription()
		));
		if($insertevent){
			echo $eventaddalert;
		}
		else{
			echo $eventaddfalert;
		}
	}
	
	public function DeleteEvent(){
			include "connect.php";
			include "alerts.php";
			
			$delevnt = $pdo->prepare("DELETE FROM events WHERE events.UserID=:UserID AND events.Event=:Event AND events.Date=:Date");
			$delevnt->execute(array(
							'UserID'=>$this->getUserSession(),
							'Event'=>$this->getEventName(),
							'Date'=>$this->getEventDay()
							));
			if(!$delevnt){
				echo $evntdelfalert;
			}
	}
}
?>
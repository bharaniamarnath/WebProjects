<?php
class group{

	private $UserSession;
	private $GroupId;
	private $GroupName;
	private $GroupType;
	private $GroupDescription;
	private $GroupAdmin;
	private $GroupImage;
	private $GroupThumb;
	private $PostId;
	private $PostMessage;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getGroupId(){
		return $this->GroupId;
	}	
	public function setGroupId($GroupId){
		$this->GroupId = $GroupId;
	}
	
	public function getGroupName(){
		return $this->GroupName;
	}	
	public function setGroupName($GroupName){
		$this->GroupName = $GroupName;
	}
	
	public function getGroupType(){
		return $this->GroupType;
	}	
	public function setGroupType($GroupType){
		$this->GroupType = $GroupType;
	}
	
	public function getGroupDescription(){
		return $this->GroupDescription;
	}	
	public function setGroupDescription($GroupDescription){
		$this->GroupDescription = $GroupDescription;
	}
		
	public function getGroupImage(){
		return $this->GroupImage;
	}	
	public function setGroupImage($GroupImage){
		$this->GroupImage = $GroupImage;
	}
	
	public function getGroupThumb(){
		return $this->GroupThumb;
	}	
	public function setGroupThumb($GroupThumb){
		$this->GroupThumb = $GroupThumb;
	}
	
	public function getPostId(){
		return $this->PostId;
	}	
	public function setPostId($PostId){
		$this->PostId = $PostId;
	}
	
	public function getPostMessage(){
		return $this->PostMessage;
	}	
	public function setPostMessage($PostMessage){
		$this->PostMessage = $PostMessage;
	}
	
	public function CreateGroup(){
		include "connect.php";
		include "alerts.php";
		
		$grpquery = $pdo->prepare("INSERT INTO groups (ID, Name, Type, Description, UserID, Image, Thumb, Date) VALUES (:ID, :Name, :Type, :Description, :UserID, :Image, :Thumb, now())");
		$grpquery->execute(array(
						'ID'=>$this->getGroupId(),
						'Name'=>$this->getGroupName(),
						'Type'=>$this->getGroupType(),
						'Description'=>$this->getGroupDescription(),
						'UserID'=>$this->getUserSession(),
						'Image'=>$this->getGroupImage(),
						'Thumb'=>$this->getGroupThumb()
		));
		if($grpquery){
		echo $groupalert;
		exit();
		}	
		else{
		echo $groupfailalert;
		exit();
		}
	}
	
	public function JoinGroup(){
		include "connect.php";
		include "alerts.php";
		
		$joingrp = $pdo->prepare("INSERT INTO groupmembers (ID, UserID, Date) VALUES (:ID, :UserID, now())");
		$joingrp->execute(array(
						'ID'=>$this->getGroupId(), 
						'UserID'=>$this->getUserSession()
						));
		if($joingrp){
		echo $groupjoinalert;
		exit();
		}
		else{
		echo $groupjoinfailalert;
		exit();
		}
	}
	
	public function UnjoinGroup(){
		include "connect.php";
		include "alerts.php";
		
		$unjoingrp = $pdo->prepare("DELETE FROM groupmembers WHERE UserID=:UserID AND ID=:ID");
		$unjoingrp->execute(array(
								'UserID'=>$this->getUserSession(),
								'ID'=>$this->getGroupId()
								));
		if($unjoingrp){
		echo $groupunjoinalert;
		exit();
		}
		else{
		echo $groupunjoinfailalert;
		exit();
		}
	}
	
	public function InsertGroupPost(){
		include "connect.php";
		include "alerts.php";
		
		$postgroup = $pdo->prepare("INSERT INTO groupmessages (ID, GroupID, UserID, Post, Date) VALUES (:ID, :GroupID, :UserID, :Post, now())");
		$postgroup->execute(array(
						'ID'=>$this->getPostId(), 
						'GroupID'=>$this->getGroupId(), 
						'UserID'=>$this->getUserSession(), 
						'Post'=>$this->getPostMessage()
						));
		if(!$postgroup){
			echo $gpostfailalert;
			exit();
		}
	}
	
	public function DeleteGroupPost(){
		include "connect.php";
		include "alerts.php";
		
		$delmsg = $pdo->prepare("DELETE FROM groupmessages WHERE ID=:ID AND UserID=:UserID");
		$delmsg->execute(array(
						'ID'=>$this->getPostId(),
						'UserID'=>$this->getUserSession()
						));
		if(!$delmsg){
			echo $delpostalert;		
		}
	}
	
	public function UploadGroupPostImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO groupphotos (ID, GroupID, UserID, Photo, Thumb, Date) VALUES (:ID, :GroupID, :UserID, :Photo, :Thumb, now())");
		$imgquery->execute(array(
						'ID'=>$this->getPostId(),
						'GroupID'=>$this->getGroupId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getGroupImage(),
						'Thumb'=>$this->getGroupThumb()
		));
		$psttquery = $pdo->prepare("INSERT INTO groupmessages (ID, GroupID, UserID, Post, Date) VALUES (:ID, :GroupID, :UserID, :Post, now())");
		$psttquery->execute(array(
						'ID'=>$this->getPostId(),
						'GroupID'=>$this->getGroupId(),
						'UserID'=>$this->getUserSession(), 
						'Post'=>$this->getPostMessage()
		));
		if($imgquery && $psttquery){
		header("Location: viewgroup.php?vgrpid=" . $this->getGroupId());
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
}
?>
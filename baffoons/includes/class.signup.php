<?php
class signup{
	private $UserId, $FirstName, $LastName, $Gender, $Dob, $UserName, $Password, $Email;
	
	public function getUserId(){
		return $this->UserId;
	}
	public function setUserId($UserId){
		$this->UserId = $UserId;
	}
	
	public function getFirstName(){
		return $this->FirstName;
	}
	public function setFirstName($FirstName){
		$this->FirstName = $FirstName;
	}
	
	public function getLastName(){
		return $this->LastName;
	}
	public function setLastName($LastName){
		$this->LastName = $LastName;
	}
	
	public function getGender(){
		return $this->Gender;
	}
	public function setGender($Gender){
		$this->Gender = $Gender;
	}
	
	public function getDob(){
		return $this->Dob;
	}
	public function setDob($Dob){
		$this->Dob = $Dob;
	}
	
	public function getUserName(){
		return $this->UserName;
	}
	public function setUserName($UserName){
		$this->UserName = $UserName;
	}
	
	public function getPassword(){
		return $this->Password;
	}
	public function setPassword($Password){
		$this->Password = $Password;
	}
	
	public function getEmail(){
		return $this->Email;
	}
	public function setEmail($Email){
		$this->Email = $Email;
	}
	
	public function SignUpUser(){
		include "connect.php";
		include "alerts.php";
		$query = $pdo->prepare("INSERT INTO userdetails (UserID, Firstname, Lastname, Gender, Dob, Username, Password, Email, Created) VALUES (:UserID, :Firstname, :Lastname, :Gender, :Dob, :Username, :Password, :Email, now())");
		$query->execute(array(
						'UserID'=>$this->getUserId(), 
						'Firstname'=>$this->getFirstName(), 
						'Lastname'=>$this->getLastName(), 
						'Gender'=>$this->getGender(), 
						'Dob'=>$this->getDob(), 
						'Username'=>$this->getUserName(), 
						'Password'=>$this->getPassword(), 
						'Email'=>$this->getEmail()
					));
		$pdquery = $pdo->prepare("INSERT INTO personaldetails (UserID) VALUES (:ID)");
		$pdquery->execute(array(
						'ID'=>$this->getUserId(), 
						));
		$fdquery = $pdo->prepare("INSERT INTO favorites (UserID) VALUES (:UserID)");
		$fdquery->execute(array(
						'UserID'=>$this->getUserId()
						));
		$idquery = $pdo->prepare("INSERT INTO imagedetails (UserID, Image, Thumb) VALUES (:UserID, :Image, :Thumb)");
		$idquery->execute(array(
						'UserID'=>$this->getUserId(), 
						'Image'=>'album/userprofile.png', 
						'Thumb'=>'album/thumbs/userprofile.png'
						));
		if($query && $pdquery && $fdquery && $idquery){
			echo $regconfalert;
		}
		else{
		echo $regerroralert;
		}
	}
}
?>
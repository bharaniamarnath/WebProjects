<?php
class signin{
	private $UserName, $UserPassword, $UserId;
	
	public function getUserName(){
		return $this->UserName;
	}
	public function setUserName($UserName){
		$this->UserName = $UserName;
	}
	
	public function getUserPassword(){
		return $this->UserPassword;
	}
	public function setUserPassword($UserPassword){
		$this->UserPassword = $UserPassword;
	}
	
	public function getUserId(){
		return $this->UserId;
	}
	public function setUserId($UserId){
		$this->UserId = $UserId;
	}
	
	public function UserSignIn(){
		include "connect.php";
		include "alerts.php";
		
		$reqUser = $pdo->prepare("SELECT * FROM userdetails WHERE Username=:Username AND Password=:Password");
		$reqUser->execute(array(
						'Username'=>$this->getUserName(),
						'Password'=>$this->getUserPassword()
						)); 
		if($reqUser->rowCount() == 0){
				echo $logerroralert;
		}
		else{
			while($data = $reqUser->fetch()){
				$this->setUserId($data['UserID']);
				$_SESSION['user'] = $this->getUserId();
				header("Location: main.php");
			}
		}
	}
}
?>
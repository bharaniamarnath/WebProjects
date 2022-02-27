<?php
class update{
	
	private $UserSession;
	private $AccountId;
	private $Username;
	private $OldPassword;
	private $NewPassword;
	
	public function getUserSession(){
		return $this->UserSession;
	}
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getAccountId(){
		return $this->AccountId;
	}
	public function setAccountId($AccountId){
		$this->AccountId = $AccountId;
	}
	
	public function getUsername(){
		return $this->Username;
	}
	public function setUsername($Username){
		$this->Username = $Username;
	}
	
	public function getOldPassword(){
		return $this->OldPassword;
	}
	public function setOldPassword($OldPassword){
		$this->OldPassword = $OldPassword;
	}
	
	public function getNewPassword(){
		return $this->NewPassword;
	}
	public function setNewPassword($NewPassword){
		$this->NewPassword = $NewPassword;
	}
	
	public function UpdateAccount(){
		include "connect.php";
		include "alerts.php";
		
		$chkuname = $pdo->prepare("SELECT * FROM userdetails WHERE Username=:Username AND ID!=:ID");
		$chkuname->execute(array(
						'Username'=>$this->getUsername(),
						'ID'=>$this->getAccountId()
						));
		if($chkuname->rowCount() == 1){
		echo $unameexistalert;
		exit();
		}
		$chkpass = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
		$chkpass->execute(array('UserID'=>$this->getAccountId()));
		$pphrase = $chkpass->fetch();
		$compass = $pphrase['Password'];
		
		if($this->getOldPassword() != $compass){
		echo $wrongpassalert;
		exit();
		}
		
		$accupd = $pdo->prepare("UPDATE userdetails SET Username=:Username, Password=:Password WHERE UserID=:UserID");
		$accupd->execute(array(
						'Username'=>$this->getUsername(),
						'Password'=>$this->getNewPassword(),
						'UserID'=>$this->getAccountId()
		));
		
		if($accupd){
		echo $accupdconalert;
		exit();
		}
		else{
		echo $accupdfailalert;
		exit();	
		}
	
	}
	
	public function UpdatePassword(){
		include "connect.php";
		include "alerts.php";
		
		$updatepw = $pdo->prepare("UPDATE userdetails SET Password=:Password WHERE Username=:Username");
		$updatepw->execute(array(
						'Password'=>$this->getNewPassword(),
						'Username'=>$this->getUsername()
						));
		if($updatepw){
			echo $nwpwconfalert;
			exit();
		}
		else {
			echo $newpwfailalert;
			exit();
		}
	}
	
	public function DeleteAccount(){
		include "connect.php";
		include "alerts.php";
		
		$delimgd = $pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
		$delimgd->execute(array('UserID'=>$this->getAccountId()));
		while($irow = $delimgd->fetch()){
		$imgdel = $irow['Image'];
		$imgtdel = $irow['Thumb'];
		unlink($imgdel);
		unlink($imgtdel);
		}

		
		$delprph = $pdo->prepare("SELECT * FROM photodetails WHERE UserID=:UserID");
		$delprph->execute(array('UserID'=>$this->getAccountId()));
		while($phrow = $delprph->fetch()){
			$prphlink = $phrow['Photo'];
			$prphtlink = $phrow['Thumb'];
			unlink($prphlink);
			unlink($prphtlink);
		}
		
		$delpuph = $pdo->prepare("SELECT * FROM publicphotos WHERE UserID=:UserID");
		$delpuph->execute(array('UserID'=>$this->getAccountId()));
		while($purow = $delpuph->fetch()){
			$puphlink = $purow['Photo'];
			$puphtlink = $purow['Thumb'];
			unlink($puphlink);
			unlink($puphtlink);
		}
	
		$delgph = $pdo->prepare("SELECT * FROM groups WHERE UserID=:UserID");
		$delgph->execute(array('UserID'=>$this->getAccountId()));
		while($grow = $delgph->fetch()){
			$gphlink = $grow['Image'];
			$gphtlink = $grow['Thumb'];
			unlink($gphlink);
			unlink($gphtlink);
		}
		
		$deleteacc = $pdo->prepare("DELETE FROM userdetails WHERE UserID=:UserID");
		$deleteacc->execute(array('UserID'=>$this->getAccountId()));
		
		if($delimgd && $delprph && $delpuph && $delgph && $deleteacc){
		echo $accdeletealert;
		exit();
		}
		else{
		echo $accdeletefailalert;
		exit();
		}
	}
	
}
?>
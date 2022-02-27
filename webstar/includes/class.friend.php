<?php
class friend{

	private $UserSession;
	private $RequestName;
	private $FriendRequest;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getRequestName(){
		return $this->RequestName;
	}	
	public function setRequestName($RequestName){
		$this->RequestName = $RequestName;
	}
	
	public function getFriendRequest(){
		return $this->FriendRequest;
	}	
	public function setFriendRequest($FriendRequest){
		$this->FriendRequest = $FriendRequest;
	}
	
	public function SendRequest(){
		include "connect.php";
		include "alerts.php";
		$chkfrnd = $pdo->prepare("SELECT * FROM friends WHERE friends.Username=':Username AND friends.Friend=:Friend");
		$chkfrnd->execute(array(
						'Username'=>$this->getUserSession(),
						'Friend'=>$this->getRequestName()
		));
		if($chkfrnd->rowCount()==1){
			echo $frndexstalert;
			exit();
		}
		$chkreq = $pdo->prepare("SELECT * FROM requests WHERE UserID=:UserID AND Requested=:Requested");
		$chkreq->execute(array(
						'UserID'=>$this->getUserSession(),
						'Requested'=>$this->getRequestName()
		));
		if($chkreq->rowCount()==1){
			echo $rasalert;
			exit();
		}
		$rqsnddt = $pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
		$rqsnddt->execute(array(
						'UserID'=>$this->getUserSession()
		));
		while($rqsrow = $rqsnddt->fetch()){
			$rqsid = $rqsrow['UserID'];
		}
		$rsquery = $pdo->prepare("INSERT INTO requests (ID, UserID, Requested, Date) VALUES (:ID, :UserID, :Requested, now())");
		$rsquery->execute(array(
						'ID'=>$rqsid,
						'UserID'=>$this->getUserSession(),
						'Requested'=>$this->getRequestName()
		));
		if($rsquery){
			echo $fqsalert;
		}
		else{
			echo $fqsfalert;
		}
	}
	
	public function AddFriend(){
		include "connect.php";
		include "alerts.php";
		
		$frndexst = $pdo->prepare("SELECT * FROM friends WHERE UserID=:UserID AND Friend=:Friend");
		$frndexst->execute(array(
						'UserID'=>$this->getUserSession(),
						'Friend'=>$this->getFriendRequest()
		));
		if($frndexst->rowCount()==1){
			echo $frndexstalert;
			exit();
		}
		$addfr = $pdo->prepare("INSERT INTO friends (UserID, Friend) VALUES (:UserID, :Friend)");
		$addfr->execute(array(
						'UserID'=>$this->getUserSession(),
						'Friend'=>$this->getFriendRequest()
		));
		$addfragn = $pdo->prepare("INSERT INTO friends (UserID, Friend) VALUES (:Friend, :UserID)");
		$addfragn->execute(array(
						'Friend'=>$this->getFriendRequest(),
						'UserID'=>$this->getUserSession()						
		));
		$remreq = $pdo->prepare("DELETE FROM requests WHERE Requested=:Requested AND UserID=:UserID");
		$remreq->execute(array(
						'Requested'=>$this->getUserSession(),
						'UserID'=>$this->getFriendRequest()										
		));
		if($addfr && $addfragn && $remreq){		
			echo $frndaddalert;
		}
		else{
			echo $frndfailalert;
			
		}
		}
		
		public function DeleteFriend(){
			include "connect.php";
			include "alerts.php";
			
			$delfrnd = $pdo->prepare("DELETE from friends WHERE Friend=:Friend AND UserID=:UserID");
			$delfrnd->execute(array(
							'Friend'=>$this->getRequestName(),
							'UserID'=>$this->getUserSession()
							));
			$delfromfrnd = $pdo->prepare("DELETE from friends WHERE Friend=:Friend AND UserID=:UserID");
			$delfromfrnd->execute(array(
								'Friend'=>$this->getUserSession(),
								'UserID'=>$this->getRequestName()
								));
			if($delfrnd && $delfromfrnd){
				echo $frnddelalert;
			}
			else{
				echo $errdelfralert;
			}
		}
		
		public function DeleteRequest(){
			include "connect.php";
			include "alerts.php";
			
			$delreq = $pdo->prepare("DELETE from requests WHERE Requested=:Requested AND requests.UserID=:UserID");
			$delreq->execute(array(
							'Requested'=>$this->getUserSession(),
							'UserID'=>$this->getRequestName()
							));
			if(!$delfrnd){
				echo $reqdelfralert;
			}
		}
}
?>
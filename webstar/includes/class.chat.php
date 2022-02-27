<?php
class chat{
		private $ChatId,$ChatUserId,$ChatText;
		
		public function getChatId(){
			return $this->ChatId;
		}
		public function setChatId(){
			$this->ChatId = $ChatId;
		}
		
		public function getChatUserId(){
			return $this->ChatUserId;
		}
		public function setChatUserId($ChatUserId){
			$this->ChatUserId = $ChatUserId;
		}
		
		public function getChatText(){
			return $this->ChatText;
		}
		public function setChatText($ChatText){
			$this->ChatText = $ChatText;
		}
		
		public function InsertChatMessages(){
			include "connect.php";
			$req=$pdo->prepare("INSERT INTO chats(ChatUserId,ChatText) VALUES (:ChatUserId,:ChatText)");
			$req->execute(array(
						'ChatUserId'=>$this->getChatUserId(),
						'ChatText'=>$this->getChatText()
			));
		}
		
		public function DisplayMessage(){
			include "connect.php";
			$ChatReq=$pdo->prepare("SELECT * FROM chats ORDER BY ChatId DESC");
			$ChatReq->execute();
			while($DataChat=$ChatReq->fetch()){
				$UserReq=$pdo->prepare("SELECT * FROM userdetails WHERE UserID=:UserID");
				$UserReq->execute(array(
								'UserID'=>$DataChat['ChatUserId']
				));
				$DataUser=$UserReq->fetch();
				$ImageReq=$pdo->prepare("SELECT * FROM imagedetails WHERE UserID=:UserID");
				$ImageReq->execute(array(
								'UserID'=>$DataChat['ChatUserId']
				));
				$ImageUser=$ImageReq->fetch();
				echo "<div id='chatbox'><img src='".$ImageUser['Thumb']."' /><p>" . $DataUser['Username'] . "</p><br />";
				echo "<font>" . $DataChat['ChatText'] . "</font></div>";
			}
		}
	}
?>
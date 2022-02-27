<?php
class validateAddMessage{
	
	private $titleError, $messageError, $addMessageSuccess, $addMessageFailed;
	
	public function validateTitle($nmtitle){
		if($nmtitle == ''){
			$this->titleError = "Message title is required";
			return false;
		}
		else if(strlen($nmtitle) > 30){
			$this->titleError = "Only 30 characters allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateMessage($nmmessage){
		if($nmmessage == ''){
			$this->messageError = "Message content is required";
			return false;
		}
		else if(strlen($nmmessage) > 1024){
			$this->messageError = "Only 1024 characters allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function addMessage($nmtitle, $nmmessage){
		include('connect.php');
		$mid = rand(000000,999999);
		$addmsg = $pdo->prepare("INSERT INTO messages (mid,mtitle,message) VALUES (:mid,:mtitle,:message)");
		$addmsg->execute(array(
						"mid"=>$mid,
						"mtitle"=>$nmtitle,
						"message"=>$nmmessage
						));
		if($addmsg){
			$this->addMessageSuccess = "New message added successfully";
			return true;
		}
		else{
			$this->addMessageFailed = "Failed to add the new message";
			return false;
		}
	}
	
	//Errors and Exceptions
	
	public function titleError(){
		return $this->titleError;
	}
	
	public function messageError(){
		return $this->messageError;
	}
	
	public function addMessageSuccess(){
		return $this->addMessageSuccess;
	}
	
	public function addMessageFailed(){
		return $this->addMessageFailed;
	}
}
?>
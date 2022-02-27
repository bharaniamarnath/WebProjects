<?php
class photos{
	
	private $UserSession;
	private $ImageId;
	private $ImageTarget;
	private $ImageThumb;
	private $ImageFileName;
	private $ImageDescription;
	private $CommentId;
	private $ImageComment;
	private $CommentDate;
	private $ImageVote;
	private $PostTarget;
	
	public function getUserSession(){
		return $this->UserSession;
	}	
	public function setUserSession($UserSession){
		$this->UserSession = $UserSession;
	}
	
	public function getImageId(){
		return $this->ImageId;
	}	
	public function setImageId($ImageId){
		$this->ImageId = $ImageId;
	}
	
	public function getImageTarget(){
		return $this->ImageTarget;
	}	
	public function setImageTarget($ImageTarget){
		$this->ImageTarget = $ImageTarget;
	}
	
	public function getImageThumb(){
		return $this->ImageThumb;
	}	
	public function setImageThumb($ImageThumb){
		$this->ImageThumb = $ImageThumb;
	}
	
	public function getImageFileName(){
		return $this->ImageFileName;
	}	
	public function setImageFileName($ImageFileName){
		$this->ImageFileName = $ImageFileName;
	}
	
	public function getImageDescription(){
		return $this->ImageDescription;
	}	
	public function setImageDescription($ImageDescription){
		$this->ImageDescription = $ImageDescription;
	}
	
	public function getCommentId(){
		return $this->CommentId;
	}	
	public function setCommentId($CommentId){
		$this->CommentId = $CommentId;
	}
	
	public function getImageComment(){
		return $this->ImageComment;
	}	
	public function setImageComment($ImageComment){
		$this->ImageComment = $ImageComment;
	}
	
	public function getCommentDate(){
		return $this->CommentDate;
	}	
	public function setCommentDate($CommentDate){
		$this->CommentDate = $CommentDate;
	}
	
	public function getImageVote(){
		return $this->ImageVote;
	}	
	public function setImageVote($ImageVote){
		$this->ImageVote = $ImageVote;
	}
	
	public function getPostTarget(){
		return $this->PostTarget;
	}	
	public function setPostTarget($PostTarget){
		$this->PostTarget = $PostTarget;
	}
	
	public function UploadImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO photodetails (ID, UserID, Photo, Thumb, Filename, Description, Date) VALUES (:ID, :UserID, :Photo, :Thumb, :Filename, :Description, now())");
		$imgquery->execute(array(
						'ID'=>$this->getImageId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb(),
						'Filename'=>$this->getImageFileName(),
						'Description'=>$this->getImageDescription()
		));
		if($imgquery){
		echo $photoulalert;
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
	
	public function UploadPublicImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO publicphotos (ID, UserID, Photo, Thumb, Filename, Description, Date) VALUES (:ID, :UserID, :Photo, :Thumb, :Filename, :Description, now())");
		$imgquery->execute(array(
						'ID'=>$this->getImageId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb(),
						'Filename'=>$this->getImageFileName(),
						'Description'=>$this->getImageDescription()
		));
		if($imgquery){
		echo $puphotoulalert;
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
	
	public function ImageDelete(){
		include "connect.php";
		include "alerts.php";
		
		$delpic = $pdo->prepare("DELETE FROM photodetails WHERE Photo=:Photo AND UserID=:UserID");
		$delpic->execute(array(
						'Photo'=>$this->getImageId(),
						'UserID'=>$this->getUserSession()
						));
		$image = rawurldecode(basename($this->getImageId()));
		@unlink("./photos/" . $image);
		@unlink("./photos/thumbs/" . $image);
		if(!$delpic){
			echo $delpicalert;		
		}
	}
	
	public function InsertComment(){
		include "connect.php";
		include "alerts.php";
		
		$cpquery = $pdo->prepare("INSERT INTO photocomments (ID, UserID, PhotoID, Comment, Date) VALUES (:ID, :UserID, :PhotoID, :Comment, now())");
		$cpquery->execute(array(
						'ID'=>$this->getCommentId(), 
						'UserID'=>$this->getUserSession(), 
						'PhotoID'=>$this->getImageId(), 
						'Comment'=>$this->getImageComment()
						));
		if(!$cpquery){
			echo $commfailalert;
		} 
	}
	
	public function DeleteComment(){
		include "connect.php";
		include "alerts.php";
		
		$delcomm = $pdo->prepare("DELETE FROM photocomments WHERE Date=:Date AND UserID=:UserID");
		$delcomm->execute(array(
							'Date'=>$this->getCommentDate(),
							'Username'=>$this->getUserSession()
							));
		if(!$delcomm){			
			echo $commdelfalert;
		}
	}
	
	public function UpdateImageDetail(){
		include "connect.php";
		include "alerts.php";
		
		$updpic = $pdo->prepare("UPDATE photodetails SET Filename=:Filename, Description=:Description, Date=now() WHERE ID=:ID");
		$updpic->execute(array(
						'Filename'=>$this->getImageFileName(),
						'Description'=>$this->getImageDescription(),
						'ID'=>$this->getImageId()
						));
		if($updpic){
			echo $photoupdalert;
		}
		else{
			echo $photoupdfalert;
		}
	}
	
	public function DeletePublicImage(){
		include "connect.php";
		include "alerts.php";
		
		$delmsg = $pdo->prepare("DELETE FROM publicphotos WHERE Photo=:Photo AND UserID=:UserID");
		$delmsg->execute(array(
						'Photo'=>$this->getImageId(),
						'UserID'=>$this->getUserSession()
						));
		$image = rawurldecode(basename($this->getImageId()));
		@unlink("./publicphotos/" . $image);
		@unlink("./publicphotos/thumbs/" . $image);
		if($delmsg){
			header("Location: mypublicphotos.php");
		}
		else{
			echo $delpicalert;
			
		}
	}
	
	public function InsertVote(){
		include "connect.php";
		include "alerts.php";
		
		$addvote = $pdo->prepare("INSERT INTO publicvotes (ID, UserID) VALUES (:ID, :UserID)");
		$addvote->execute(array(
						'ID'=>$this->getImageVote(),
						'UserID'=>$this->getUserSession()
						));
		if($addvote){
			header("Location: publicphotoview.php?photoid=".$this->getImageVote());
		}		
		else{
			echo $votefalert;
		}
	}
	
	public function UploadPostImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO photodetails (ID, UserID, Photo, Thumb, Date) VALUES (:ID, :UserID, :Photo, :Thumb, now())");
		$imgquery->execute(array(
						'ID'=>$this->getImageId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb()
		));
		$psttquery = $pdo->prepare("INSERT INTO messages (UserID, Message, Time) VALUES (:UserID, :Message, now())");
		$psttquery->execute(array(
						'UserID'=>$this->getUserSession(), 
						'Message'=>$this->getPostTarget()
		));
		if($imgquery && $psttquery){
		header("Location: main.php");
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
	
	public function UploadFriendPostImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO photodetails (ID, UserID, Photo, Thumb, Date) VALUES (:ID, :UserID, :Photo, :Thumb, now())");
		$imgquery->execute(array(
						'ID'=>$this->getImageId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb()
		));
		$psttquery = $pdo->prepare("INSERT INTO messages (UserID, Message, Time) VALUES (:UserID, :Message, now())");
		$psttquery->execute(array(
						'UserID'=>$this->getUserSession(), 
						'Message'=>$this->getPostTarget()
		));
		if($imgquery && $psttquery){
		header("Location: friendboard.php");
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
	
	public function UploadPublicPostImage(){
		include "connect.php";
		include "alerts.php";
		
		$imgquery = $pdo->prepare("INSERT INTO publicphotos (ID, UserID, Photo, Thumb, Date) VALUES (:ID, :UserID, :Photo, :Thumb, now())");
		$imgquery->execute(array(
						'ID'=>$this->getImageId(),
						'UserID'=>$this->getUserSession(),
						'Photo'=>$this->getImageTarget(),
						'Thumb'=>$this->getImageThumb()
		));
		$psttquery = $pdo->prepare("INSERT INTO bulletin (UserID, Message, Time) VALUES (:UserID, :Message, now())");
		$psttquery->execute(array(
						'UserID'=>$this->getUserSession(), 
						'Message'=>$this->getPostTarget()
		));
		if($imgquery && $psttquery){
		header("Location: publicpost.php");
		exit();
		}	
		else{
		echo $photoalert;
		exit();
		}
	}
}
?>
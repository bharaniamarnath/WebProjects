<?php
class validateProductDescription{
	private $descriptionImageErr, $descriptionImageValidateError, $descriptionImageSuccess, $descriptionImageFailed;
	
	public function validateDescriptionImage($file_size,$size_limit){
		if($file_size == 0){
			$this->imageValidateError = "Product image is required";
			return false;
		}
		else if($file_size >= $size_limit){
			$this->descriptionImageValidateError = "Product image size is too large";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateDescriptionImageUpload($imgid,$file_size,$size_limit,$source,$target,$file_type){
			$stop = '0';
			if($file_size >= $size_limit) :
			$this->imageErr = "Image file size is too large";
			return false;
			else :
			if($file_type == 'image/jpeg' || $file_type == 'image/jpg'):
			move_uploaded_file($source, $target);
			elseif($file_type == 'image/png'):
			move_uploaded_file($source, $target);
			elseif($file_type == 'image/gif'):
			move_uploaded_file($source, $target);
			endif;
			endif;


			$imagepath = "$imgid.png";
			$save = "../images/descriptions/" . $imagepath; //This is the new file you saving
			$file = "../images/descriptions/" . $imagepath; //This is the original file
			$x = @getimagesize($file); 
			switch($x[2]) { 
			case 1: 
			$image = imagecreatefromgif($file); 
			break; 
			case 2: 
			$image = imagecreatefromjpeg($file);
			break; 
			case 3: 
			$image = imagecreatefrompng($file);  
			break; 
			default: 
			$this->imageErr = "Error in uploading image";
			return false;
			$stop = '1';
			break;
			} 
			if($stop != 1) {
			list($width, $height) = getimagesize($file) ; 

			$modwidth = $width;

			$diff = $width / $modwidth;

			$modheight = $height / $diff; 
			$tn = imagecreatetruecolor($modwidth, $modheight) ; 
			/*
			$file_type = $file_type;
			if($file_type == "image/jpeg" || $file_type == "image/jpg") :
			$image = imagecreatefromjpeg($file);
			elseif($file_type == "image/x-png" || $file_type == "image/png") :
			$image = imagecreatefrompng($file);
			elseif($file_type == "image/gif") :
			$image = imagecreatefromgif($file);
			else : 
			echo 'Invalid type';
			endif;*/

			imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

			imagejpeg($tn, $save, 100) ; 

			$save = "../images/descriptions/thumbs/" . $imagepath; //This is the new file you saving
			$file = "../images/descriptions/" . $imagepath; //This is the original file

			list($width, $height) = getimagesize($file) ; 

			$modwidth = 300; 

			$diff = $width / $modwidth;

			$modheight = $height / $diff; 
			$tn = imagecreatetruecolor($modwidth, $modheight) ; 
			$x = @getimagesize($file); 
			switch($x[2]) { 
			case 1: 
			$image = imagecreatefromgif($file); 
			break; 
			case 2: 
			$image = imagecreatefromjpeg($file);
			break; 
			case 3: 
			$image = imagecreatefrompng($file);  
			break; 
			default: 
			$this->imageErr = "Error in uploading image";
			return false;
			} 
			imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

			imagejpeg($tn, $save, 100) ; 
		}
	}
	
	public function addDescriptionImage($proid,$imgid,$imgpath){
		include('connect.php');
		$updateimg = $pdo->prepare("INSERT INTO descriptions (pid,imageid,link) VALUES (:pid,:imageid,:link)");
		$updateimg->execute(array(
							"pid"=>$proid,
							"imageid"=>$imgid,
							"link"=>$imgpath
							));
		if($updateimg){
			$this->descriptionImageSuccess = "Image added to product descriptions";
			return true;
		}
		else{
			$this->descriptionImageFailed = "Error occurred. Could not add image to product descriptions";
			return false;
		}
	}
	
//Errors and Exceptions

	public function descriptionImageValidateError(){
		return $this->descriptionImageValidateError;
	}
	public function descriptionImageError(){
		return $this->descriptionImageErr;
	}
	public function descriptionImageSuccess(){
		return $this->descriptionImageSuccess;
	}
	public function descriptionImageFailed(){
		return $this->descriptionImageFailed;
	}
}
?>
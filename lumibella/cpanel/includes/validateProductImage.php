<?php
class validateProductImage{
	private $imageErr;
	
	public function validateImageUpload($pid,$psection,$pcategory,$psubcategory,$file_size,$size_limit,$source,$target,$file_type){
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


			$imagepath = "$pid.jpg";
			$save = "../images/products/$psection/$pcategory/$psubcategory/" . $imagepath; //This is the new file you saving
			$file = "../images/products/$psection/$pcategory/$psubcategory/" . $imagepath; //This is the original file
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

			$save = "../images/products/$psection/$pcategory/$psubcategory/thumbs/" . $imagepath; //This is the new file you saving
			$file = "../images/products/$psection/$pcategory/$psubcategory/" . $imagepath; //This is the original file

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
	
//Errors and Exceptions

	public function imageError(){
		return $this->imageErr;
	}
}
?>
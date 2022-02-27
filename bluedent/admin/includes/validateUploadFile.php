<?php
class validateUploadFile{
	
	private $filenameError, $filecategoryError, $filesizeError, $fileuploadSuccess, $fileuploadFailed;

	public function validateFileName($fname){
		if($fname == ''){
			$this->filenameError = "File name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z0-9' ]*$#", $fname)){
			$this->filenameError = "Special characters not allowed";
			return false;
		}
		else if(strlen($fname) > 128){
			$this->filenameError = "File name can have only 128 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateFileCategory($filecategory){
		if($filecategory == ''){
			$this->filecategoryError = "File category is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateFileSize($file_size){
		if($file_size == 0){
			$this->filesizeError = "File is required to upload";
			return false;
		}
		else{
			return true;
		}
	}
	

	public function validateAddFile($fid,$fname,$fcategory,$tmp_name,$uploadpath,$filepath){
		if(move_uploaded_file($tmp_name,$uploadpath)){
			include('connect.php');
			$addfile = $pdo->prepare("INSERT INTO downloads(fid,name,category,link) VALUES (:fid,:name,:category,:link)");
			$addfile->execute(array(
							"fid"=>$fid,
							"name"=>$fname,
							"category"=>$fcategory,
							"link"=>$filepath
							));
			if($addfile->rowCount() > 0){
				$this->fileuploadSuccess = "File ". $fname ." uploaded to database.";
				return true;
			}
			else{
				$this->fileuploadFailed = "Error occurred. Unable to upload the file";
				return false;
			}
		}
	}
	
	//Errors and Exceptions
	
	public function filenameErr(){
		return $this->filenameError;
	}
	
	public function filecategoryErr(){
		return $this->filecategoryError;
	}
	
	public function filesizeErr(){
		return $this->filesizeError;
	}
	
	public function fileUploadSuccess(){
		return $this->fileuploadSuccess;
	}

	public function fileUploadFailed(){
		return $this->fileuploadFailed;
	}
}	
?>
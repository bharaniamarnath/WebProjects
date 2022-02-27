<?php
class validateAddProduct{
	private $pnameError, $pcategoryError, $psubcategoryError, $pgroupError, $pdescError, $pimageError, $proaddSuccess, $proaddFailed;
	
	public function validateName($pname){
		if($pname == ''){
			$this->pnameError = "Product name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z0-9' ]*$#", $pname)){
			$this->pnameError = "Special characters not allowed";
			return false;
		}
		else if(strlen($pname) > 128){
			$this->pnameError = "Product name can have only 128 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateCategory($pcategory){
		if($pcategory == ''){
			$this->pcategoryError = "Product category is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateSubCategory($psubcategory){
		if($psubcategory == ''){
			$this->psubcategoryError = "Product subcategory is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateGroup($pgroup){
		if(!preg_match("#^[-A-Za-z0-9'+., ]*$#", $pgroup)){
			$this->pgroupError = "Special characters not allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateDescription($pdescription){
		if($pdescription == ''){
			$this->pdescError = "Description is required";
			return false;
		}
		else if(strlen($pdescription) > 1024){
			$this->pdescError = "Product description can have only 1024 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateImage($file_size,$size_limit){
		if($file_size == 0){
			$this->pimageError = "Product image is required";
			return false;
		}
		else if($file_size >= $size_limit){
			$this->pimageError = "Product image size is too large";
			return false;
		}
		else{
			return true;
		}
	}

	public function addProduct($pid,$pname,$pcategory,$psubcategory,$pgroup,$pdescription,$imgpath,$imgthumbpath){
		include('connect.php');
		$addproduct = $pdo->prepare("INSERT INTO products (pid,name,category,subcategory,classified,description,image,thumb) VALUES (:id,:name,:category,:subcategory,:classified,:description,:image,:thumb)");
		$addproduct->execute(array(
							"id"=>$pid,
							"name"=>$pname,
							"category"=>$pcategory,
							"subcategory"=>$psubcategory,
							"classified"=>$pgroup,
							"description"=>$pdescription,
							"image"=>$imgpath,
							"thumb"=>$imgthumbpath
							));
		if($addproduct->rowCount() > 0){
			$this->proaddSuccess = "Product - " . $pname . " added to the database";
			return true;
		}
		else{
			$this->proaddFailed = "Error adding product - " . $pname . " to the database";
			return false;
		}
	}
	
//Errors and Exceptions

	public function pnameErr(){
		return $this->pnameError;
	}
	
	public function pcategoryErr(){
		return $this->pcategoryError;
	}

	public function psubcategoryErr(){
		return $this->psubcategoryError;
	}
	
	public function pgroupErr(){
		return $this->pgroupError;
	}
	
	public function pdescErr(){
		return $this->pdescError;
	}
	
	public function pimageErr(){
		return $this->pimageError;
	}
	
	public function proAddSuccess(){
		return $this->proaddSuccess;
	}
	
	public function proAddFailed(){
		return $this->proaddFailed;
	}
}
?>
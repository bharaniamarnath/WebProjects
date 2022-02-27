<?php
class validateUpdateProduct{
	private $pnameError, $pcategoryError, $psubcategoryError, $pgroupError, $pdescError, $proupdateSuccess, $proupdateFailed;
	
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
			$this->ptypeError = "Product subcategory is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateGroup($pgroup){
		if(!preg_match("#^[-A-Za-z0-9'+., ]*$#", $pgroup)){
			$this->pcombinationError = "Special characters not allowed";
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
		else if(strlen($pdescription) > 10000){
			$this->pdescError = "Product description can have only 10000 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function updateProduct($pid,$pname,$pcategory,$psubcategory,$pgroup,$pdescription,$imgpath,$imgthumbpath){
		include('connect.php');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			$updateproduct = $pdo->prepare("UPDATE products SET name=:name, category=:category, subcategory=:subcategory, classified=:classified, description=:description, image=:image, thumb=:thumb, date=date WHERE pid=:pid");
			$updateproduct->execute(array(
								"name"=>$pname,
								"category"=>$pcategory,
								"subcategory"=>$psubcategory,
								"classified"=>$pgroup,
								"description"=>$pdescription,
								"image"=>$imgpath,
								"thumb"=>$imgthumbpath,
								"pid"=>$pid
								));
			if($updateproduct->rowCount() > 0){
				$this->proupdateSuccess = "Product - " . $pname . " details updated to the database";
				return true;
			}
			else{
				$this->proupdateFailed = "Error updating product or null update on product - " . $pname . " to the database";
				return false;
			}
		}catch(PDOException $e){
			die($e->getMessage());
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
	
	public function proUpdateSuccess(){
		return $this->proupdateSuccess;
	}
	
	public function proUpdateFailed(){
		return $this->proupdateFailed;
	}
}
?>
<?php
class validateAddBrand{
	private $brandAddSuccess, $brandAddFailed, $brandError, $duplicateError;
	
	
	public function validateBrand($brand){
		if($brand == ''){
			$this->brandError = "Brand name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z' ]*$#", $brand)){
			$this->brandError = "Numeric or special characters are not allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	
	public function validateDuplicateBrand($brand){
		include('connect.php');
		$checkbrand = $pdo->prepare("SELECT * FROM brands WHERE brandname=:brand");
		$checkbrand->execute(array(
								"brand"=>$brand
								));
		if($checkbrand->rowCount() > 0){
			$this->duplicateError = "Brand - " . $brand . " already exists";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function addNewBrand($brand){
		include('connect.php');
		$brandid = sprintf("%06d",mt_rand(100000,999999));
		$insertbrand = $pdo->prepare("INSERT INTO brands (brandid,brandname) VALUES (:id,:brand)");
		$insertbrand->execute(array(
								"id"=>$brandid,
								"brand"=>$brand
								));
		if($insertbrand){
			$this->brandAddSuccess = "New brand - " . $brand . " has been added to database";
			return true;
		}
		else{
			$this->brandAddFailed = "Error in adding new brand. Try again or later";
			return false;
		}
	}
	
//Errors and Exceptions

	public function brandErr(){
		return $this->brandError;
	}

	
	public function brandAddSuccess(){
		return $this->brandAddSuccess;
	}
	
	public function duplicateErr(){
		return $this->duplicateError;
	}
	
	public function brandAddFailed(){
		return $this->brandAddFailed;
	}
}
?>
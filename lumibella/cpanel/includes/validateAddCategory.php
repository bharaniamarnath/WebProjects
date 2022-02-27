<?php
class validateAddCategory{
	private $categoryAddSuccess, $categoryAddFailed, $sectionError, $categoryError, $subcategoryError, $duplicateError;
	
	public function validateSection($section){
		if($section == ''){
			$this->sectionError = "Section is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateCategory($category){
		if($category == ''){
			$this->categoryError = "Category is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z' ]*$#", $category)){
			$this->categoryError = "Numeric or special characters are not allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateSubcategory($subcategory){
		if($subcategory == ''){
			$this->subcategoryError = "Subcategory is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z' ]*$#", $subcategory)){
			$this->subcategoryError = "Numeric or special characters are not allowed";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateDuplicateCategory($section, $category, $subcategory){
		include('connect.php');
		$checkcategory = $pdo->prepare("SELECT * FROM categories WHERE section=:section AND category=:category AND subcategory=:subcategory");
		$checkcategory->execute(array(
								"section"=>$section,
								"category"=>$category,
								"subcategory"=>$subcategory
								));
		if($checkcategory->rowCount() > 0){
			$this->duplicateError = "Category " . $subcategory . " - " . $category . " already exists in section - " . $section;
			return false;
		}
		else{
			return true;
		}
	}
	
	public function addNewCategory($section, $category, $subcategory){
		include('connect.php');
		$catid = sprintf("%06d",mt_rand(100000,999999));
		$insertcategory = $pdo->prepare("INSERT INTO categories (categoryid,section,category,subcategory) VALUES (:id,:section,:category,:subcategory)");
		$insertcategory->execute(array(
								"id"=>$catid,
								"section"=>$section,
								"category"=>$category,
								"subcategory"=>$subcategory
								));
		if($insertcategory){
			$this->categoryAddSuccess = "New category " . $subcategory . " - " . $category . " has been added to section - " . $section;
			return true;
		}
		else{
			$this->categoryAddFailed = "Error in adding new category. Try again or later";
			return false;
		}
	}
	
//Errors and Exceptions

	public function sectionErr(){
		return $this->sectionError;
	}

	public function categoryErr(){
		return $this->categoryError;
	}
	
	public function subcategoryErr(){
		return $this->subcategoryError;
	}
	
	public function categoryAddSuccess(){
		return $this->categoryAddSuccess;
	}
	
	public function duplicateErr(){
		return $this->duplicateError;
	}
	
	public function categoryAddFailed(){
		return $this->categoryAddFailed;
	}
}
?>
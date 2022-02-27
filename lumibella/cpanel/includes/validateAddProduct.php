<?php
class validateAddProduct{
	private $pnameError, $psectionError, $pcategoryError, $psubcatError, $pbrandError, $pdescError, $ppriceError, $pstockError, $pimageError, $proexistError, $proaddSuccess, $proaddFailed;
	
	public function validateName($pname){
		if($pname == ''){
			$this->pnameError = "Product name is required";
			return false;
		}
		else if(!preg_match("#^[-A-Za-z0-9' ]*$#", $pname)){
			$this->pnameError = "Special characters not allowed";
			return false;
		}
		else if(strlen($pname) > 25){
			$this->pnameError = "Product name can have only 20 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateSection($psection){
		if($psection == ''){
			$this->psectionError = "Product section is required";
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
	
	public function validateSubcategory($psubcategory){
		if($psubcategory == ''){
			$this->psubcatError = "Product subcategory is required";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateBrand($pbrand){
		if($pbrand == ''){
			$this->pbrandError = "Product brand is required";
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
		else if(strlen($pdescription) > 50){
			$this->pdescError = "Product description can have only 50 characters";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validatePrice($pprice){
		if($pprice == ''){
			$this->ppriceError = "Price is required";
			return false;
		}
		else if(!is_numeric($pprice)){
			$this->ppriceError = "Price can only be in numerical digits";
			return false;
		}
		else if($pprice%1!=0){
			$this->ppriceError = "Price must be in decimal value";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function validateStock($pstock){
		if($pstock == ''){
			$this->pstockError = "Stock Quantity is required";
			return false;
		}
		else if(!is_numeric($pstock)){
			$this->pstockError = "Stock Quantity can only be in numerical digits";
			return false;
		}
		else if($pstock%1!=0){
			$this->pstockError = "Stock Quantity must be in decimal value";
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
	
	public function getCategoryID($psection,$pcategory,$psubcategory){
		include('connect.php');
		$checkcat = $pdo->prepare("SELECT * FROM categories WHERE section=:section AND category=:category AND subcategory=:subcategory");
		$checkcat->execute(array(
						"section"=>$psection,
						"category"=>$pcategory,
						"subcategory"=>$psubcategory
						));
		$ccget = $checkcat->fetch();
		$ccid = $ccget['categoryid'];
		
		return $ccid;
	}
	
	public function getBrandID($pbrand){
		include('connect.php');
		$getbrand = $pdo->prepare("SELECT * FROM brands WHERE brandname=:brandname");
		$getbrand->execute(array(
						"brandname"=>$pbrand
						));
		$gbdet = $getbrand->fetch();
		$brid = $gbdet['brandid'];
		
		return $brid;
	}
	
	public function checkProduct($pname,$getCategoryID){
		include('connect.php');
		$checkpro = $pdo->prepare("SELECT * FROM products WHERE pname=:pname AND pcategory=:pcategory LIMIT 1");
		$checkpro->execute(array(
						"pname"=>$pname,
						"pcategory"=>$getCategoryID
						));
		if($checkpro->rowCount() > 0){
			$this->proexistError = "Similar product already exists in database";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function addProduct($pid,$pname,$getCategoryID,$pdescription,$getBrandID,$pprice,$pstock,$imgpath,$imgthumbpath){
		include('connect.php');
		$addproduct = $pdo->prepare("INSERT INTO products (pid,pname,pcategory,pdescription,pprice,pbrand,pimage,pthumb) VALUES (:id,:name,:category,:description,:price,:brand,:image,:thumb)");
		$addproduct->execute(array(
							"id"=>$pid,
							"name"=>$pname,
							"category"=>$getCategoryID,
							"description"=>$pdescription,
							"price"=>$pprice,
							"brand"=>$getBrandID,
							"image"=>$imgpath,
							"thumb"=>$imgthumbpath
							));
		$rtotal = 1;
		$rcount = 1;
		$addrate = $pdo->prepare("INSERT INTO ratings(pid, rtotal, rcount) VALUES (:pid, :rtotal, :rcount)");
		$addrate->execute(array(
						"pid"=>$pid,
						"rtotal"=>$rtotal,
						"rcount"=>$rcount
						));
		$addstock = $pdo->prepare("INSERT INTO stocks(pid, quantity) VALUES (:pid, :quantity)");
		$addstock->execute(array(
						"pid"=>$pid,
						"quantity"=>$pstock
						));
		if($addproduct){
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
	
	public function psectionErr(){
		return $this->psectionError;
	}
	
	public function pcategoryErr(){
		return $this->pcategoryError;
	}
	
	public function psubcatErr(){
		return $this->psubcatError;
	}
	
	public function pbrandErr(){
		return $this->pbrandError;
	}
	
	public function pdescErr(){
		return $this->pdescError;
	}
	
	public function ppriceErr(){
		return $this->ppriceError;
	}
	
	public function pstockErr(){
		return $this->pstockError;
	}
	
	public function pimageErr(){
		return $this->pimageError;
	}
	
	public function proexistErr(){
		return $this->proexistError;
	}
	
	public function proAddSuccess(){
		return $this->proaddSuccess;
	}
	
	public function proAddFailed(){
		return $this->proaddFailed;
	}
}
?>
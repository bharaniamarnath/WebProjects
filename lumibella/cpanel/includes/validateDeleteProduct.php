<?php
class validateDeleteProduct{
	private $delSuccessStatus, $delFailedStatus;
	
	public function deleteProduct($delpid){
		include('connect.php');
		//Fetch category ID from products
		$procat = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
		$procat->execute(array("pid"=>$delpid));
		$rowpro = $procat->fetch();
		$proname = $rowpro['pname'];
		$procategory = $rowpro['pcategory'];
		//Fetch section details from categories
		$prosection = $pdo->prepare("SELECT * FROM categories WHERE categoryid=:catid");
		$prosection->execute(array("catid"=>$procategory));
		$rowcat = $prosection->fetch();
		$prosecname = $rowcat['section'];
		$procatname = $rowcat['category'];
		$prosubcatname = $rowcat['subcategory'];
		//Delete product images from section path
		$proimgpath = "../images/products/$prosecname/$procatname/$prosubcatname/$delpid.jpg";
		$prothumbimg = "../images/products/$prosecname/$procatname/$prosubcatname/thumbs/$delpid.jpg";
		if(file_exists($proimgpath)){
			unlink($proimgpath);
			unlink($prothumbimg);
			$delpro = $pdo->prepare("DELETE FROM products WHERE pid=:pid");
			$delpro->execute(array("pid"=>$delpid));
			$delstock = $pdo->prepare("DELETE FROM stocks WHERE pid=:pid");
			$delstock->execute(array("pid"=>$delpid));
			$delrating = $pdo->prepare("DELETE FROM ratings WHERE pid=:pid");
			$delrating->execute(array("pid"=>$delpid));
			if($delpro){
				$this->delSuccessStatus = "Product " . $proname . " has been deleted from database";
				return true;
			}
			else{
				$this->delFailedStatus = "Error. Product " . $proname . " could not be deleted from database" . mysql_error();
				return false;
			}
		}
	}
	
	//Errors and Exceptions
	
	public function deleteSuccess(){
		return $this->delSuccessStatus;
	}
	
	public function deleteFailed(){
		return $this->delFailedStatus;
	}
}
?>
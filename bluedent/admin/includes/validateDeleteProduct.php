<?php
class validateDeleteProduct{
	private $delSuccessStatus, $delFailedStatus;
	
	public function deleteProduct($delpid){
		include('connect.php');
		//Fetch category ID from products
		$prodet = $pdo->prepare("SELECT * FROM products WHERE pid=:pid");
		$prodet->execute(array("pid"=>$delpid));
		$rowpro = $prodet->fetch();
		$proname = $rowpro['name'];
		$procatname = $rowpro['category'];
		$prosubcatname = $rowpro['subcategory'];
		//Delete product images from section path
		$proimgpath = "../images/products/$procatname/".str_replace(" ","-",$prosubcatname)."/$delpid.png";
		$prothumbimg = "../images/products/$procatname/".str_replace(" ","-",$prosubcatname)."/thumbs/$delpid.png";
		if(file_exists($proimgpath)){
			unlink($proimgpath);
			unlink($prothumbimg);
			$delpro = $pdo->prepare("DELETE FROM products WHERE pid=:pid");
			$delpro->execute(array("pid"=>$delpid));
			if($delpro->rowCount() > 0){
				$delgal = $pdo->prepare("SELECT * FROM gallery WHERE pid=:pid");
				$delgal->execute(array("pid"=>$productid));
				while($rowgal = $delgal->fetch()){
				$galimgid = $rowgal['imageid'];
				$galimgpath = $rowgal['link'];
				$galthumbimgpath = "images/gallery/thumbs/$galimgid.png";
				if(file_exists($galimgpath)){
				if(file_exists($galthumbimgpath)){
				unlink($galimgpath);
				unlink($galthumbimgpath);
				}
				}
				}
				$deldimg = $pdo->prepare("SELECT * FROM descriptions WHERE pid=:pid");
				$deldimg->execute(array("pid"=>$productid));
				while($rowdimg = $deldimg->fetch()){
				$descimgid = $rowdimg['imageid'];
				$descimgpath = $rowdimg['link'];
				$descthumbimgpath = "images/descriptions/thumbs/$galimgid.png";
				if(file_exists($descimgpath)){
				if(file_exists($descthumbimgpath)){
				unlink($descimgpath);
				unlink($descthumbimgpath);
				}
				}
				}
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
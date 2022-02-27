<?php
class validateDeleteDescriptionImage{
	private $deleteDescriptionImageSuccess, $deleteDescriptionImageFailed;
	public function deleteDescriptionImage($imageid){
		$imgpath = "../images/descriptions/$imageid.png";
		$thumbimgpath = "../images/descriptions/thumbs/$imageid.png";
		if(file_exists($imgpath)){
			if(file_exists($thumbimgpath)){
				unlink($imgpath);
				unlink($thumbimgpath);
				include('connect.php');
				$delimg = $pdo->prepare("DELETE FROM descriptions WHERE imageid=:imageid");
				$delimg->execute(array("imageid"=>$imageid));
				if($delimg){
					$this->deleteDescriptionImageSuccess = "Image $imageid deleted from product description";
					return true;
				}
				else{
					$this->deleteDescriptionImageFailed = "Error occurred. Image $imageid could not be deleted from product description";
					return true;
				}
			}
		}
	}
	
	public function deleteDescriptionImageSuccess(){
		return $this->deleteDescriptionImageSuccess;
	}
	
	public function deleteDescriptionImageFailed(){
		return $this->deleteDescriptionImageFailed;
	}
}
?>

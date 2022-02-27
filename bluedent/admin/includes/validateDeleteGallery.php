<?php
class validateDeleteGallery{
	private $deleteGallerySuccess, $deleteGalleryFailed;
	public function deleteGallery($imageid){
		$imgpath = "../images/gallery/$imageid.png";
		$thumbimgpath = "../images/gallery/thumbs/$imageid.png";
		if(file_exists($imgpath)){
			if(file_exists($thumbimgpath)){
				unlink($imgpath);
				unlink($thumbimgpath);
				include('connect.php');
				$delimg = $pdo->prepare("DELETE FROM gallery WHERE imageid=:imageid");
				$delimg->execute(array("imageid"=>$imageid));
				if($delimg){
					$this->deleteGallerySuccess = "Image $imageid deleted from product gallery";
					return true;
				}
				else{
					$this->deleteGalleryFailed = "Error occurred. Image $imageid could not be deleted from product gallery";
					return true;
				}
			}
		}
	}
	
	public function deleteGallerySuccess(){
		return $this->deleteGallerySuccess;
	}
	
	public function deleteGalleryFailed(){
		return $this->deleteGalleryFailed;
	}
}
?>

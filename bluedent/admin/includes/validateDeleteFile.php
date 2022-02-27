<?php
class validateDeleteFile{
	
	private $deletefileSuccess, $deletefileFailed;
	
	public function deleteFile($fileid){
		include('connect.php');
		$selfile = $pdo->prepare("SELECT * FROM downloads WHERE fid=:fid");
		$selfile->execute(array("fid"=>$fileid));
		while($frow = $selfile->fetch()){
			$filelink = $frow['link'];
			$filename = $frow['name'];
			$filepath = "../".$filelink;
			if(file_exists($filepath)){
				unlink($filepath);
				$delfile = $pdo->prepare("DELETE FROM downloads WHERE fid=:fid");
				$delfile->execute(array("fid"=>$fileid));
				if($delfile->rowCount() > 0){
					$this->deletefileSuccess = "File " . $filename . " deleted from database";
					return true;
				}
				else{
					$this->deletefileFailed = "Error occurred. Unable to delete the file";
					return false;
				}
			}
		}
	}
	
	//Errors and Exception
	
	public function deleteFileSuccess(){
		return $this->deletefileSuccess;
	}
	
	public function deleteFileFailed(){
		return $this->deletefileFailed;
	}

}
?>
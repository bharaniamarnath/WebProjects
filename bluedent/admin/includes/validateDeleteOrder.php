<?php
class validateDeleteOrder{
	
	private $deleteorderSuccess, $deleteorderFailed;
	
	public function deleteOrder($deloid){
		include('connect.php');
		$remord = $pdo->prepare("DELETE FROM orders WHERE oid=:oid");
		$remord->execute(array("oid"=>$deloid));
		$remordac = $pdo->prepare("DELETE FROM delivery WHERE oid=:oid");
		$remordac->execute(array("oid"=>$deloid));
		if($remord->rowCount() > 0 && $remordac->rowCount() > 0){
			$this->deleteorderSuccess = "Order ID: <b>$deloid</b> removed from database.";
			return true;
		}
		else{
			$this->deleteorderFailed = "Error Occurred. Could not delete order " . $deloid . " from database";
			return false;
		}
	}
	
	//Errors and Exceptions
	
	public function deleteOrderSuccess(){
		return $this->deleteorderSuccess;
	}
	
	public function deleteOrderFailed(){
		return $this->deleteorderFailed;
	}
}
?>
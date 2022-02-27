<?php
class validateCancelOrder{
	private $cancelStatus;
	
	public function cancelOrder($coid){
		include('connect.php');
		//update stock before deleting order
		$getorderdetail = $pdo->prepare("SELECT orderid,productid,quantity FROM orderdetail WHERE orderid=:oid");
		$getorderdetail->execute(array("oid"=>$coid));
		while($getod = $getorderdetail->fetch()){
			$goid = $getod['orderid'];
			$gpid = $getod['productid'];
			$gqnty = $getod['quantity'];
			$updatestock = $pdo->prepare("UPDATE stocks SET quantity = quantity + $gqnty WHERE pid=:pid");
			$updatestock->execute(array("pid"=>$gpid));
		}
		//delete order delivery address details
		$remdeliverydetails = $pdo->prepare("DELETE FROM orderdelivery WHERE orderid=:orderid");
		$remdeliverydetails->execute(array("orderid"=>$coid));
		//delete order from main order table
		$deleteorderdetail = $pdo->prepare("DELETE FROM orderdetail WHERE orderid=:orderid");
		$deleteorderdetail->execute(array("orderid"=>$coid));
		$deleteorder = $pdo->prepare("DELETE FROM orders WHERE orderid=:orderid");
		$deleteorder->execute(array("orderid"=>$coid));
		//check if deleted
		if($updatestock && $remdeliverydetails && $deleteorderdetail){
			$this->cancelStatus = "Order " . $coid . " has been cancelled and deleted from record";
			return true;
		}
		else{
			$this->cancelStatus = "Error. Unable to cancel/delete the order " . $coid . " from the record due to technical issues";
			return false;
		}
	}
	
	//Errors and Exceptions
	
	public function cancelOrderErr(){
		return $this->cancelStatus;
	}
}
?>
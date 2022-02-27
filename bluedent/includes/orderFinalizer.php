<?php
class orderFinalizer{
	
	private $orderErr;
			
	public function placeOrderDetails($doid){
		include("connect.php");
		$max = count($_SESSION['cart']);
		$count = 0;
		$pdo->beginTransaction();
		for($i=0;$i<$max;$i++){
			$pid = $_SESSION['cart'][$i]['pid'];
			$pqty = $_SESSION['cart'][$i]['pq'];
				$insertitems = $pdo->prepare("INSERT INTO orders (oid,pid,quantity) VALUES (:doid,:pid,:qnty)");
				$iiexecute = $insertitems->execute(array(
									"doid"=>$doid,
									"pid"=>$pid,
									"qnty"=>$pqty
									));
		}
		$pdo->commit();
		if(!$insertitems){
			$this->orderErr = "<b>This order was unable to be placed during checkout. Contact us for more details.";
			return false;
		}
		else{
			return true;
		}
	}
	
	public function placeOrderDelivery($coid,$csid,$cname,$cemail,$cphone,$caddress,$cpincode){
		include("connect.php");
		$insertdelivery = $pdo->prepare("INSERT INTO delivery (oid,cid,name,address,pincode,phone,email) VALUES (:oid,:cid,:cname,:caddress,:cpincode,:cphone,:cemail)");
		$idexecute = $insertdelivery->execute(array(
								"oid"=>$coid,
								"cid"=>$csid,
								"cname"=>$cname,
								"caddress"=>$caddress,
								"cphone"=>$cphone,
								"cemail"=>$cemail,
								"cpincode"=>$cpincode
								));
		if($idexecute == true){
			return true;
		}
		else{
			$this->orderErr = "Error in placing the order delivery. Try again later or contact us for more details";
			return false;
		}
	}
	
// Errors and Exceptions

	public function orderError(){
		return $this->orderErr;
	}
}
?>
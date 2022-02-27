<?php
class orderFinalizer{
	
	private $orderErr;
	private $cancelleditems = '';
	private $cancelledcount = 0;
			
	public function placeOrderDetails($doid){
		include("connect.php");
		$max = count($_SESSION['cart']);
		$count = 0;
		for($i=0;$i<$max;$i++){
			$pid = $_SESSION['cart'][$i]['pid'];
			$pqty = $_SESSION['cart'][$i]['pq'];
			$checkstock = $pdo->prepare("SELECT * FROM stocks WHERE pid=:spid FOR UPDATE");
			$checkstock->execute(array("spid"=>$pid));
			$getstock = $checkstock->fetch();
			$getq = $getstock['quantity'];
			if($getq < $pqty){
				$this->cancelleditems .= $pid . "_";
				$this->cancelledcount += 1;
			}
			else{
				$getpd = $pdo->prepare("SELECT * FROM products WHERE pid=:id");
				$getpd->execute(array("id"=>$pid));
				$gnrow = $getpd->fetch();
				$price = $gnrow['pprice'];
				$tprice = number_format((float)($price * $pqty),2,'.','');
				$insertitems = $pdo->prepare("INSERT INTO orderdetail (orderid,productid,quantity,price) VALUES (:doid,:pid,:qnty,:price)");
				$iiexecute = $insertitems->execute(array(
									"doid"=>$doid,
									"pid"=>$pid,
									"qnty"=>$pqty,
									"price"=>$tprice
									));
				//update stock
				$substock = $pdo->prepare("SELECT * FROM stocks WHERE pid=:id");
				$substock->execute(array("id"=>$pid));
				$ssrow = $substock->fetch();
				$ssquant = $ssrow['quantity'];
				$subtract = $ssquant - $pqty;
				if($ssquant == 0){
					$subtract = 0;
				}
				else if($subtract < 0){
					$subtract = 0;
				}
				else{
					$updstock = $pdo->prepare("UPDATE stocks SET quantity=:postquant WHERE pid=:pid");
					$usexecute = $updstock->execute(array(
									"postquant"=>$subtract,
									"pid"=>$pid
									));
				}
				if($iiexecute == true){
					$count++;
				}
			}
		}
		if($count == 0){
			$this->orderErr = "<b>This order was unable to be placed during checkout validation. This may be caused due to following:</b><br /><br />1. All the products in the cart have been sold out<br />2. Internal server error during placing order<br />3. Network connection problem during order transaction";
		}
		$arrayValues = array("count"=>$count);
		return $arrayValues;
	}
	
	public function placeOrderDelivery($coid,$csid,$cname,$cemail,$cphone,$caddress,$cpincode){
		include("connect.php");
		$insertdelivery = $pdo->prepare("INSERT INTO orderdelivery (orderid,customerid,name,address,phone,email,pincode) VALUES (:oid,:cid,:cname,:caddress,:cphone,:cemail,:cpincode)");
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
			$this->orderErr = "Error in registering the order delivery. Try again later or contact us for more details";
			return false;
		}
	}
	
	public function placeOrder($poid,$psid){
		include("connect.php");
		$pstat = 0;
		$insertorder = $pdo->prepare("INSERT INTO orders (orderid,customerid,status) VALUES (:poid,:psid,:pstat)");
		$ioexecute = $insertorder->execute(array(
							"poid"=>$poid,
							"psid"=>$psid,
							"pstat"=>$pstat
							));
		if($ioexecute == true){
			return true;
		}
		else{
			$this->orderErr = "Error placing order detail. Try later or contact us for more information";
			return false;
		}
	}
	
// Errors and Exceptions

	public function orderError(){
		return $this->orderErr;
	}
	
	public function cancelledItems(){
		return $this->cancelleditems;
	}
	
	public function cancelledCount(){
		return $this->cancelledcount;
	}
}
?>
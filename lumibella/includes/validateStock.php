<?php
class validateStock{
	private $stockError;
	private $removedItems = '';

	public function checkStockValidate(){
		include('connect.php');

		$max = count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid = $_SESSION['cart'][$i]['pid'];
			$pqty = $_SESSION['cart'][$i]['pq'];
			$getstockval = $pdo->prepare("SELECT * FROM stocks WHERE pid=:pid");
			$getstockval->execute(array("pid"=>$pid));
			$gsvrow = $getstockval->fetch();
			$gsvstock = $gsvrow['quantity'];
			if($gsvstock < $pqty){
				$this->removedItems = $pid . "_";
				removecart($pid);
				$_SESSION['cart'] = array_values($_SESSION['cart']);
			}
		}
		if(empty($_SESSION['cart']) || !isset($_SESSION['cart'])){
			$this->stockError = "<div class='empty-stock-alert'><img class='img-responsive' src='images/contents/empty-cart.png' /><h4><span class='glyphicon glyphicon-exclamation-sign'></span> Sorry! This order cannot be placed or checked out. All the products in your cart were sold out during the check out process. We will notify you when the products you have missed are available. Contact us for more details</h4></div>";
			return false;
		}
		else{
			return true;
		}
	}
	
	//Errors and Exceptions
	
	public function stockError(){
		return $this->stockError;
	}
	
	public function removedItems(){
		return $this->removedItems;
	}

}
?>
<?php
function addcart($pid, $pqty){
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
		$_SESSION['cart'][0]['pid'] = $pid;
		$_SESSION['cart'][0]['pq'] = $pqty;
	}
	else{
		$max = count($_SESSION['cart']);
		if(itemexist($pid)){
			return "Already in cart";
		}
		if(is_array($_SESSION['cart'])){
			$_SESSION['cart'][$max]['pid'] = $pid;
			$_SESSION['cart'][$max]['pq'] = $pqty;
		}
	}
}
function removecart($pid){
	$max = count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid == $_SESSION['cart'][$i]['pid']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart'] = array_values($_SESSION['cart']);
}
function updatecart($pid, $qnty){
	$max = count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($pid == $_SESSION['cart'][$i]['pid']){
			$_SESSION['cart'][$i]['pq'] = $qnty;
			break;
		}
	}
}
function itemexist($pid){
	$max = count($_SESSION['cart']);
	$flag = 0;
	for($i=0; $i<$max; $i++){
		if($pid == $_SESSION['cart'][$i]['pid']){
			$flag = 1;
			break;
		}
	}
	return $flag;
}
?>
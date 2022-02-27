<?php
class activationValidate{

	public function generateKey(){
		$length = 10;
		$alphabets = range('A','Z');
		$numbers = range('0','9');
		$finalarray = array_merge($alphabets, $numbers);
		$generatedkey = '';
		while($length--){
			$key = array_rand($finalarray);
			$generatedkey .= $finalarray[$key];
		}
		return $generatedkey;
	}
	
	public function setActivation($cid, $gkey){
		include('connect.php');
		$insertkey = $pdo->prepare("INSERT INTO activation (cid,aid) VALUES (:id,:activation)");
		$insertkey->execute(array(
							"id"=>$cid,
							"activation"=>$gkey
							));
	}

}
?>
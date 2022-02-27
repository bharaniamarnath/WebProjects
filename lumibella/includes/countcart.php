<?php
session_start();
$noitem = 0;
if(isset($_SESSION['cart'])){
$count = count($_SESSION['cart']);
echo $count;
}
else{
echo $noitem;
}
?>
<?php
session_start();
require_once 'config.php';
if(isset($_SESSION['qadmin']) && $_SESSION['qadmin'] == "qappctrl"){
unset($_SESSION['qadmin']);
session_destroy();
$redir = $BASE_URL . 'index.php?status=2';
header('Location:'.$redir);	
}
else{
$redir = $BASE_URL . 'index.php?err=4';
header('Location:'.$redir);
}
?>
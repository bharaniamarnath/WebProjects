<?php
session_start();
include "includes/class.chat.php";
$suid = $_SESSION['user'];
if(isset($_POST['ChatText'])){
$chat = new chat();
$chat->setChatUserId($suid);
$chat->setChatText($_POST['ChatText']);
$chat->InsertChatMessages();
}
?>
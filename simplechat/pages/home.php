<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Baffoons Chat Homepage</title>
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#ChatText").keyup(function(e){
var ChatText = $("#ChatText").val();
if(e.keyCode == 13){
$.ajax({
type:'POST',
url:'InsertMessage.php',
data:{ChatText:ChatText},
success: function(){
$("#ChatMessages").load("DisplayMessage.php");
$("#ChatText").val("");
}
});
}
});
setInterval(function(){
$("#ChatMessages").load("DisplayMessage.php");
},1500);
$("#ChatMessages").load("DisplayMessage.php");
});
</script>
</head>
<body>
<h3>Welcome <?php echo $_SESSION['UserName']; ?></h3>
<div id="ChatBig">
<div id="ChatMessages">
</div>
<textarea id="ChatText" name="ChatText"></textarea>
</div>
</body>
</html>
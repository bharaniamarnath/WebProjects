<?php
ob_start();
session_start();
include('connect.php');
include('includes/validateAddMessage.php');
if(!isset($_SESSION['admin'])){
header("Location: index.php");
}
//Assign exception variables
$titleError = "";
$messageError = "";
$addMessageStatus = "Status message will be displayed here";
//fetch form variables
if(isset($_POST['addmessage'])){
$nmtitle = trim($_POST['title']);
$nmmessage = trim($_POST['message']);
//create classes and objects
$validateAddMessage = new validateAddMessage();
$validateTitle = $validateAddMessage->validateTitle($nmtitle);
$validateMessage = $validateAddMessage->validateMessage($nmmessage);
if($validateTitle == false){
$titleError = $validateAddMessage->titleError();
}
if($validateMessage == false){
$messageError = $validateAddMessage->messageError();
}
if($validateTitle !== false && $validateMessage !== false){
$addMessage = $validateAddMessage->addMessage($nmtitle, $nmmessage);
if($addMessage == true){
$addMessageStatus = $validateAddMessage->addMessageSuccess();
}
else if($addMessage == false){
$addMessageStatus = $validateAddMessage->addMessageFailed();	
}
else{
$addMessageStatus = "Error occurred. Could not add new message";
}
}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Fashions</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>

<div class="row content">
<h4 class="heading">New Message</h4>
<hr>
<div class="col-md-8 col-lg-8">
<div class="alert alert-info"><?php echo $addMessageStatus; ?></div>
<form action="newmessage.php" method="POST">
<div class="form-group"><label for="Message-Title">Message Title</label><input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" /><span class="exception"><?php echo $titleError; ?></span></div>
<div class="form-group"><label for="Message">Message</label><textarea class="form-control" id="message" name="message" placeholder="Enter Message"></textarea><span class="exception"><?php echo $messageError; ?></span></div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-primary btn-lg pull-right" type="submit" name="addmessage" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add Message</button>
</form>
</div>
</div>

<?php include "footer.php"; ?>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(window).load(function() {
$(".loader").fadeOut("slow");
});
</script>
</body>
</html>
<?php
ob_start();
session_start();
include('connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include "header.php"; ?>


<div class="row content">
<h4 class="heading">Enquiries</h4><hr>
<div class="col-md-12">
<?php
if(isset($_POST['delenq'])){
$geid = $_POST['geid'];
$enqdelete = $pdo->prepare("DELETE FROM enquiries WHERE eid=:geid");
$enqdelete->execute(array("geid"=>$geid));
if($enqdelete){
echo "<div class='alert alert-info alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Enquiry deleted</div>";
}
else{
echo "<div class='alert alert-info'>Error. Could not delete enquiry</div>";
}
}
?>
<?php
$getenquiry = $pdo->prepare("SELECT * FROM enquiries");
$getenquiry->execute();
if($getenquiry->rowCount() == 0){
echo "<div class='alert alert-info'>No enquiries found</div>";
}
else{
while($gerow = $getenquiry->fetch()){
$geid = $gerow['eid'];
$gename = $gerow['ename'];
$gemail = $gerow['email'];
$gephone = $gerow['ephone'];
$genquiry = $gerow['enquiry'];
$gedate = $gerow['added'];
echo "<div class='row'>";
echo "<div class='col-md-8 col-lg-8 enquiry-block'>";
echo "<form action='enquiries.php' method='POST'>";
echo "<input type='hidden' value='$geid' name='geid' />";
echo "<button class='close pull-right' type='submit' name='delenq'>&times;</button></form>";
echo "<h3>Enquiry ID: $geid</h3>";
echo "<p>Sent From: $gename</p>";
echo "<p>Sender Email ID: $gemail</p>";
echo "<p>Sender Contact: $gephone</p>";
echo "<p>Sent on: $gedate</p>";
echo "<p id='emessage'>$genquiry</p>";
echo "</div>";
echo "</div>";
}
}
?>
</div>
</div>

<?php include "footer.php"; ?>

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
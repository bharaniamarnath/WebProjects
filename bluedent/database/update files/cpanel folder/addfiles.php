<?php
ob_start();
session_start();
include('connect.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'><div class='col-md-12'><h2>Add Files</h2></div></div>
<div class="row order">
<div class="col-md-12">
<form action="http://www.bluedentindia.in/uploadfile.php" method="POST" enctype="multipart/form-data">
<table class="table cart"><thead><tr><th colspan="2">Add a File to the Downloads Section</th></tr></thead>
<tr><td>File Name</td><td><input class="form-control" type="text" name="fname" /></td></tr>
<tr><td>Category</td><td><select class="form-control" name="filecategory">
<option value="Catalogue">Catalogue</option>
<option value="Presentation">Presentation</option>
<option value="Video">Video</option>
</select></td></tr>
<tr><td>Upload File</td><td><span class="btn btn-warning btn-file">Browse File<input type="file" name="upfile" id="upfile" /></span></td></tr>
<tr><td colspan="2">
<button class="btn btn-success btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<button class="btn btn-success btn-lg pull-right" type="submit" name="addfile" onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline';">Add File</button></td></tr>
</table>
</form>

<?php
$selcat = $pdo->prepare("SELECT * FROM downloads ORDER BY name ASC");
$selcat->execute();
echo "<table class='table edit-box'><thead><tr><th colspan='3'>File List - Download Section</th></tr></thead><thead><tr><th>File Name</th><th>Category</th><th>Actions</th></tr></thead>";
while($rowcat = $selcat->fetch()){
$fid = $rowcat['fid'];
$fname = $rowcat['name'];
$fcat = $rowcat['category'];
$flink = $rowcat['link'];
//$fsize = filesize($flink);
$fdate = $rowcat['date'];
echo "<tr><td>$fname</td><td>$fcat</td><td><form action='http://www.bluedentindia.in/deletefile.php' method='POST'><input type='hidden' name='fid' value='$fid'><button class='btn btn-danger btn-sm' type='submit' name='deletefile'>Delete</button></form></td></tr>";
}
echo "</table>";
?>

<table class="table cart"><thead><tr><th colspan="2">Instructions to add a file</th></tr></thead>
<tr><td colspan="2"><h4><small>General Formats:</small></h4><ul><li>Enter the appropriate file name for the file to be uploaded</li>
<li>Select the category of the file from the drop-down options before uploading the file.</li></ul>
<h4><small>File Description Formats:</small></h4>
<ul>
<li>Any file format can be uploaded like Images, Documents and Videos.</li>
<li>File size can be only maximum of 100MB </li>
</ul>
</table>

<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='admincontrol.php'>Control Panel</a></td></tr></table>

</div>
</div>
</div>

<?php include('footer.php'); ?>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

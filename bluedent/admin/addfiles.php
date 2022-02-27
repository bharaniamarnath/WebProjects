<?php
ob_start();
session_start();
include('includes/config.php');
include('connect.php');
include('includes/validateUploadFile.php');
include('includes/validateDeleteFile.php');
if(!isset($_SESSION['admin'])){
header('Location: index.php');
exit();
}
//Assign error variables
$filenameErr = '';
$filecategoryErr = '';
$filesizeErr = '';
$fileUploadStatus = '';
//get valuese from html form
if(isset($_REQUEST['addfile'])){
$fid = sprintf("%06d", mt_rand(100000,999999));
$fname = $_POST['filename'];
$fcategory = $_POST['filecategory'];
$name = $_FILES['upfile']['name'];
$tmp_name = $_FILES['upfile']['tmp_name'];
$file_size = $_FILES['upfile']['size'];
$filename = $fid."_".$name;
$filepath = str_replace(" ","_","downloads/$fcategory/$filename");
$uploadpath = str_replace(" ","_","../downloads/$fcategory/$filename");
//create class and objects
$validateUploadFile = new validateUploadFile();
$validateFileName = $validateUploadFile->validateFileName($fname);
$validateFileCategory = $validateUploadFile->validateFileCategory($fcategory);
$validateFileSize = $validateUploadFile->validateFileSize($file_size);
//check if objects are true and add product
if($validateFileName == false){
$filenameErr = $validateUploadFile->filenameErr();
}
if($validateFileCategory == false){
$filecategoryErr = $validateUploadFile->filecategoryErr();
}
if($validateFileSize == false){
$filesizeErr = $validateUploadFile->filesizeErr();
}
if($validateFileName !== false && $validateFileCategory !== false && $validateFileSize !== false){
$validateAddFile = $validateUploadFile->validateAddFile($fid,$fname,$fcategory,$tmp_name,$uploadpath,$filepath);
if($validateAddFile == true){
$fileUploadStatus = $validateUploadFile->fileUploadSuccess();
}
else if($validateAddFile == false){
$fileUploadStatus = $validateUploadFile->fileUploadFailed();
}
else{
$fileUploadStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check the fields below for errors or invalid values entered.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
}
}
}
?>
<!-- Delete File -->
<?php
$deleteFileStatus = '';
//Fetch Delete File Details
if(isset($_REQUEST['delf'])){
$fileid = trim($_REQUEST['delf']);
//Create Class Object
$validateDeleteFile = new validateDeleteFile();
$deleteFile = $validateDeleteFile->deleteFile($fileid);
if($deleteFile == true){
$deleteFileStatus = $validateDeleteFile->deleteFileSuccess();
}
else if($deleteFile == false){
$deleteFileStatus = $validateDeleteFile->deleteFileFailed();
}
else{
$deleteFileStatus = "<b>Error occurred. Either one of the following may have occurred:</b><br />1. Check if the download link is working.<br />2. Server internal error. Try again later. <br />3. Technical issues. Contact web administrator for more information.";
} 
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Bluedent India - Rediscover Dentistry</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="bluedent india, bluedent chennai, rediscover dentistry" />
<meta name="description" content="Welcome to Bluedent India. Rediscover Dentistry.">
<meta name="copyright" content="&copy; Copyright 2014. Bluedent India. All rights reserved.">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
<link rel="shortcut icon" href="<?php echo $CP_URL; ?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $CP_URL; ?>css/style.css" />
</head>
<body>
<div class="container">
<?php include "header.php"; ?>
<div class='row page-title'>
<div class='col-md-12 col-lg-12'>
<h2>Add Files</h2>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<?php 
if($fileUploadStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $fileUploadStatus; ?></div>
<?php
}
?>
<?php 
if($deleteFileStatus !== ''){
?>
<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
<?php echo $deleteFileStatus; ?></div>
<?php
}
?>
<form id="addFileForm" action="<?php echo $CP_URL; ?>addfiles.php" method="POST" enctype="multipart/form-data">
<h4 class="table-heading">Add a File to the Downloads Section</h4>
<div class="form-group"><label for="fname">File Name</label><input class="form-control" type="text" name="filename" id="filename" /></div>
<label class="verror"><?php echo $filenameErr; ?></label>
<div class="form-group"><label for="filecategory">Category</label><select class="form-control" name="filecategory" id="filecategory">
<option value="Catalogue">Catalogue</option>
<option value="Presentation">Presentation</option>
<option value="Video">Video</option>
</select></div>
<label class="verror"><?php echo $filecategoryErr; ?></label>
<div class="form-group"><label for="upfile">Choose File to Upload</label><br /><label class="btn btn-warning btn-file">Browse File<input type="file" name="upfile" id="upfile" /></label></div>
<label class="verror"><?php echo $filesizeErr; ?></label>
<button class="btn btn-success btn-lg pull-right" type="submit" name="addfile" id="addfile">Add File</button>
</form>
</div>
</div>
<div class="row order">
<div class="col-md-12 col-lg-12">
<h4 class="table-heading">File List - Download Section</h4>
<?php
$selcat = $pdo->prepare("SELECT * FROM downloads ORDER BY name ASC");
$selcat->execute();
echo "<table class='table edit-box'><thead><tr><th>File Name</th><th>Category</th><th>Actions</th></tr></thead>";
while($rowcat = $selcat->fetch()){
$fid = $rowcat['fid'];
$fname = $rowcat['name'];
$fcat = $rowcat['category'];
$flink = $rowcat['link'];
//$fsize = filesize($flink);
$fdate = $rowcat['date'];
echo "<tr><td>$fname</td><td>$fcat</td><td><a class='btn btn-danger btn-sm' href='".$CP_URL."addfiles.php?delf=$fid'>Delete</a></td></tr>";
}
echo "</table>";
?>
</div>
</div>

<div class="row order">
<div class="col-md-12 col-lg-12">
<table class="table cart"><thead><tr><th colspan="2">Instructions to add a file</th></tr></thead>
<tr><td colspan="2"><h4><small>General Formats:</small></h4><ul><li>Enter the appropriate file name for the file to be uploaded</li>
<li>Select the category of the file from the drop-down options before uploading the file.</li></ul>
<h4><small>File Description Formats:</small></h4>
<ul>
<li>Any file format can be uploaded like Images, Documents and Videos.</li>
<li>File size depends on the hosting disk space</li>
</ul>
</table>

<table class="table cart"><thead><tr><th colspan="2">Other options</th></tr></thead><tr><td>Go to admin control panel</td><td><a class='btn btn-primary btn-sm' href='dashboard.php'>Control Panel</a></td></tr></table>

</div>
</div>
</div>

<?php include('footer.php'); ?>
</div>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo $CP_URL; ?>js/validateAddFiles.js"></script>
</body>
</html>

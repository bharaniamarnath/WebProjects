<?php
include('includes/connect.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Blood Donation Management Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12 col-lg-12">
<?php
include('includes/header.php');
?>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<h2>Donor login</h2>
<form action="donorlogin.php" method="POST">
<div class="form-group"><label for="username">Username</label>
<input type="text" class="form-control" name="dluname" placeholder="Enter Username" />
</div>
<div class="form-group"><label for="username">Password</label>
<input type="password" class="form-control" name="dlpass" placeholder="Enter Password" />
</div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Login" name="dlogin" id="submit"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>
<br />
<a href="index.php">Go to main index</a>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
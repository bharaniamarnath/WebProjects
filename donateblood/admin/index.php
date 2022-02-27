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
<header>
<h1>Blood Donation Application</h1>
</header>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-6">
<h2>Admin login</h2>
<form action="adminlogin.php" method="POST">
<div class="form-group"><label for="name">Enter Username</label>
<input type="text" name="aluname" class="form-control" placeholder="Enter Username" />
</div>
<div class="form-group"><label for="name">Enter Password</label>
<input type="password" name="alpass" class="form-control" placeholder="Enter Username" />
</div>
<button class="btn btn-primary btn-lg pull-right" id="progressButton" disabled="disabled" style="display:none;">Processing...</button>
<input class="btn btn-primary btn-lg pull-right" type="submit" value="Login" name="alogin" id="submit"  onclick="this.style.display='none'; document.getElementById('progressButton').style.display='inline'"; />
</form>
<br />
<a href="../index.php">Go to main index</a>
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
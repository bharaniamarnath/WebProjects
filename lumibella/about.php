<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Store</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<?php include('header.php'); ?>
<div class="row content animsition fade-in-down">
<div class="col-md-12 col-lg-12">
<h4 class="heading">About Lumibella</h4>
<hr>
<div class="row about">
<div class="col-md-8 col-lg-8  col-md-offset-2 col-lg-offset-2">
<div class="row">
<img class="img-responsive" src="images/contents/about/about-ad-one.jpg" />
</div>
<div class="row">
<h3>Our Fashion</h3>
<hr>
<p>
<?php
$about = simplexml_load_file("xml/about.xml");
echo $about->main;
?>
</p>
</div>
</div>
</div>

<div class="row about">
<div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
<div class="row">
<img class="img-responsive" src="images/contents/about/about-ad-two.jpg" />
</div>
<div class="row">
<h3>Our Style</h3>
<hr>
<p>
<?php
$about = simplexml_load_file("xml/about.xml");
echo $about->vision;
?>
</p>
</div>
</div>
</div>

</div>
</div>
<?php include('footer.php'); ?>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
</body>
</html>
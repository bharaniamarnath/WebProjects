<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Fashions</title>
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
<h4 class="heading">Lumibella FAQs</h4>
<hr>
<?php
$num = 1;
$faqs = simplexml_load_file("xml/faq.xml");
foreach($faqs->faq as $faq){
echo "<div class='faq-block'>";
echo "<h3>" . $faq->question . "</h3>";
echo "<p>" . $faq->answer . "</p>";
echo "</div>";
}
?>
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
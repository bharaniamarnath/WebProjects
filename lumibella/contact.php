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
<h4 class="heading">Contact Us</h4>
<hr>
<div class="contact-ad">
<img class="img-responsive" src="images/contents/contact-ad.jpg" />
<div class="col-md-5 col-lg-5 pull-right contact-ad-block">
<address>
<?php
$contact = simplexml_load_file("xml/contact.xml");
echo "<h2>" .$contact->company. "</h2>";
echo "<p>";
echo $contact->door. "<br>";
echo $contact->street . "<br>";
echo $contact->city . "<br>";
echo $contact->state . "<br><br>";
echo "<b>Mobile: </b>". $contact->mobile ."<br>";
echo "<b>Email: </b>". $contact->email ."<br />";
echo "</p>";
?>
</address>
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
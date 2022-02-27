<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-12">
<?php include('includes/inhead.php'); ?>
<div class="col-md-6 hidden-xs">
<div class="jumbotron jumbo-index">
<h1><small>Welcome to </small>Baffoons!</h1>
<p>Its simply fun!</p>
<p>With baffoon, you can..</p>
<ul>
<li>Post messages, photos or videos on private and public board!</li>
<li>Upload photos to your private profile or upload photos to public!</li>
<li>Personalise your profile to share your interests with others!</li>
<li>Comment and vote on your favorite public photos!</li>
<li>Send private messages to your friends and others!</li>
<li>Search new random people and make friends!</li>
<li>Create or join your favorite communities!</li>
<li>Add personal calendar, events and view your previous activities!</li>
<li>Chat on public with other members with the public chat!</li>
</ul>
</div>
</div>
<div class="col-md-6">
<div class="page-header"><h3>Not a Member ?</h3><h2>Sign Up Now !</h2></div>
<form action="signup.php" method="POST">
<div class="form-group"><label for=" ">First name:</label><input type="text" class="form-control" name="firstname" id="firstname" /></div>	
<div class="form-group"><label for=" ">Last name:</label><input type="text" class="form-control" name="lastname" id="lastname" /></div>
<div class="form-group"><label for=" ">Choose Gender:</label>
<div class="radio">
<label>
<input type="radio" name="gender" value="Male">Male
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="gender" value="Female">Female
</label>
</div>
</div>
<div class="form-group">
<label for=" ">Date of Birth: </label>
<div class="row">
<div class="col-md-4">
<select class="form-control" name="date">
<option value="">Date</option>
<?php for($i=1;$i<=31;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="month">
<option value="">Month</option>
<?php for($i=1;$i<=12;$i++):?>
<option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
<div class="col-md-4">
<select class="form-control" name="year">
<option value="">Year</option>
<?php for($i=date('Y');$i>=1910;$i--):?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php endfor; ?>
</select>
</div>
</div>
</div>
<div class="form-group"><label for=" ">Username:</label><input type="text" class="form-control" name="username" id="username" /></div>
<div class="form-group"><label for=" ">Password:</label><input type="password" class="form-control" name="password" id="password" /></div>
<div class="form-group"><label for=" ">Confirm Password:</label><input type="password" class="form-control" name="confpass" id="confpass" /></div>
<div class="form-group"><label for=" ">Email ID:</label><input type="text" class="form-control" name="mailid" id="mailid" /></div>
<div class="checkbox">
<label>
<input type="checkbox" name="terms" value="Accepted" />Agree to terms & conditions.
</label>
</div>
<div class="form-group"><input type="submit" class="btn btn-danger btn-lg pull-right" name="register" id="register" value="Sign Up" /></div>
</form>
</div>
</div>
</div>
<div class="row footer">
<div class="col-md-12">
<a href="terms.php" class="terms">Terms &amp; Conditions</a> . <a href="about.php" class="terms">About Baffoons</a>
<br />
&copy;Copyrights 2013. Baffoons Network.
</div>
</div>
</div>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
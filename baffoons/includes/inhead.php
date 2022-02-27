<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Baffoons</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="index.php"><img src="images/logo.png"></img></a>
</div>
<div class="navbar-collapse collapse navbar-right">
<form action="signin.php" method="POST" class="navbar-form">
<div class="form-group">
<input type="text" name="uname" id="uname" class="form-control" placeholder="Username" />
<input type="password" name="pswd" id="pswd" class="form-control" placeholder="Password" />
<input class="btn btn-success" type="submit" name="login" id="login" value="Login" /> &nbsp;<a class="linkpage" href="checkuid.php">Help?</a>
</div>
</form>
</div>
</div>
</div>
</body>
</html>
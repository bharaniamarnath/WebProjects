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
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="main.php"><img src="images/logo.png" class="img-responsive" /></a>
</div>
<div class="navbar-collapse collapse navbar-right">
<form action="search.php" method="POST" class="navbar-form navbar-left navbar-input-group" role="search">
<div class="form-group">
<input type="text" name="searchkey" id="search" class="form-control" placeholder="Search members" />
<button class="btn btn-default" type="submit" name="search" role="button"><span class="glyphicon glyphicon-search"></span></button>
</div>
</form>
<ul class="nav navbar-nav">
<li><a href='main.php'><span class='glyphicon glyphicon-home'></span> Home</a></li>
<li><a href='profile.php'><span class='glyphicon glyphicon-user'></span> Profile</a></li>
<li><a href='signout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>
</ul>
</div>
</div>
</div>
</body>
</html>
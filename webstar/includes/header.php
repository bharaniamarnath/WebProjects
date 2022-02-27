<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<title>Baffoons</title>
<head>
<meta name="" content="">
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#menuslider").click(function(){
$("#controlmenu").toggle();
});
});
</script>
</head>
<body oncontextmenu="return false;">
<div class="header">
<div id="inwidth">

<div id="controlmenu">
<input type='button' onClick=parent.location='main.php' value='Home'></input>
<input type='button' onClick=parent.location='profile.php' value='Profile'></input>
<input type='button' onClick=parent.location='friends.php' value='Friends'></input>
<input type='button' onClick=parent.location='photos.php' value='Photos'></input>
<input type='button' onClick=parent.location='inbox.php' value='Mail'></input>
<input type='button' onClick=parent.location='groups.php' value='Groups'></input>
<input type='button' onClick=parent.location='account.php' value='Account'></input>
<input type='button' onClick=parent.location='signout.php' value='Logout'></input>
</div>

<div id="menuslider"><input id="menuicon" type='button' value=''></input></div>
<div class="searchbar"><form action="search.php" method="POST">
<input type="text" name="searchkey" id="search" value="Enter a username, name or email" style="color: #ccc; padding: 5px; margin-top: 5px;" onclick="this.value='';this.style.color='#000';"></input>
<input type="submit" name="search" value="Search" style="padding:6px 10px 6px 10px;" />
</form>
</div>

<a href="main.php"><img src="images/logo.png"></img></a>

</div>
</div>
</body>
</html>
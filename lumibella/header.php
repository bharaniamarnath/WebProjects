<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<div class="row header-block navbar-fixed-top">
<div class="col-md-2 col-lg-2"> 
<a href="index.php"><img class="img-responsive header-logo" src="images/logo/lumibella.png" /></a>
</div>
<div class="col-md-6 col-lg-6 nav-holder">
<!--navbar-->
<div class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="navbar-collapse collapse navbar-right">
<ul class="nav navbar-nav">
<li data-animation="36"><a href="index.php">Index</a></li>
<li><a href="about.php">About Us</a></li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Women <b class="caret"></b></a>
<ul class="dropdown-menu">
<div class="col-md-4 col-lg-4 menu-section">
<h5>Handbags</h5>
<li><a href="products.php?section=Women&category=Handbag&subcategory=Sling">Sling Handbags</a></li>
<li><a href="products.php?section=Women&category=Handbag&subcategory=Tote">Tote Handbags</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Jewelry</h5>
<li><a href="products.php?section=Women&category=Jewelry&subcategory=Bracelet">Bracelets</a></li>
<li><a href="products.php?section=Women&category=Jewelry&subcategory=Necklace">Necklaces</a></li>
<li><a href="products.php?section=Women&category=Jewelry&subcategory=Earring">Ear Rings</a></li>
<li><a href="products.php?section=Women&category=Jewelry&subcategory=Pendant">Pendants</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Wallets</h5>
<li><a href="products.php?section=Women&category=Wallet&subcategory=Leather">Leather Wallets</a></li>
<li><a href="products.php?section=Women&category=Wallet&subcategory=Synthetic">Synthetic Wallets</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Belts</h5>
<li><a href="products.php?section=Women&category=Belt&subcategory=Leather">Leather Belts</a></li>
<li><a href="products.php?section=Women&category=Belt&subcategory=Foam">Foam Belts</a></li>
</div>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Men <b class="caret"></b></a>
<ul class="dropdown-menu">
<div class="col-md-4 col-lg-4 menu-section">
<h5>Shirts</h5>
<li><a href="products.php?section=Men&category=Shirt&subcategory=Formal">Formal Shirts</a></li>
<li><a href="products.php?section=Men&category=Shirt&subcategory=Casual">Casual Shirts</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Trousers</h5>
<li><a href="products.php?section=Men&category=Trouser&subcategory=Formal">Formal Trousers</a></li>
<li><a href="products.php?section=Men&category=Trouser&subcategory=Casual">Casual Trousers</a></li>
<li><a href="products.php?section=Men&category=Trouser&subcategory=Jeans">Jeans</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Jewelry</h5>
<li><a href="products.php?section=Men&category=Jewelry&subcategory=Bracelet">Bracelets</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Wallets</h5>
<li><a href="products.php?section=Men&category=Wallet&subcategory=Leather">Leather Wallets</a></li>
<li><a href="products.php?section=Men&category=Wallet&subcategory=Synthetic">Synthetic Wallets</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Belts</h5>
<li><a href="products.php?section=Men&category=Belt&subcategory=Leather">Leather Belts</a></li>
<li><a href="products.php?section=Men&category=Belt&subcategory=Foam">Foam Belts</a></li>
</div>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Kids <b class="caret"></b></a>
<ul class="dropdown-menu">
<div class="col-md-4 col-lg-4 menu-section">
<h5>Accessories</h5>
<li><a href="products.php?section=Kids&category=Accessories&subcategory=Toys">Play Toys</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Apparels</h5>
<li><a href="products.php?section=Kids&category=Apparels&subcategory=Shirt">Shirts</a></li>
<li><a href="products.php?section=Kids&category=Apparels&subcategory=Frock">Frocks</a></li>
</div>
<div class="col-md-4 col-lg-4 menu-section">
<h5>Hair Accessories</h5>
<li><a href="products.php?section=Kids&category=Hair&subcategory=Clips">Clips</a></li>
<li><a href="products.php?section=Kids&category=Hair&subcategory=Straps">Straps</a></li>
</div>
</ul>
</li>
<li><a href="contact.php">Contact</a></li>

</ul>

</div> 
</div>


</div>
<div class="col-md-2 col-lg-2 search-bar">
<form action="search.php" method="POST">
<div class="input-group">
<input type="text" class="form-control sm-search" placeholder="Search" name="keyword">
<span class="input-group-btn">
<button class="btn btn-default search-btn" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
</form>
</span>
</div>
</div>

<div class="col-md-2 col-lg-2 header-link">
<a class="header-link" href="mycart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a>
<div class="badge countcart" id="countcart">?</div>
<a class="header-link" href="account.php"><span class="glyphicon glyphicon-lock"></span></a>
</div>
</div>

</body>
</html>
<header>
<a href="<?php echo $BASE_URL; ?>index.php"><img class="img-responsive" src="<?php echo $BASE_URL; ?>logos/Bluedent.png" /></a>
</header>
<!--navbar-->
<div class="navbar navbar-default navbar-static-top" role="navigation">
<div class="navbar-header">
<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle Navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>
<div class="navbar-collapse collapse navbar-left">
<ul class="nav navbar-nav">
<li><a href="<?php echo $BASE_URL; ?>index.php">Home</a></li>

<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dental <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Oral_Medicine_and_Radiology">Oral Medicine and Radiology</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Periodontics">Periodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Orthodontics">Orthodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Endodontics">Endodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Pedodontics">Pedodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Prosthodontics">Prosthodontics</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Oral_Pathology">Oral Pathology</a></li>
<li><a href="<?php echo $BASE_URL; ?>oral-surgery.php">Oral Surgery</a></li>
<li><a href="<?php echo $BASE_URL; ?>dental-instruments.php">Dental Instruments</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">Medical <b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Gynaecology">Gynaecology</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=Iontophoresis_Machine">Iontophoresis Machine</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=X-Ray_Apron">X-Ray Apron</a></li>
<li><a href="<?php echo $BASE_URL; ?>products.php?product=X-Ray_Viewers">X-Ray Viewers</a></li>
</ul>
</li>
<li><a href="<?php echo $BASE_URL; ?>download.php">Downloads</a></li>
<li><a href="<?php echo $BASE_URL; ?>mycart.php">My Cart <div class="badge countcart" id="countcart">?</div></span></a></li>
<li><a href="<?php echo $BASE_URL; ?>enquiry.php">Product Enquiry</a></li>
<li><a href="<?php echo $BASE_URL; ?>contact.php">Contact Us</a></li>
</ul>

<form action="<?php echo $BASE_URL; ?>search.php" class="navbar-form navbar-right navbar-input-group" role="search" name="search" id="search">
<input type="text" class="form-control sm-search" placeholder="Search products" name="keyword" id="keyword" onkeyup="searchtext();">
<button class="btn btn-primary" type="submit" name="search" role="button"><i class="glyphicon glyphicon-search"></i></button>
</form>
</div> 
</div>


<div class="row autosearch">
<div class="col-md-12 col-lg-12">
<ul>
<div id="searchresult"></div>
</ul>
</div>
</div>
<script src="<?php echo $BASE_URL; ?>js/autosearch.js"></script>
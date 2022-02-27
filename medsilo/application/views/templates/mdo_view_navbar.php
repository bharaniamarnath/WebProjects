<div class="navbar navbar-contact sticky-top bg-strike py-0 navbar-inverse">
<?php $contact = simplexml_load_file(base_url()."assets/xml/contact.xml"); ?>
<span class="navbar-text ml-auto">
<i class="fa fa-phone pr-1" aria-hidden="true"></i>
<span class="pr-1"><?php echo $contact->office->landline; ?></span>
<a href="mailto:<?php echo $contact->office->email; ?>"><i class="fa fa-envelope px-1" aria-hidden="true"></i></a>
<a href="https://<?php echo $contact->social->facebook; ?>" target="_blank"><i class="fa fa-facebook px-1" aria-hidden="true"></i></a>
<a href="https://<?php echo $contact->social->twitter; ?>" target="_blank"><i class="fa fa-twitter px-1" aria-hidden="true"></i></a>
</span>
</div>
<nav class="navbar sticky-top bg-strobe navbar-light">
<div class="d-flex align-items-center justify-content-between">
<a class="navbar-brand" href="<?php echo base_url(); ?>">
<img src="<?php echo base_url().'assets/logos/medsilo_logo.png'?>" class="img-fluid d-inline-block align-middle" />
<h1 class="navbar-text align-bottom">Medsilo<small>Pharmaceuticals Pvt Ltd</small></h1>
</a>
<div class="col-md-8 hidden-xs-down justify-content-center">
<form class="form-inline" action="<?php echo base_url(); ?>search" method="POST">
<div class="input-group col-md-8">
<input type="text" name="searchkey" class="form-control" placeholder="Search for products, categories, combinations and indications.">
<span class="input-group-btn">
<button class="btn btn-nav" type="submit"><i class="fa fa-search"></i></button>
</span>
</div>
</form>
</div>
<button type="button" class="navbar-toggler navbar-toggler-right" id="openMainNav">
<span class="navbar-toggler-icon"></span>
</button>
</div>
</nav>

<div id="mainNav" class="sidenav bg-night">
<div class="sidebar-nav">
<h5 class="nav-title">Menu</h5>
<a href="javascript:void(0)" class="closenav" id="closeMainNav">&times;</a>
<ul class="navbar-nav">
<li class="nav-item<?php echo ($current == 'home'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>home">Home</a>
</li>
<li class="nav-item<?php echo ($current == 'about'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
</li>
<li class="nav-item<?php echo ($current == 'services'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>services">Services</a>
</li>
<li class="nav-item<?php echo ($current == 'products'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>products">Products</a>
</li>
<li class="nav-item<?php echo ($current == 'management'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>management">Management</a>
</li>
<li class="nav-item<?php echo ($current == 'career'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>career">Careers</a>
</li>
<li class="nav-item<?php echo ($current == 'contact'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>contact">Contact</a>
</li>
</ul>
<form action="<?php echo base_url(); ?>search" method="POST">
<div class="input-group pt-2">
<input type="text" name="searchkey" class="form-control" placeholder="Keywords">
<span class="input-group-btn">
<button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
</span>
</div>
<small class="form-text pt-1 text-white">Search for products, categories, combinations and indications.</small>
</form>
<span class="navbar-text pt-2 text-strobe">&copy; Medsilo - For better living</span>
</div>
</div>
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
<a class="navbar-brand" href="<?php echo base_url(); ?>admin/dashboard">
<img src="<?php echo base_url().'assets/logos/medsilo_logo.png'?>" class="img-fluid d-inline-block align-middle" />
<h1 class="navbar-text align-bottom">Medsilo<small>Pharmaceuticals Pvt Ltd</small></h1>
</a>
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
<li class="nav-item<?php echo ($current == 'dashboard'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a>
</li>
<li class="nav-item<?php echo ($current == 'newproduct'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/product/new">New Product</a>
</li>
<li class="nav-item<?php echo ($current == 'editproduct'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/product/list">Edit Product</a>
</li>
<li class="nav-item<?php echo ($current == 'categories'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/category">Categories</a>
</li>
<li class="nav-item<?php echo ($current == 'statistics'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/statistics">Statistics</a>
</li>
<li class="nav-item<?php echo ($current == 'enquiries'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/enquiries">Enquiries</a>
</li>
<li class="nav-item<?php echo ($current == 'account'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/account">Manage Account</a>
</li>
<li class="nav-item<?php echo ($current == 'logout'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>admin/logout">Logout</a>
</li>
</ul>
<span class="navbar-text pt-2 text-strobe">&copy; Medsilo - For better living</span>
</div>
</div>
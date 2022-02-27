<div class="navbar navbar-contact sticky-top bg-gray py-0 navbar-inverse">
<?php $contact = simplexml_load_file(base_url()."assets/xml/contact.xml"); ?>
<span class="navbar-text ml-auto">
<i class="fa fa-phone-square" aria-hidden="true"></i>
<?php echo $contact->office->phone; ?>
<i class="fa fa-envelope-square" aria-hidden="true"></i>
<?php echo $contact->office->email; ?>
<i class="fa fa-facebook-square" aria-hidden="true"></i>
<a href="https://<?php echo stripslashes($contact->social->facebook); ?>" target="_blank">Facebook</a>
</span>
</div>
<nav class="navbar navbar-toggleable-sm sticky-top bg-faded navbar-light">
<button type="button" class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle Nav">
<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="<?php echo base_url(); ?>">
<img src="<?php echo base_url().'assets/logos/cpp_logo.png'?>" class="img-fluid d-inline-block align-top" />
</a>
<div class="collapse navbar-collapse" id="mainNav">
<ul class="navbar-nav mx-auto my-auto">
<li class="nav-item<?php echo ($current == 'home'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>home">Home</a>
</li>
<li class="nav-item<?php echo ($current == 'about'?' active':''); ?>">
<a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
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
<span class="navbar-text text-salmon">caring for lives</span>
</div>
</nav>
<div class="container-fluid bg-night text-white pt-4 footbar">
<div class="row no-gutter">
<div class="col-sm-4 col-lg-3">
<ul>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/enquiries">Enquiries</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/statistics">Statistics</a></li>
</ul>
</div>
<div class="col-sm-4 col-lg-3">
<ul>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/product/new">New Product</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/product/list">Edit Product</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/category">Categories</a></li>
</ul>
</div>
<div class="col-sm-4 col-lg-3">
<ul>
<li class="py-1"><a href="<?php echo base_url(); ?>admin/account">Manage Account</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>terms">Terms &amp; Conditions</a></li>
<li class="py-1"><a href="<?php echo base_url(); ?>sitemap">Sitemap</a></li>
</ul>
</div>
<div class="col-sm-4 col-lg-3">
<?php $contact = simplexml_load_file(base_url()."assets/xml/contact.xml"); ?>
<ul>
<li class="py-1">
<h4>Connect</h4>
<a href="https://<?php echo $contact->social->facebook; ?>" target="_blank"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
<a href="https://<?php echo $contact->social->twitter; ?>" target="_blank"><i class="fa fa-twitter-square fa-2x pl-1" aria-hidden="true"></i></a>
<a href="mailto:<?php echo $contact->office->email; ?>"><i class="fa fa-envelope-square fa-2x pl-1" aria-hidden="true"></i></a>
<a href="tel:<?php echo $contact->office->landline; ?>"><i class="fa fa-phone-square fa-2x pl-1" aria-hidden="true"></i></a>
</li>
<li class="pt-1">For better living</li>
</ul>
</div>
</div>
<div class="row no-gutter text-white">
<div class="col-sm-12">
<p class="small text-center pt-4"><?php echo $copyright; ?></p>
</div>
</div>
</div>

</div>
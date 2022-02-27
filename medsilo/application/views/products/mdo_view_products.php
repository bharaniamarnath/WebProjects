<div class="content-wrapper">

<div class="container-fluid bg-mercury text-strobe pt-2 text-center jumbotron-hero">
	<div class="row">
		<div class="col-12">
			<h1><i class="fa fa-th pr-2"></i>Products</h1>
		</div>
	</div>
</div>

<div class="container jumbotron-hero">
	<div class="row no-gutter justify-content-center">
		<div class="col-lg-8 col-sm-9">
			<!-- Products Block Begin -->
			<?php
			foreach($products as $category => $category_items):
			$categoryid = explode(" ",$category);
			$categoryid[0] = str_replace(".","",$categoryid[0]);
			?>
			<div class="row" id="<?php echo $categoryid[0]; ?>">
				<div class="col-12">
					<h2 class="text-strike py-2"><i class="fa fa-folder-o pr-2"></i><?php echo $category; ?></h2>
				</div>
			</div>
			<div class="row">
				<?php
					foreach($category_items as $products_item):
				?>
					<div class="col-sm-6 col-lg-4">
						<div class="card product-card text-center mb-3">
							<?php 
							$thumb = base_url()."uploads/".$products_item['pimage'];
							?>
							<img class="card-img-top img-fluid w-75 mx-auto" src="<?php echo $thumb; ?>" alt="<?php echo $products_item['pname']; ?>" />
							<div class="card-block">
								<h4 class="card-title text-strobe"><?php echo $products_item['pname']; ?></h4>
								<h5 class="card-subtitle text-muted pb-2"><?php echo $products_item['ptype']; ?></h5>
								<a data-toggle="modal" href="<?php echo base_url(); ?>products/<?php echo $products_item['pid']; ?>" data-target='#detailModal' class="btn btn-secondary btn-sm" id="<?php echo $products_item['pid']; ?>"><i class="fa fa-plus-square pr-1"></i>View</a>
							</div>
						</div>
					</div>
				<?php
				endforeach;
				?>
			</div>
			<?php
			endforeach;
			?>
			<!-- Products Block End -->
		</div>
	</div>
</div>

<div class="container-fluid fixed-bottom">
	<div class="row">
		<div class="col-12">
			<div class="btn-group mx-1 mb-2 float-right">
				<button type="button" class="btn btn-secondary btn-lg px-3" id="openCatNav">
					<span class="fa fa-th-list"></span>
				</button>
				<button type="button" class="btn btn-secondary btn-lg px-3" id="scroll-top">
					<span class="fa fa-chevron-circle-up"></span>
				</button>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid bg-mercury pt-4 text-center jumbotron-hero">
	<div class="row no-gutter">
		<div class="col-12">
			<h3 class="text-strike pb-2">Need more information about our products ?</h3>
		</div>
	</div>
	<div class="container">
		<div class="row no-gutter justify-content-center pb-4">
			<div class="col-md-6 col-lg-4">
				<div class="card mb-2">
					<div class="card-block">
						<h1 class="text-strike"><i class="fa fa-comment-o"></i></h1>
						<h3 class="card-title text-strobe">Send us an enquiry</h3>
						<h1 class="text-strike small">Open enquiry. Fill the form. Send.</h1>
						<a href="<?php echo base_url(); ?>enquiry" class="btn btn-secondary mt-2">Open Enquiry</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="card mb-2">
					<div class="card-block">
						<h1 class="text-strike"><i class="fa fa-phone"></i></h1>
						<h3 class="card-title text-strobe">Give us a call</h3>
						<?php $contact = simplexml_load_file(base_url()."assets/xml/contact.xml"); ?>
						<h5 class="text-strike"><?php echo $contact->office->landline; ?></h5>
						<a href="tel:<?php echo $contact->office->landline; ?>" class="btn btn-secondary">Call now</a>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-4">
				<div class="card mb-2">
					<div class="card-block">
						<h1 class="text-strike"><i class="fa fa-envelope-o"></i></h1>
						<h3 class="card-title text-strobe">Send us an email</h3>
						<?php $contact = simplexml_load_file(base_url()."assets/xml/contact.xml"); ?>
						<h1 class="text-strike small"><?php echo $contact->office->email; ?></h1>
						<a href="mailto:<?php echo $contact->office->email; ?>" class="btn btn-secondary mt-2">Send Mail</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="catNav" class="sidenav bg-night">
<div class="sidebar-nav">
<h5 class="nav-title">Categories</h5>
<a href="javascript:void(0)" class="closenav" id="closeCatNav">&times;</a>
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" href="#Antibiotics">Antibiotics</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#Anti-Allergics">Anti-Allergics / Anti-Cough</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#Nutritional">Nutritional / Supplements</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#GIT">G.I.T</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#Antihelmintics">Antihelmintics</a>
</li>
<li class="nav-item">
<a class="nav-link" href="#Analgesic">Analgesic / Anti-Inflammatory</a>
</li>
</ul>
<form>
<div class="input-group pt-2">
<input type="text" class="form-control" placeholder="Keywords">
<span class="input-group-btn">
<button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
</span>
</div>
<small class="form-text pt-1 text-white">Search for products, categories, combinations and indications.</small>
</form>
<span class="navbar-text pt-2 text-strobe">&copy; Medsilo - For better living</span>
</div>
</div>

<div id="detailModal" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-strobe">
		<img src="<?php echo base_url(); ?>assets/logos/medsilo_logo.png" class="align-middle" id="modal-icon" />
		Medsilo
		</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle pr-1"></i>Close</button>
      </div>
    </div>
  </div>
</div>

</div>
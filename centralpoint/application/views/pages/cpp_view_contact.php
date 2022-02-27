<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Contact</h1>
		<h4>Connect to Central Point Pharmacy</h4>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-faded text-gray text-center py-4 mb-0">
	<div class="container">
		<div class="card">
			<div class="card-block">
				<h3 class="card-title display-4 text-fuschia"><?php echo $address->office->company; ?></h4>
				<p class="card-text lead">
				<?php echo $address->office->door; ?><br>
				<?php echo $address->office->street; ?><br>
				<?php echo $address->office->city; ?><br>
				<?php echo $address->office->state; ?><br>
				<i class="fa fa-phone pr-1"></i>
				<?php echo $address->office->phone; ?><br>
				<i class="fa fa-envelope-o pr-1"></i>
				<?php echo $address->office->email .", " .$address->office->emailalt; ?>
				</p>
				<a class="btn btn-secondary" target='_blank' href="https://<?php echo stripslashes($address->social->facebook); ?>"><i class="fa fa-facebook pr-2"></i>Find us on Facebook</a>
			</div>
		</div>
	</div>
</div>

<!-- Jumbotron End -->

<!-- Jumbotron Begin -->

<div class="jumbotron jumbotron-fluid bg-faded text-gray text-center py-1">
	<div class="container">
		<div class="row no-gutter">
			<div class="col-lg-4">
				<div class="card">
					<div class="card-block">
						<h3 class="display-4 text-gray"><i class="fa fa-comment-o"></i></h3>
						<h3 class="card-title text-fuschia">Have Questions ?</h4>
						<p class="card-text lead">Send an enquiry to Central Point Pharmacy.</p>
						<a class="btn btn-secondary" href="<?php echo base_url(); ?>enquiry">General Enquiry</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-block">
						<h3 class="display-4 text-gray"><i class="fa fa-file-text-o"></i></h3>
						<h3 class="card-title text-fuschia">For Customers</h4>
						<p class="card-text lead">Send prescriptions or products lists required</p>
						<a class="btn btn-secondary" href="<?php echo base_url(); ?>customer">Customer Enquiry</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-block">
						<h3 class="display-4 text-gray"><i class="fa fa-truck"></i></h3>
						<h3 class="card-title text-fuschia">For Suppliers</h4>
						<p class="card-text lead">Send details of provision and business.</p>
						<a class="btn btn-secondary" href="<?php echo base_url(); ?>supplier">Supplier Enquiry</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
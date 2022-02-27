<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-envelope-o pr-2"></i>Contact</h1>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-lg-10">
			<div class="card text-center pt-4 my-4">
				<div class="card-block">
					<h1 class="card-title contact-title text-strike"><?php echo $address->office->company; ?></h1>
					<p class="card-text">
					<?php echo $address->office->door; ?><br>
					<?php echo $address->office->street; ?><br>
					<?php echo $address->office->city; ?><br>
					<?php echo $address->office->state; ?><br>
					<i class="fa fa-phone pr-1"></i>
					<?php echo $address->office->landline; ?><br>
					<i class="fa fa-mobile pr-1"></i>
					<?php echo $address->office->mobile; ?><br>
					<i class="fa fa-envelope-o pr-1"></i>
					<span class="contact-email"><?php echo $address->office->email; ?></span>
					</p>
				</div>
			</div>
			<div class="card text-center mb-4">
				<div class="card-block">
					<h2 class="card-title text-strike">Head Office</h2>
					<p class="card-text">
					<?php echo $address->head->door; ?><br>
					<?php echo $address->head->street; ?><br>
					<?php echo $address->head->city; ?><br>
					<?php echo $address->head->state; ?><br>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
		
<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strike text-center py-4 mb-0">
	<div class="container">
		<div class="row no-gutter justify-content-center">
			<div class="col-lg-5">
				<div class="card mb-2">
					<div class="card-block">
						<h3 class="display-4"><i class="fa fa-comment-o"></i></h3>
						<h3 class="card-title text-strike">Have Questions ?</h4>
						<p class="card-text text-muted">Send us your enquiry now!</p>
						<a class="btn btn-secondary" href="<?php echo base_url(); ?>enquiry">Open Enquiry</a>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="card">
					<div class="card-block">
						<h3 class="display-4"><i class="fa fa-thumbs-o-up"></i></h3>
						<h3 class="card-title text-strike">Like us ?</h3>
						<p class="card-text text-muted">Follow us now on</p>
						<div class="btn-group">
						<a class="btn btn-secondary" target='_blank' href="https://<?php echo stripslashes($address->social->facebook); ?>"><i class="fa fa-facebook pr-2"></i>Facebook</a>
						<a class="btn btn-secondary" target='_blank' href="https://<?php echo stripslashes($address->social->twitter); ?>"><i class="fa fa-twitter pr-2"></i>Twitter</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Jumbotron End -->

</div>
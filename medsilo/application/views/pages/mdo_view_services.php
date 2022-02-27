<div class="content-wrapper">
<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-cog pr-2"></i>Services</h1>
	</div>
</div>
<!-- Jumbotron End -->

	<div class="container">
		<div class="row my-3 jumbotron-hero justify-content-center">
			<div class="col-lg-10 text-center">
				<?php foreach($services->service as $service): ?>
					<div class="card mb-3 pt-4">
						<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $service->icon; ?>">
						<div class="card-block">
							<h1 class="card-title text-strobe"><?php echo $service->title; ?></h1>
							<p class="card-text text-gray"><?php echo $service->content; ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

</div>
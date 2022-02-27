<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-info-circle pr-2"></i>About Medsilo</h1>
	</div>
</div>
<!-- Jumbotron End -->

<div class="container">
	<div class="row justify-content-center jumbotron-hero my-3">
		<div class="col-lg-10 text-center">
			<div class="card mb-2 pt-4 px-4">
				<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $about->introduction->icon; ?>">
				<div class="card-block">
					<h1 class="card-title text-strobe"><?php echo $about->introduction->title; ?></h1>
					<?php foreach($about->introduction->content as $introduction): ?>
					<p class="card-text text-gray"><?php echo $introduction; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="card mb-2 pt-4 px-4">
				<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $about->vision->icon; ?>">
				<div class="card-block">
					<h1 class="card-title text-strobe"><?php echo $about->vision->title; ?></h1>
					<?php foreach($about->vision->content as $vision): ?>
					<p class="card-text text-gray"><?php echo $vision; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="card mb-2 pt-4 px-4">
				<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $about->mission->icon; ?>">
				<div class="card-block">
					<h1 class="card-title text-strobe"><?php echo $about->mission->title; ?></h1>
					<?php foreach($about->mission->content as $mission): ?>
					<p class="card-text text-gray"><?php echo $mission; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="card mb-2 pt-4 px-4">
				<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $about->marketing->icon; ?>">
				<div class="card-block">
					<h1 class="card-title text-strobe"><?php echo $about->marketing->title; ?></h1>
					<?php foreach($about->marketing->content as $marketing): ?>
					<p class="card-text text-gray"><?php echo $marketing; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

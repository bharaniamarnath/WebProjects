<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-exclamation-circle pr-2"></i>Privacy Policy</h1>
	</div>
</div>
<!-- Jumbotron End -->

<div class="container">
	<div class="row jumbotron-hero terms py-4 mb-0 text-center justify-content-center">
		<div class="col-lg-10">
			<?php foreach($privacy->policy as $policy): ?>
				<div class="card mb-2">
					<div class="card-block">
						<h3 class="text-strike"><?php echo $policy->title; ?></h3>
						<?php foreach($policy->content as $content): ?>
							<p class="text-gray"><?php echo $content; ?></p>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

</div>
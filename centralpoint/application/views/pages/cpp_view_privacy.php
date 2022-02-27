<div class="content-wrapper">
<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Privacy Policy</h1>
		<h3>Your privacy is important to us</h3>
	</div>
</div>
<!-- Jumbotron End -->

<div class="jumbotron jumbotron-fluid terms bg-faded text-left py-4 mb-0">
	<div class="container">
		<?php foreach($privacy->policy as $policy): ?>
			<h3 class="display-4 text-fuschia"><?php echo $policy->title; ?></h3>
			<?php foreach($policy->content as $content): ?>
				<p class="lead text-gray"><?php echo $content; ?></p>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</div>

</div>
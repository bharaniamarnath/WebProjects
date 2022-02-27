<div class="content-wrapper">
<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Terms &amp; Conditions</h1>
		<h3>Terms by Central Point Pharmacy</h3>
	</div>
</div>
<!-- Jumbotron End -->

<div class="jumbotron jumbotron-fluid bg-tan text-center py-4 mb-0">
	<div class="container">
		<?php foreach($terms->preface as $preface): ?>
			<?php foreach($preface->content as $content): ?>
				<p class="lead text-fuschia"><?php echo $content; ?></p>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</div>

<div class="jumbotron jumbotron-fluid terms bg-faded text-left py-4 mb-0">
	<div class="container">
		<?php foreach($terms->term as $term): ?>
			<h3 class="display-4 text-fuschia"><?php echo $term->title; ?></h3>
			<?php foreach($term->content as $content): ?>
				<p class="lead text-gray"><?php echo $content; ?></p>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</div>

</div>
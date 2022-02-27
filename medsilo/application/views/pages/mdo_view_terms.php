<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-check-square pr-2"></i>Terms &amp; Conditions</h1>
	</div>
</div>
<!-- Jumbotron End -->

<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strike text-center py-4 mb-0">
	<div class="container">
		<?php foreach($terms->preface as $preface): ?>
			<?php foreach($preface->content as $content): ?>
				<p class="lead text-fuschia"><?php echo $content; ?></p>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</div>

<div class="container">
	<div class="row jumbotron-hero terms text-center py-4 mb-0 justify-content-center">
		<div class="col-lg-10">
			<?php foreach($terms->term as $term): ?>
				<div class="card mb-2">
					<div class="card-block">
						<h3 class="text-strike"><?php echo $term->title; ?></h3>
						<?php foreach($term->content as $content): ?>
							<p class="text-gray"><?php echo $content; ?></p>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

</div>
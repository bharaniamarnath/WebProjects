<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-group pr-2"></i>Management</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-10 text-center mb-2">
			<h2 class="text-strike py-3">Directors</h2>
			<?php
				$directors = $management->directors;
				foreach($directors->director as $director):
			?>
			<div class="card mb-2">
				<div class="card-block">
					<h2 class="display-2 text-strike"><i class="fa fa-user-circle"></i></h2>
					<h4 class="card-title text-strobe mb-1"><?php echo $director->name; ?></h4>
					<p class="card-text lead text-muted mb-0"><?php echo $director->role; ?></p>
					<?php if(!empty($director->description)): ?>
						<p class="my-0"><?php echo $director->description; ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php
			endforeach;
			?>
		</div>
	</div>
</div>


</div>
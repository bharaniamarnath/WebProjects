<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Management</h1>
		<h4>Members of Central Point Pharmacy</h4>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-faded text-gray text-center py-4 mb-0">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 class="text-salmon">Directors</h2>
				<?php
					$directors = $management->directors;
					foreach($directors->director as $director):
				?>
				<div class="card mb-2">
					<div class="card-block">
						<h4 class="card-title mb-1"><?php echo $director->name; ?></h4>
						<p class="card-text text-salmon mb-0"><?php echo $director->role; ?></p>
						<?php if(!empty($director->recognition)): ?>
							<p class="lead my-0"><em>"<?php echo $director->recognition; ?>"</em></p>
						<?php endif; ?>
					</div>
				</div>
				<?php
				endforeach;
				?>
				
				<h2 class="text-salmon">Managers</h2>
				<?php
					$managers = $management->managers;
					foreach($managers->manager as $manager):
				?>
				<div class="card mb-2">
					<div class="card-block">
						<h4 class="card-title"><?php echo $manager->name; ?></h4>
						<h6 class="card-subtitle"><?php echo $manager->qualification; ?></h6>
						<p class="card-text text-salmon">
						<?php echo $manager->role; ?><br>
						<?php echo $manager->hpc; ?>
						</p>
					</div>
				</div>
				<?php
				endforeach;
				?>
				
				<h2 class="text-salmon">Pharmacists</h2>
				<?php
					$pharmacists = $management->pharmacists;
					foreach($pharmacists->pharmacist as $pharmacist):
				?>
				<div class="card mb-2">
					<div class="card-block">
					<h4 class="card-title"><?php echo $pharmacist->name; ?></h4>
					<h6 class="card-subtitle"><?php echo $pharmacist->qualification; ?></h6>
					<p class="card-text text-salmon">
					<?php echo $pharmacist->role; ?><br>
					<?php echo $pharmacist->hpc; ?>
					</p>
					</div>
				</div>
				<?php
				endforeach;
				?>
			</div>
			
			<div class="col-md-6">
				<h2 class="text-salmon">Sales Executives</h2>
				<?php
					$executives = $management->executives;
					foreach($executives->executive as $executive):
				?>
				<div class="card mb-2">
					<div class="card-block">
						<h4 class="card-title mb-1"><?php echo $executive->name; ?></h4>
						<p class="card-text text-salmon"><?php echo $executive->role; ?></p>
					</div>
				</div>
				<?php
				endforeach;
				?>
		</div>
	</div>
</div>
<!-- Jumbotron End -->

</div>
<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-bar-chart pr-2"></i>Statistics</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center text-center my-2">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-4">All the statistics below are relevant to the website database only.</h4>
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-gray">Total products</h3>
					<h1 class="display-4 text-strobe"><?php echo count($products_data); ?></h1>
				</div>
			</div>
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-gray">Total product categories</h3>
					<h1 class="display-4 text-strobe"><?php echo count($categories_data); ?></h1>
				</div>
			</div>
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-gray">Categories</h3>
					<table class="table table-striped text-left text-strike">
						<thead>
							<tr>
								<th>Category</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$categories = array('Analgesic / Anti-Inflammatory','Anti-Allergics / Anti-Cough','Antibiotics','Antihelmintics','G.I.T','Nutritional / Supplements');
							foreach($categories as $category):
							$y = 0;
							foreach($products_data as $product){
								if($product['pcategory'] == $category){
									$y++;
								}
							}
							?>
							
							<tr>
								<td><?php echo $category; ?></td>
								<td><?php echo $y; ?></td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-gray">Types</h3>
					<table class="table table-striped text-left text-strike">
						<thead>
							<tr>
								<th>Type</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$types = array('Tablet','Capsule','Syrup','Suspension');
							foreach($types as $type):
							$x = 0;
							foreach($products_data as $product){
								if($product['ptype'] == $type){
									$x++;
								}
							}
							?>
							
							<tr>
								<td><?php echo $type; ?></td>
								<td><?php echo $x; ?></td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-th-list pr-2"></i>Product List</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-10 mb-2">
			<h4 class="text-strike py-3">Select product from list to edit</h4>
			<?php if($this->session->flashdata('status') != ''): ?>
			<div class="alert alert-info"><?php echo $this->session->flashdata('status'); ?></div>
			<?php endif; ?>
			<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Product Name</th>
						<th>Category</th>
						<th colspan="3">Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$x = 1;
					foreach($list as $product):
				?>
					<tr>
						<td><?php echo $x; ?></td>
						<td><h5 class="text-strike"><?php echo $product['pname']; ?></h5></td>
						<td><?php echo $product['pcategory']; ?></td>
						<td><a href="<?php echo base_url(); ?>admin/product/edit/<?php echo $product['pid']?>" class="btn btn-secondary btn-sm"><i class="fa fa-edit pr-1"></i>Edit</a></td>
						<td><a href="<?php echo base_url(); ?>admin/product/image/<?php echo $product['pid']?>" class="btn btn-info btn-sm"><i class="fa fa-file-picture-o pr-1"></i>Image</a></td>
						<td><a href="<?php echo base_url(); ?>admin/product/gallery/<?php echo $product['pid']?>" class="btn btn-success btn-sm"><i class="fa fa-image pr-1"></i>Gallery</a></td>
						<td><a href="<?php echo base_url(); ?>admin/product/delete/<?php echo $product['pid']?>" class="btn btn-danger btn-sm"><i class="fa fa-times-circle pr-1"></i>Delete</a></td>
					</tr>
				<?php
					$x++;
					endforeach;
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>
<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-th-large pr-2"></i>Categories</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-3">Add a new category</h4>
			<div class="card mb-2">
				<div class="card-block">
					<p class="small"><span class="req pl-1">&#42;</span> - Mandatory field</p>
					<form id="ncform" action="<?php echo base_url();?>admin/category/add">
						<div class="form-group">
							<label for="ncname">Category Name<span class="req pl-1">&#42;</span></label>
							<input type="text" name="ncname" class="form-control" placeholder="Enter category name" maxlength="128" />
							<?php echo form_error("ncname"); ?>
						</div>
						<input type="submit" name="ncadd" value="Add Category" class="btn btn-secondary btn-block" id="sendform" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-3">Categories List</h4>
			<table class="table table-responsive table-striped">
				<thead>
					<tr>
						<th>Category Name</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($categories_list as $category): ?>
						<tr>
							<td><?php echo $category['category']; ?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="statusModal" class="modal fade jumbotron-hero">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Category Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


</div>
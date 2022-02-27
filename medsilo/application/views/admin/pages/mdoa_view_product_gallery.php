<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-image pr-2"></i>Gallery Update</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-8 mb-2">
			<h4 class="text-strike py-3">Product gallery - <?php echo $product_data['pname']; ?></h4>
		</div>
	</div>

	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-8 mb-2">
			<div class="row no-gutter">
					<?php
						if(empty($gallery_data)){
					?>
						<div class="col-md-12">
							<h4 class="text-strobe"><i class="fa fa-file-picture-o pr-2"></i>No gallery</h4>
						</div>
					<?php
						}
						else{
						foreach($gallery_data as $gallery): 
					?>
				<div class="col-md-4 mb-2">
					<div class="card mb-2">
						<img class="card-img-top img-fluid mx-auto" src="<?php echo base_url().'/uploads/'.$gallery['link']; ?>" />
						<div class="card-block">
							<a href="<?php echo base_url().'admin/product/gallery/delete/'.$gallery['imageid']; ?>" class="btn btn-secondary btn-block">Remove</a>
						</div>
					</div>
				</div>
			<?php 
				endforeach; 
				}
			?>
			</div>
		</div>
	</div>
	
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-8 mb-2">
			<h4 class="text-strike py-3">Add image to product gallery</h4>
			<div class="card mb-2">
				<div class="card-block">
					<p class="small"><span class="req pl-1">&#42;</span> - Mandatory field</p>
					<form id="upform" action="<?php echo base_url();?>admin/product/gallery/add">
						<div class="form-group">
							<label for="upimage">Product Gallery<span class="req pl-1">&#42;</span></label>
							<small class="form-text text-muted mt-0 pt-0 pb-2">Upload image in JPG file format, less than 2MB</small>
							<label class="btn btn-secondary" for="upimage">
							<?php echo form_input(array("name"=>"upimage","type"=>"file","accept"=>"image/jpeg","id"=>"upimage","class"=>"form-control-file","onchange"=>"$('#file-label').html($(this).val());")); ?>
							Select Image
							</label><br>
							<span class="file-info" id="file-label"></span>
							<label id="file-error"></label>
							<?php echo form_error("upimage"); ?>
						</div>
						<input type="hidden" name="pid" value="<?php echo $product_data['pid']; ?>" />
						<input type="submit" name="piupdate" value="Add Image" class="btn btn-secondary btn-block" id="sendform" />
					</form>
				</div>
			</div>
	
		</div>
	</div>
</div>

<div id="statusModal" class="modal fade jumbotron-hero">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enquiry Status</h5>
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
<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-picture-o pr-2"></i>Image Update</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-3">Update product image</h4>
			<div class="card mb-2">
				<img class="card-img-top img-fluid mx-auto" src="<?php echo base_url(); ?>/uploads/<?php echo $image_data['pimage']; ?>" alt="<?php echo $image_data['pname']?>" />
				<div class="card-block">
					<h1 class="text-strike"><?php echo $image_data['pname']; ?></h1>
					<p class="small"><span class="req pl-1">&#42;</span> - Mandatory field</p>
					<form id="upform" action="<?php echo base_url();?>admin/product/image/update">
						<div class="form-group">
							<label for="upimage">Product Image<span class="req pl-1">&#42;</span></label>
							<small class="form-text text-muted mt-0 pt-0 pb-2">Upload image in JPG file format, less than 2MB</small>
							<label class="btn btn-secondary" for="upimage">
							<?php echo form_input(array("name"=>"upimage","type"=>"file","accept"=>"image/jpeg","id"=>"upimage","class"=>"form-control-file","onchange"=>"$('#file-label').html($(this).val());")); ?>
							Select Image
							</label><br>
							<span class="file-info" id="file-label"></span>
							<label id="file-error"></label>
							<?php echo form_error("upimage"); ?>
						</div>
						<input type="hidden" name="imagepath" value="<?php echo $image_data['pimage']; ?>" />
						<input type="hidden" name="imgid" value="<?php echo $image_data['pid']; ?>" />
						<input type="submit" name="piupdate" value="Update Image" class="btn btn-secondary btn-block" id="sendform" />
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
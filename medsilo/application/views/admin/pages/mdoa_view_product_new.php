<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-plus-circle pr-2"></i>New Product</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-3">Add a new product</h4>
			<div class="card mb-2">
				<div class="card-block">
					<p class="small"><span class="req pl-1">&#42;</span> - Mandatory field</p>
					<form id="npform" action="<?php echo base_url();?>admin/product/add">
						<div class="form-group">
							<label for="npname">Product Name<span class="req pl-1">&#42;</span></label>
							<input type="text" name="npname" class="form-control" placeholder="Enter product name" maxlength="128" />
							<?php echo form_error("npname"); ?>
						</div>
						<div class="form-group">
							<label for="npcategory">Product Category<span class="req pl-1">&#42;</span></label>
							<?php
								$npcoptions = array(""=>"Select");
								foreach($categories as $category):
									$npcoptions[$category['category']] = $category['category'];
								endforeach;
								$npc_val = $this->input->post("npcategory");
								echo form_dropdown("npcategory", $npcoptions, set_value("npcategory", ((!empty($npc_val)) ? "$npc_val" : "" )),'class="form-control custom-select"');
							?>
						</div>
						<div class="form-group">
							<label for="nptype">Product Type<span class="req pl-1">&#42;</span></label>
							<?php
								$nptoptions = array(""=>"Select",
												"Capsule"=>"Capsule",
												"Suspension"=>"Suspension",
												"Syrup"=>"Syrup",
												"Tablet"=>"Tablet"
												);
								$npt_val = $this->input->post("nptype");
								echo form_dropdown("nptype", $nptoptions, set_value("nptype", ((!empty($npt_val)) ? "$npt_val" : "" )),'class="form-control custom-select"');
							?>
						</div>
						<div class="form-group">
							<label for="npcombination">Product Combination<span class="req pl-1">&#42;</span></label>
							<input type="text" name="npcombination" class="form-control" placeholder="Enter product combination" maxlength="512" />
							<?php echo form_error("npcombination"); ?>
						</div>			
						<div class="form-group">
							<label for="npdescription">Product Description<span class="req pl-1">&#42;</span></label>
							<?php echo form_textarea(array("name"=>"npdescription","value"=>set_value("npdescription"),"class"=>"form-control","id"=>"npdescription")); ?>
							<?php echo form_error("npdescription"); ?>
						</div>
						<div class="form-group">
							<label for="npindications">Product Indications<span class="req pl-1">&#42;</span></label>
							<?php echo form_textarea(array("name"=>"npindications","value"=>set_value("npindications"),"class"=>"form-control","id"=>"npindications")); ?>
							<?php echo form_error("npindications"); ?>
						</div>
						<div class="form-group">
							<label for="npimage">Product Image<span class="req pl-1">&#42;</span></label>
							<small class="form-text text-muted mt-0 pt-0 pb-2">Upload image in JPG file format, less than 2MB</small>
							<label class="btn btn-secondary" for="npimage">
							<?php echo form_input(array("name"=>"npimage","type"=>"file","accept"=>"image/jpeg","id"=>"npimage","class"=>"form-control-file","onchange"=>"$('#file-label').html($(this).val());")); ?>
							Select Image
							</label><br>
							<span class="file-info" id="file-label"></span>
							<label id="file-error"></label>
							<?php echo form_error("npimage"); ?>
						</div>
						<input type="submit" name="npadd" value="Add Product" class="btn btn-secondary btn-block" id="sendform" />
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
        <h5 class="modal-title">Product Status</h5>
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
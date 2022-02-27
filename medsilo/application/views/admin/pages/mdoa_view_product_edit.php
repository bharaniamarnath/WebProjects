<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-edit pr-2"></i>Edit Product</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 mb-2">
			<h4 class="text-strike py-3">Edit product - <?php echo $product_data['pname']; ?></h4>
			<div class="card mb-2">
				<div class="card-block">
					<p class="small"><span class="req pl-1">&#42;</span> - Mandatory field</p>
					<form id="epform" action="<?php echo base_url();?>admin/product/modify">
						<div class="form-group">
							<label for="epname">Product Name<span class="req pl-1">&#42;</span></label>
							<input type="text" name="epname" value="<?php echo $product_data['pname']; ?>" class="form-control" placeholder="Enter product name" maxlength="128" />
							<?php echo form_error("epname"); ?>
						</div>
						<div class="form-group">
							<label for="epcategory">Product Category<span class="req pl-1">&#42;</span></label>
							<?php
								$npcoptions = array($product_data['pcategory']=>$product_data['pcategory']);
								foreach($categories as $category):
									$npcoptions[$category['category']] = $category['category'];
								endforeach;
								$npc_val = $this->input->post("epcategory");
								echo form_dropdown("epcategory", $npcoptions, set_value("epcategory", ((!empty($npc_val)) ? "$npc_val" : $product_data['pcategory'] )),'class="form-control custom-select"');
							?>
						</div>
						<div class="form-group">
							<label for="eptype">Product Type<span class="req pl-1">&#42;</span></label>
							<?php
								$nptoptions = array(
												$product_data['ptype']=>$product_data['ptype'],
												"Capsule"=>"Capsule",
												"Suspension"=>"Suspension",
												"Syrup"=>"Syrup",
												"Tablet"=>"Tablet"
												);
								$npt_val = $this->input->post("eptype");
								echo form_dropdown("eptype", $nptoptions, set_value("eptype", ((!empty($npt_val)) ? "$npt_val" : $product_data['ptype'] )),'class="form-control custom-select"');
							?>
						</div>
						<div class="form-group">
							<label for="epcombination">Product Combination<span class="req pl-1">&#42;</span></label>
							<input type="text" name="epcombination" value="<?php echo $product_data['pcombination']; ?>" class="form-control" placeholder="Enter product combination" maxlength="512" />
							<?php echo form_error("epcombination"); ?>
						</div>			
						<div class="form-group">
							<label for="epdescription">Product Description<span class="req pl-1">&#42;</span></label>
							<textarea name="epdescription" class="form-control" id="epdescription"><?php echo $product_data['pdescription']; ?></textarea>
							<small class="form-text pt-1 text-gray">Begin a new paragraph with an 'underscore' symbol</small>
							<?php echo form_error("epdescription"); ?>
						</div>
						<div class="form-group">
							<label for="epindications">Product Indications<span class="req pl-1">&#42;</span></label>
							<textarea name="epindications" class="form-control" id="epindications"><?php echo $product_data['pindication']; ?></textarea>
							<small class="form-text pt-1 text-gray">Use 'period' symbol to seperate each indications</small>
							<?php echo form_error("epindications"); ?>
						</div>
						<input type="hidden" name="epid" value="<?php echo $product_data['pid']; ?>">
						<input type="submit" name="epadd" value="Update Product" class="btn btn-secondary btn-block" id="sendform" />
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
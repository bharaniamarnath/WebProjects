<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Enquiry</h1>
		<h4>Customer Enquiry Section</h4>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-tan text-center py-4 mb-0">
	<div class="container">
		<div class="card">
			<div class="card-block">
				<h1 class="card-title text-salmon">How do you want to send it ?</h1>
				<h5 class="card-subtitle pt-2 pb-3 text-muted">Choose an enquiry type below.</h5>
				<nav class="nav nav-pills justify-content-center flex-column flex-md-row">
				<a class="nav-link active" href="#listForm" data-toggle="tab">As Product List</a>
				<a class="nav-link" href="#prescriptionForm" data-toggle="tab">As Prescription File</a>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-faded text-fuschia text-left py-4 mb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 pb-3">
				<div class="tab-content">
				<div class="tab-pane active" id="listForm">
				<h1 class="display-4"><small>Require Products ?</small></h1>
				<h1 class="display-4 text-fuschia">Send a list</h1>
				<p class="lead text-gray">Fill the form below with required products.</p>
				<!-- Form Begin -->
				<?php $attr = array("id"=>"plform"); ?>
				<?php echo form_open(base_url().'customer/sendlist',$attr); ?>
				<div class="form-group">
					<label class="main-label" for="plname">Name</label>
					<?php echo form_input(array("name"=>"plname","value"=>set_value("plname"),"class"=>"form-control")); ?>
					<?php echo form_error("plname"); ?>
				</div>
				<div class="form-group">
					<label class="main-label" for="plemail">Email</label>
					<?php echo form_input(array("name"=>"plemail","value"=>set_value("plemail"),"class"=>"form-control")); ?>
					<?php echo form_error("plemail"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="plphone">Phone</label>
					<?php echo form_input(array("name"=>"plphone","value"=>set_value("plphone"),"class"=>"form-control")); ?>
					<?php echo form_error("plphone"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="plcategory">Category</label><br>
					
					<?php echo form_radio("plcategory","General",NULL,'id="pl-general"') ?>
					<label for="pl-general" id="pl-label-general">General</label>
			
					<?php echo form_radio("plcategory","Patient",NULL,'id="pl-patient"') ?>
					<label for="pl-patient" id="pl-label-patient">Patient</label>
			
					<?php echo form_radio("plcategory","Hospital",NULL,'id="pl-hospital"') ?>
					<label for="pl-hospital" id="pl-label-hospital">Hospital</label>
					
					<?php echo form_radio("plcategory","Retail-Pharmacy",NULL,'id="pl-retail-pharmacy"') ?>
					<label for="pl-retail-pharmacy" id="pl-label-retail-pharmacy">Retail Pharmacy</label>
					
					<?php echo form_radio("plcategory","Retail-Shop",NULL,'id="pl-retail-shop"'); ?>
					<label for="pl-retail-shop" id="pl-label-retail-shop">Retail Shop</label>
					
					<?php echo form_error("plcategory") ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="plproducts">Required Products</label>
					<small class="form-text text-muted">Fill in the required products with appropriate quantity below. Maximum of 10 products can be added.</small>
				</div>
				
				<div class="form-group field_wrapper">
					<div>
						<small class="form-text text-fuschia">Product 1</small>
						<input class="form-control product my-1" type="text" name="product[1]" id="product1" />
						<small class="form-text text-fuschia">Quantity</small>
						<input class="form-control quantity my-1" type="text" name="quantity[1]" id="quantity1" />
					</div>
				</div>

				<div class="form-group">
					<a href="javascript:void(0);" class="btn btn-secondary btn-sm add_button" title="Add field"><i class="fa fa-plus-circle pr-1"></i>Add More</a>
				</div>
				
				<div class="form-group">
					<?php echo form_checkbox('plterms','accepted',set_checkbox('plterms','accepted'),'id="pl-terms"'); ?>
					<label for="pl-terms" id="pl-label">Accept terms &amp; Conditions</label>
					<?php echo form_error("plterms"); ?>
				</div>
				
				<?php echo form_submit(array("name"=>"submit","value"=>"Send","id"=>"sendlist","class"=>"btn btn-secondary btn-block pull-right")); ?>
				
				<?php echo form_close(); ?>
				
				<!-- Form End -->
				
			</div>
			
			<div class="tab-pane" id="prescriptionForm">
				<h1 class="display-4"><small>Require Products ?</small></h1>
				<h1 class="display-4 text-fuschia">Send prescription</h1>
				<p class="lead text-gray">Fill the form below and upload the prescription.</p>
				<!-- Form Begin -->
				<?php $attr = array("id"=>"prform"); ?>
				<?php echo form_open(base_url().'customer/prescription',$attr); ?>
				<div class="form-group">
					<label class="main-label" for="prname">Name</label>
					<?php echo form_input(array("name"=>"prname","value"=>set_value("prname"),"class"=>"form-control")); ?>
					<?php echo form_error("prname"); ?>
				</div>
				<div class="form-group">
					<label class="main-label" for="premail">Email</label>
					<?php echo form_input(array("name"=>"premail","value"=>set_value("premail"),"class"=>"form-control")); ?>
					<?php echo form_error("premail"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="prphone">Phone</label>
					<?php echo form_input(array("name"=>"prphone","value"=>set_value("prphone"),"class"=>"form-control")); ?>
					<?php echo form_error("prphone"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="prcategory">Category</label><br>
					
					<?php echo form_radio("prcategory","General",NULL,'id="pr-general"') ?>
					<label for="pr-general" id="pr-label-general">General</label>
			
					<?php echo form_radio("prcategory","Patient",NULL,'id="pr-patient"') ?>
					<label for="pr-patient" id="pr-label-patient">Patient</label>
			
					<?php echo form_radio("prcategory","Hospital",NULL,'id="pr-hospital"') ?>
					<label for="pr-hospital" id="pr-label-hospital">Hospital</label>
					
					<?php echo form_radio("prcategory","Retail-Pharmacy",NULL,'id="pr-retail-pharmacy"') ?>
					<label for="pr-retail-pharmacy" id="pr-label-retail-pharmacy">Retail Pharmacy</label>
					
					<?php echo form_radio("prcategory","Retail-Shop",NULL,'id="pr-retail-shop"'); ?>
					<label for="pr-retail-shop" id="pr-label-retail-shop">Retail Shop</label>
					
					<?php echo form_error("prcategory") ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="prfile">Prescription File</label>
					<small class="form-text text-muted mt-0 pt-0 pb-3">Upload your prescription file in PDF or JPG file format, less than 2MB</small>
					<label class="btn btn-secondary" for="cfile">
					<?php echo form_input(array("name"=>"prfile","type"=>"file","accept"=>"application/pdf,image/jpeg","id"=>"prfile","class"=>"form-control-file","onchange"=>"$('#file-label').html($(this).val());")); ?>
					Select Prescription
					</label><br>
					<span class="file-info" id="file-label"></span>
					<label id="file-error"></label>
					<?php echo form_error("prfile"); ?>
				</div>
				
				<div class="form-group">
					<?php echo form_checkbox('prterms','accepted',set_checkbox('prterms','accepted'),'id="pr-terms"'); ?>
					<label for="pr-terms" id="pr-label">Accept terms &amp; Conditions</label>
					<?php echo form_error("prterms"); ?>
				</div>
				
				<?php echo form_submit(array("name"=>"submit","value"=>"Send","id"=>"sendprescription","class"=>"btn btn-secondary btn-block pull-right")); ?>
				
				<?php echo form_close(); ?>
				
				<!-- Form End -->	
				
			</div>

		</div>
	</div>
</div>
</div>
</div>
<!-- Jumbotron End -->

<div id="customerModal" class="modal fade jumbotron-hero">
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
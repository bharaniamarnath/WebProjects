<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Enquiry</h1>
		<h4>Send an enquiry to Central Point Pharmacy</h4>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-faded text-fuschia text-left py-4 mb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 pb-3">
				<h1 class="display-4"><small>Have Questions ?</small></h1>
				<h1 class="display-4 text-fuschia">Send an enquiry</h1>
				<p class="lead text-gray">Fill the form below and send us.</p>
				<!-- Form Begin -->
				<?php $attr = array("id"=>"eform"); ?>
				<?php echo form_open(base_url().'enquiry/send',$attr); ?>
				<div class="form-group">
					<label class="main-label" for="ename">Name</label>
					<?php echo form_input(array("name"=>"ename","value"=>set_value("ename"),"class"=>"form-control")); ?>
					<?php echo form_error("ename"); ?>
				</div>
				<div class="form-group">
					<label class="main-label" for="eemail">Email</label>
					<?php echo form_input(array("name"=>"eemail","value"=>set_value("eemail"),"class"=>"form-control")); ?>
					<?php echo form_error("eemail"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="ephone">Phone</label>
					<?php echo form_input(array("name"=>"ephone","value"=>set_value("ephone"),"class"=>"form-control")); ?>
					<?php echo form_error("ephone"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="emessage">Enquiry Message</label>
					<?php echo form_textarea(array("name"=>"emessage","value"=>set_value("emessage"),"class"=>"form-control")); ?>
					<?php echo form_error("emessage"); ?>
				</div>
				
				<div class="form-group">
					<?php echo form_checkbox('eterms','accepted',set_checkbox('eterms','accepted'),'id="check-terms"'); ?>
					<label for="check-terms" id="check-label">Accept terms &amp; Conditions</label>
					<?php echo form_error("eterms"); ?>
				</div>
				
				<?php echo form_submit(array("name"=>"submit","value"=>"Send","id"=>"sendform","class"=>"btn btn-secondary btn-block pull-right")); ?>
				
				<?php echo form_close(); ?>
				
				<!-- Form End -->
				
			</div>

		</div>
	</div>
</div>
<!-- Jumbotron End -->

<div id="enquiryModal" class="modal fade">
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
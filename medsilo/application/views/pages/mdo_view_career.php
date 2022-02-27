<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-briefcase pr-2"></i>Careers</h1>
	</div>
</div>
<!-- Jumbotron End -->

<div class="container jumbotron-hero text-strobe text-left py-4">
	<div class="row justify-content-center">
		<div class="col-lg-5 pb-3">
			<div class="card">
				<div class="card-block">
					<h1 class="display-4"><small>Job Opportunity at</small></h1>
					<h1 class="display-4 text-strike">Medsilo</h1>
					<p class="lead text-muted">Let us know about you. Fill in your information below and send us.</p>
					<?php if(isset($error)): ?>
						<?php if(!empty($error)): ?>
							<div class="alert alert-danger" role="alert">
								<?php echo $error; ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<!-- Form Begin -->
					<?php $attr = array("id"=>"cform"); ?>
					<?php echo form_open_multipart(base_url().'career/send',$attr); ?>
					<div class="form-group">
						<label class="main-label" for="cname">Name</label>
						<?php echo form_input(array("name"=>"cname","value"=>set_value("cname"),"class"=>"form-control")); ?>
						<?php echo form_error("cname"); ?>
					</div>
					<div class="form-group">
						<label class="main-label" for="cemail">Email</label>
						<?php echo form_input(array("name"=>"cemail","value"=>set_value("cemail"),"class"=>"form-control")); ?>
						<?php echo form_error("cemail"); ?>
					</div>
					<div class="form-group">
						<label class="main-label" for="cphone">Phone</label>
						<?php echo form_input(array("name"=>"cphone","value"=>set_value("cphone"),"class"=>"form-control")); ?>
						<?php echo form_error("cphone"); ?>
					</div>
					
					<div class="form-group">
						<label class="main-label" for="cgender">Gender</label>
						<?php echo form_radio("cgender","male",NULL,'id="radio-btn-m"'); ?>
						<label for="radio-btn-m" id="radio-label-m">Male</label>
						<?php echo form_radio("cgender","female",NULL,'id="radio-btn-f"'); ?>
						<label for="radio-btn-f" id="radio-label-f">Female</label>
						<?php echo form_error("cgender") ?>
					</div>
					
					<div class="form-group">
						<label class="main-label" for="cdob">Date of Birth</label>
						<?php echo form_input(array("name"=>"cdob","value"=>set_value("cdob"),"class"=>"form-control","id"=>"cdob","data-date-end-date"=>"0d","readonly"=>"true")); ?>
						<?php echo form_error("cdob"); ?>
					</div>
					
					<div class="form-group">
						<label class="main-label" for="cqualification">Qualification</label>
						<?php
							$qoptions = array(""=>"Select","Non-Graduate"=>"Non Graduate","B.A"=>"B.A","B.Arch"=>"B.Arch","BCA"=>"BCA","B.B.A"=>"B.B.A","B.Com"=>"B.Com","B.Ed"=>"B.Ed","BDS"=>"BDS","BHM"=>"BHM","B.Pharma"=>"B.Pharma","B.Sc"=>"B.Sc","B.E"=>"B.E","B.Tech"=>"B.Tech","LLB"=>"LLB","MBBS"=>"MBBS","Diploma"=>"Diploma","BVSC"=>"BVSC","CA"=>"CA","CS"=>"CS","ICWA"=>"ICWA","LLM"=>"LLM","M.A"=>"M.A","M.Arch"=>"M.Arch","M.Com"=>"M.Com","M.Ed"=>"M.Ed","M.Pharma"=>"M.Pharma","M.Sc"=>"M.Sc","M.Tech"=>"M.Tech","MBA"=>"MBA","PGDM"=>"PGDM","MCA"=>"MCA","MS"=>"MS","PG-Diploma"=>"PG Diploma","MVSC"=>"MVSC","MCM"=>"MCM","M.Phil"=>"M.Phil","Other"=>"Other");
							$qualification_val = $this->input->post("cqualification");
							echo form_dropdown("cqualification", $qoptions, set_value("cqualification", ((!empty($qualification_val)) ? "$qualification_val" : "" )),'class="form-control custom-select"');
						?>
					</div>
					
					<div class="form-group">
						<label class="main-label" for="cexperience">Work Experience</label>
						<?php
							$moptions = array(
										""=>"Select",
										"fresher"=>"Fresher",
										"less-than-1-year"=>"Less than 1 year",
										"2-to-5-years"=>"2 to 5 years",
										"more-than-5-years"=>"More than 5 years"
										);
							$exp_val = $this->input->post("cmarital");
							echo form_dropdown("cexperience", $moptions, set_value("cexperience", ((!empty($exp_val)) ? "$exp_val" : "" )),'class="form-control custom-select"');
						?>
					</div>
					
					<div class="form-group">
						<label class="main-label" for="caddress">Postal Address</label>
						<?php echo form_textarea(array("name"=>"caddress","value"=>set_value("caddress"),"class"=>"form-control")); ?>
						<?php echo form_error("caddress"); ?>
					</div>
					
					<div class="form-group mb-1">
						<label class="main-label mb-0" for="cfile">Resume</label>
						<small class="form-text text-muted my-2">Upload your updated resume in PDF or DOC file format, less than 2MB</small>
						<label class="btn btn-secondary" for="cfile">
							<?php echo form_input(array("name"=>"cfile","type"=>"file","accept"=>"application/pdf,application/msword","id"=>"cfile","class"=>"form-control-file","onchange"=>"$('#file-label').html($(this).val());")); ?>
							Select Resume
						</label><br>
						<span class="file-info" id="file-label"></span>
						<label id="file-error"></label>
						<?php echo form_error("cfile"); ?>
					</div>
					
					<div class="form-group">
						<?php echo form_checkbox('cterms','accepted',set_checkbox('cterms','accepted'),'id="check-terms"'); ?>
						<label for="check-terms" id="check-label">Accept terms &amp; Conditions</label>
						<?php echo form_error("cterms"); ?>
					</div>
					
					<?php echo form_submit(array("name"=>"submit","value"=>"Send","id"=>"sendform","class"=>"btn btn-secondary btn-block pull-right")); ?>
					
					<?php echo form_close(); ?>
					
					<!-- Form End -->
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<h2 class="card-title text-strike">Why join Medsilo ?</h2>
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-strobe"><i class="fa fa-lightbulb-o pr-2"></i>Self-Reliant</h3>
					<p class="text-gray">Medsilo is an energetic, exciting place to work. We employ exceptional people, and every one of them is vested to think self reliantly take project and be inventive. We offer you to discover the realm of prospects waiting for you.</p>
				</div>
			</div>
			<div class="card">
				<div class="card-block">
					<h3 class="card-title text-strobe"><i class="fa fa-gears pr-2"></i>Co-Ordination</h3>
					<p class="text-gray">We bid equal employment prospects to skilled persons. If you are looking for a work that inspire, that works your attention, gives you a chance to cherish and that spins around building relationships. Then Medsilo is for you.</p>
				</div>
			</div>
		</div>
	</div>
</div>


<div id="careerModal" class="modal fade jumbotron-hero">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Application Status</h5>
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
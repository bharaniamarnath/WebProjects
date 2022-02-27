<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-strip bg-salmon text-white text-center py-4 mb-0">
	<div class="container">
		<h1 class="display-4" id="number-one">Enquiry</h1>
		<h4>Supplier Enquiry Section</h4>
	</div>
</div>
<!-- Jumbotron End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid bg-faded text-fuschia text-left py-4 mb-0">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 pb-3">
				<h1 class="display-4"><small>Have Supplies ?</small></h1>
				<h1 class="display-4 text-fuschia">Send an enquiry</h1>
				<p class="lead text-gray">Fill the form below and send us.</p>
				<!-- Form Begin -->
				<?php $attr = array("id"=>"suform"); ?>
				<?php echo form_open(base_url().'enquiry/send',$attr); ?>
				<div class="form-group">
					<label class="main-label" for="suname">Business Name</label>
					<?php echo form_input(array("name"=>"suname","value"=>set_value("suname"),"class"=>"form-control")); ?>
					<?php echo form_error("suname"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="sulicno">License Number</label>
					<?php echo form_input(array("name"=>"sulicno","value"=>set_value("sulicno"),"class"=>"form-control")); ?>
					<?php echo form_error("sulicno"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="lictype">License Type</label>
					<?php
						$qoptions = array(""=>"Select","Administrator In Training"=>"Administrator In Training","Advanced EMT"=>"Advanced EMT","Certified Nurse Aide"=>"Certified Nurse Aide","Certified Nurse Practitioner"=>"Certified Nurse Practitioner","Certified RN Anesthetist"=>"Certified RN Anesthetist","Chief Examiner"=>"Chief Examiner","Clinical Nurse Specialist"=>"Clinical Nurse Specialist","Community Health Worker"=>"Community Health Worker","Conscious Sedation"=>"Conscious Sedation","Corporation"=>"Corporation","Dental Hygienist"=>"Dental Hygienist","Dentist"=>"Dentist","EMT Basic"=>"EMT Basic","EMT Paramedic"=>"EMT Paramedic","Examiner"=>"Examiner","Facility Permit"=>"Facility Permit","Faculty License"=>"Faculty License","Genetic Counselor"=>"Genetic Counselor","Instructor"=>"Instructor","Licensed Practical Nurse"=>"Licensed Practical Nurse","Limited License"=>"Limited License","Limited Permit"=>"Limited Permit","Optometrist"=>"Optometrist","Physician"=>"Physician","Podiatrist"=>"Podiatrist","Veterinarian"=>"Veterinarian","Non-Certified Individual"=>"Non-Certified Individual","Nuclear Pharmacist"=>"Nuclear Pharmacist","Nursing Home Administrator"=>"Nursing Home Administrator","Perfusionist"=>"Perfusionist","Pharmacist"=>"Pharmacist","Pharmacy Intern"=>"Pharmacy Intern","Pharmacy Technician"=>"Pharmacy Technician","Physician Assistant"=>"Physician Assistant","Registered Nurse"=>"Registered Nurse","Respiratory Therapist"=>"Respiratory Therapist","Temporary Practice Certification"=>"Temporary Practice Certification");
						$lictype_val = $this->input->post("lictype");
						echo form_dropdown("lictype", $qoptions, set_value("lictype", ((!empty($lictype_val)) ? "$lictype_val" : "" )),'class="form-control custom-select"');
					?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="licstatus">License Status</label>
					<?php
						$qoptions = array(""=>"Select","Active"=>"Active","Cancelled"=>"Cancelled","Candidate"=>"Candidate","Closed"=>"Closed","Combined License Types"=>"Combined License Types","Current"=>"Current","Deceased"=>"Deceased","Deleted"=>"Deleted","Denied"=>"Denied","Discharge"=>"Discharge","Expired"=>"Expired","Grace Period"=>"Grace Period","Inactive"=>"Inactive","Interim"=>"Interim","Lapsed"=>"Lapsed","Not In Use"=>"Not In Use","Not Licensed"=>"Not Licensed","Pending"=>"Pending","Probation"=>"Probation","Provisional"=>"Provisional","Public Service"=>"Public Service","Reinstated"=>"Reinstated","Reissued"=>"Reissued","Relinquished"=>"Relinquished","Resident"=>"Resident","Retired"=>"Retired","Revoked"=>"Revoked","Surrendered"=>"Surrendered","Suspended"=>"Suspended","Temporary"=>"Temporary","Terminated"=>"Terminated","Transfer Pending"=>"Transfer Pending","Transferred"=>"Transferred","Under Investigation"=>"Under Investigation","Unknown"=>"Unknown","Upgraded"=>"Upgraded","Void"=>"Void","Withdrawn"=>"Withdrawn");
						$licstatus_val = $this->input->post("licstatus");
						echo form_dropdown("licstatus", $qoptions, set_value("licstatus", ((!empty($licstatus_val)) ? "$licstatus_val" : "" )),'class="form-control custom-select"');
					?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="subizact">Business Activity</label>
					<?php
						$qoptions = array(""=>"Select","Acupuncture"=>"Acupuncture","Audiology"=>"Audiology","Biomedical Engineering"=>"Biomedical Engineering","Biomedical Science"=>"Biomedical Science","Pharmacy"=>"Pharmacy","Radiology"=>"Radiology","Dentistry"=>"Dentistry","Emergency Care"=>"Emergency Care","Health Education"=>"Health Education","Health Statistics"=>"Health Statistics","Occupational Therapy"=>"Occupational Therapy","Optometry"=>"Optometry","Psychology"=>"Psychology","Physiotherapy"=>"Physiotherapy","Prosthetics"=>"Prosthetics","Public Health"=>"Public Health","Speech Pathology"=>"Speech Pathology");
						$bizact_val = $this->input->post("subizact");
						echo form_dropdown("subizact", $qoptions, set_value("subizact", ((!empty($bizact_val)) ? "$bizact_val" : "" )),'class="form-control custom-select"');
					?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="suemail">Email</label>
					<?php echo form_input(array("name"=>"suemail","value"=>set_value("suemail"),"class"=>"form-control")); ?>
					<?php echo form_error("suemail"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="suphone">Phone</label>
					<?php echo form_input(array("name"=>"suphone","value"=>set_value("suphone"),"class"=>"form-control")); ?>
					<?php echo form_error("suphone"); ?>
				</div>
				
				<div class="form-group">
					<label class="main-label" for="suaddress">Registered Office Address</label>
					<?php echo form_textarea(array("name"=>"suaddress","value"=>set_value("suaddress"),"class"=>"form-control")); ?>
					<?php echo form_error("suaddress"); ?>
				</div>
				
				<div class="form-group">
					<?php echo form_checkbox('suterms','accepted',set_checkbox('suterms','accepted'),'id="check-terms"'); ?>
					<label for="check-terms" id="check-label">Accept terms &amp; Conditions</label>
					<?php echo form_error("suterms"); ?>
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
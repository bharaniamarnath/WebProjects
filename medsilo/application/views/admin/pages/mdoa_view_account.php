<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-user pr-2"></i>Account</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center text-center my-2">
		<div class="col-md-6 mb-2">
			<div class="card mb-2">
				<div class="card-block">
					<h3 class="card-title text-gray">Last Login Time</h3>
					<h1 class="text-strobe"><?php echo $lastlogin['lastlog']; ?></h1>
				</div>
			</div>
		</div>
	</div>
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 text-center mb-2">
			<h2 class="text-strike py-3">Change Password</h2>
			<div class="card mb-2">
				<div class="card-block">
					<form id="acform" action="<?php echo base_url();?>admin/account/update">
						<div class="form-group">
							<label for="adminpwd">Current Password</label>
							<input type="password" name="adminpwd" id="adminpwd" class="form-control" placeholder="Enter Current Password" maxlength="30" />
							<span class="text-error"><?php echo form_error("adminpwd"); ?></span>
						</div>
						<div class="form-group">
							<label for="newpwd">New Password</label>
							<input type="password" name="newpwd" id="newpwd" class="form-control" placeholder="Enter New Password" maxlength="30" />
							<span class="text-error"><?php echo form_error("newpwd"); ?></span>
						</div>
						<div class="form-group">
							<label for="rnewpwd">Repeat New Password</label>
							<input type="password" name="rnewpwd" id="rnewpwd" class="form-control" placeholder="Repeat New Password" maxlength="30" />
							<span class="text-error"><?php echo form_error("rnewpwd"); ?></span>
						</div>
						<input type="submit" name="updateacc" value="Update Password" class="btn btn-primary btn-block" id="sendform" />
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
        <h5 class="modal-title">Account Status</h5>
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
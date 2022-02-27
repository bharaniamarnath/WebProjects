<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1 id="number-one"><i class="fa fa-user pr-2"></i>Admin</h1>
	</div>
</div>
<!-- Jumbotron End -->


<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 text-center mb-2">
			<h2 class="text-strike py-3">Login</h2>
			<h5 class="text-error">
			<?php if(isset($error)){
				echo $error;
			}
			?>
			</h5>
			<div class="card mb-2">
				<div class="card-block">
					<form action="<?php echo base_url();?>admin/login" method="POST">
						<div class="form-group">
							<label for="adminuid">Username</label>
							<input type="text" name="adminuid" class="form-control" placeholder="Enter Username" maxlength="30" />
							<span class="text-error"><?php echo form_error("adminuid"); ?></span>
						</div>
						<div class="form-group">
							<label for="adminpwd">Password</label>
							<input type="password" name="adminpwd" class="form-control" placeholder="Enter Password" maxlength="30" />
							<span class="text-error"><?php echo form_error("adminpwd"); ?></span>
						</div>
						<input type="submit" name="adminlogin" value="Login" class="btn btn-primary btn-block" />
					</form>
				</div>
			</div>
	
		</div>
	</div>
</div>


</div>
<div class="content-wrapper">

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-mercury text-strobe text-center py-1 mb-0">
	<div class="container">
		<h1><i class="fa fa-commenting pr-2"></i>Enquiries</h1>
	</div>
</div>
<!-- Jumbotron End -->
<div class="container">
	<div class="row jumbotron-hero justify-content-center">
		<div class="col-md-6 my-2">
			<?php if(empty($enquiries_list)): ?>
				<div class="card my-2 text-center">
					<div class="card-block">
						<h4 class="card-title text-strike"><i class="fa fa-envelope-o pr-2"></i>No enquiries found</h4>
					</div>
				</div>
			<?php else: foreach($enquiries_list as $enquiry): ?>
				<div class="card mb-2">
					<div class="card-block">
						<h3 class="card-title text-strike"><span>ME</span><?php echo $enquiry['eid']; ?></h3>
						<h5 class="text-strobe"><?php echo $enquiry['added']; ?></h5>
						<table class="table table-sm table-striped">
							<tbody>
								<tr><td><i class="fa fa-user-o pr-2"></i><?php echo $enquiry['ename']; ?></td></tr>
								<tr><td><i class="fa fa-envelope-o pr-2"></i><?php echo $enquiry['email']; ?></td></tr>
								<tr><td><i class="fa fa-phone pr-2"></i><?php echo $enquiry['ephone']; ?></td></tr>
								<tr><td><i class="fa fa-comment-o pr-2"></i><?php echo $enquiry['enquiry']; ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			<?php 
				endforeach;
				endif;
			?>
		</div>
	</div>
</div>

</div>
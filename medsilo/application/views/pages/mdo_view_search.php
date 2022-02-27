<div class="content-wrapper">

<div class="container-fluid bg-mercury text-strobe pt-2 text-center jumbotron-hero">
	<div class="row">
		<div class="col-12">
			<h1><i class="fa fa-search pr-2"></i>Search</h1>
		</div>
	</div>
</div>

<div class="container jumbotron-hero py-4">
	<div class="row no-gutter justify-content-center">
		<div class="col-lg-8">
			<h3 class="text-strike pb-2">Showing results for - <?php echo $search; ?></h3>
			<!-- Products Block Begin -->
			<div class="row">
			<?php
			foreach($products as $products_item):
			$thumb = base_url()."uploads/".str_replace(" ","_",$products_item['pimage']);
			?>
				<div class="col-sm-6 col-lg-4">
					<div class="card product-card text-center mb-3">
						<img class="card-img-top img-fluid w-75 mx-auto" src="<?php echo $thumb; ?>" />
						<div class="card-block">
							<h4 class="card-title text-strobe"><?php echo $products_item['pname']; ?></h4>
							<h5 class="card-subtitle text-muted pb-2"><?php echo $products_item['ptype']; ?></h5>
							<a data-toggle="modal" href="<?php echo base_url(); ?>products/<?php echo $products_item['pid']; ?>" data-target='#detailModal' class="btn btn-secondary btn-sm" id="<?php echo $products_item['pid']; ?>"><i class="fa fa-plus-square pr-1"></i>View</a>
						</div>
					</div>
				</div>
			<?php
			endforeach;
			?>
			</div>
			<!-- Products Block End -->
			</div>
		</div>
	</div>
</div>

<div id="detailModal" class="modal fade modal-fullscreen" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-strobe">
		<img src="<?php echo base_url(); ?>assets/logos/medsilo_logo.png" class="align-middle" id="modal-icon" />
		Medsilo
		</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle pr-1"></i>Close</button>
      </div>
    </div>
  </div>
</div>

</div>
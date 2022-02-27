<div class="content-wrapper">
<?php
$caption = array("To incessantly elevating people's life by delivering quality healthcare products.","Marketing the best products on demand in the pharmaceuticals industry.","Providing affordable and superior healthcare products to serve people better.");
?>

<?php for($i=1;$i<=3;$i++): ?>
<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-strobe py-3 mb-0" id="carousel-<?php echo $i; ?>">
	<div class="container">
		<div class="row no-gutter">
			<div class="col-lg-6 my-auto">
				<img src="<?php echo base_url(); ?>assets/images/carousel_<?php echo $i; ?>.png" class="img-fluid pt-3 mx-auto d-md-block" />
			</div>
			<div class="col-lg-6 my-auto">
				<h1 class="text-left text-white text-carousel"><?php echo $caption[$i-1]; ?></h1>
			</div>
		</div>
	</div>
</div>
<?php endfor; ?>
<!-- Jumbotron End -->

<!-- Introduction -->

<?php
$about = simplexml_load_file(base_url()."assets/xml/about.xml");
?>
<div class="jumbotron jumbotron-fluid jumbotron-hero text-center bg-strike py-4 mb-0">
	<div class="container">
		<h1 class="text-white pt-2">
		<i class="fa fa-medkit pr-2"></i><small>Better Medicine</small>
		<i class="fa fa-plus-square pr-2"></i><small>Better Health</small>
		<i class="fa fa-heartbeat pr-2"></i><small>Better Life</small>	
		</h1>
		<p class="lead text-center text-white pt-3"><?php echo $about->introduction->content[0]; ?></p>
		<a class="btn btn-secondary btn-lg" href="<?php echo base_url(); ?>products"><i class="fa fa-th pr-2"></i>View Products</a>
	</div>
</div>

<!-- Introduction End -->

<!-- Features Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero text-center bg-mercury py-4 mb-0">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<?php
					$features = simplexml_load_file(base_url()."assets/xml/features.xml");
					for($f=1;$f<=5;$f++):
						$para = 'para_'.$f;
				?>
				<div class="card mb-2 px-2 pt-4">
					<img class="card-img-top mx-auto" src="<?php echo base_url(); ?>assets/icons/<?php echo $features->$para->icon; ?>">
					<div class="card-block">
						<h1 class="card-title mx-auto text-strobe"><?php echo $features->$para->title; ?></h1>
						<p class="text-gray"><?php echo $features->$para->content; ?></p>
					</div>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>
<!-- Features End -->

<!-- Jumbotron Begin -->
<div class="jumbotron jumbotron-fluid jumbotron-hero bg-strike text-white py-3 mb-0">
	<div class="container">
		<div class="row justify-content-center">
		<div class="col-lg-6 text-left py-2">
		<?php
			$worktime = simplexml_load_file(base_url()."assets/xml/worktime.xml");
		?>
		<h2 class="mx-auto pb-2"><span class="fa fa-clock-o pr-2"></span>Working Hours</h2>
		<h5><?php echo $worktime->weekdays . " " . $worktime->wdtime; ?></h5>
		<h5><?php echo $worktime->sunday . " " . $worktime->suntime; ?></h5>
		</div>
		<div class="col-lg-3 text-left py-2">
		<h2 class="mx-auto pb-2"><span class="fa fa-calendar-o pr-2"></span>Now&nbsp;<span id="availability"></span></h2>
		<h5 class="clock pb-1"><div id="clockbox"></div></h5>
		</div>
		</div>
	</div>
</div>
<!-- Jumbotron End -->
</div>
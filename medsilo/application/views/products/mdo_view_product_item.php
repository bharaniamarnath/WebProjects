<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<div class="container jumbotron-hero">
	<div class="row no-gutter">
		<div class="col-lg-6">
			<?php
				$p_image = base_url() . "uploads/" . $products_item['pimage'];
			?>
			<?php if(empty($products_gallery)){ ?>
				<a class="image-box-link" href="<?php echo $p_image; ?>" data-toggle="lightbox" data-title="<?php echo $products_item['pname']; ?>"><img src="<?php echo $p_image; ?>" class="img-fluid mx-auto" alt="<?php echo $products_item['pname']; ?>" /></a>
			<?php }else{ ?>
				<div class="gallerybtn float-right pt-2 px-2">
					<button class="btn btn-secondary btn-sm" id="previtem" name="previtem">
						<i class="fa fa-chevron-left"></i>
					</button>
					<button class="btn btn-primary btn-sm" id="nextitem" name="nextitem">
						<i class="fa fa-chevron-right"></i>
					</button>
				</div>
				<ul id="gallery">
					<li>
						<a class="image-box-link" href="<?php echo $p_image; ?>" data-toggle="lightbox" data-title="<?php echo $products_item['pname']; ?>"><img class="img-fluid image-box mx-auto" src="<?php echo $p_image; ?>"></img></a>
					</li>
					<?php foreach($products_gallery as $product_gallery){
						$gallery_image = base_url() . "uploads/" . $product_gallery['link'];
					?>
					<li>
						<a href="<?php echo $gallery_image; ?>" class="image-box-link" data-toggle="lightbox" data-title="<?php echo $products_item['pname']; ?>"><img class="img-fluid image-box mx-auto" src="<?php echo $gallery_image ?>" alt="<?php echo $products_item['pname']; ?>"></img></a>
					</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
		<div class="col-lg-6 text-left">
			<h1 class="text-strobe"><?php echo $products_item['pname']; ?></h1>
			<h3 class="text-strike"><?php echo $products_item['pcombination']; ?></h3>
			<h4 class="text-muted"><?php echo $products_item['pcategory']; ?></h4>
			<h4 class="text-strobe"><?php echo $products_item['ptype']; ?></h4>
			<h5 class="text-muted">Description</h5>
			<p class="text-strike">
			<?php
				$parabreak = '</p><p class="text-strike">';
				$description = str_replace("_",$parabreak,$products_item['pdescription']);
				echo $description; 
			?>
			</p>
			<?php
				$indications = $products_item['pindication'];
				if($indications == ""):
					echo "";
				else:
					$indications = rtrim($indications,".");
					$indications = explode(".",$indications);
			?>
			<h5 class="text-muted">Indications</h5>
			<ul class="text-strike">
			<?php
				foreach($indications as $gpi):
			?>
				<li><?php echo trim($gpi); ?></li>
			<?php endforeach; ?>
			</ul>
			<?php
				endif;
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#previtem').attr('disabled',true);
	$('ul#gallery li').first().addClass('first').addClass('current');
	$('ul#gallery li').last().addClass('last');
	$('ul#gallery li').hide();
	$('.current').show();
	$('#nextitem').click(function(){
		$('.current').removeClass('current').hide().next().show().addClass('current');
		if($('.current').hasClass('last')){
		$('#nextitem').attr('disabled',true);
		}
		$('#previtem').attr('disabled',null);
	});

	$('#previtem').click(function(){
		$('.current').removeClass('current').hide().prev().show().addClass('current');
		if($('.current').hasClass('first')){
		$('#previtem').attr('disabled',true);
		}
		$('#nextitem').attr('disabled',null);
	});
});
</script>
</body>
</html>
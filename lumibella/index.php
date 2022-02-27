<!DOCTYPE HTML>
<html>
<head>
<title>Lumibella Fashions</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/animsition.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="index-background">
<div id="domMessage" style="display:none;"> 
<h1>Loading...</h1> 
</div> 
<div class="loader"></div>
<div data-keyboard="true" id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php include('header.php'); ?>
<div class="row index-page animsition fade-in-down">
<div class="row">
<div class="col-md-12 col-lg-12">
<div class="index-ad">
<div class="index-ad-block">
<h2>Grand weekend on new designer models showroom</h2>
<a href="#" class="btn btn-default btn-lg">Visit Now</a>
</div>
<img src="images/carousel/indexad.jpg" class="img-responsive" />
</div>
</div>
</div>
<div class="row">
<div class="col-md-4 col-lg-4">
<div class="index-block-one">
<div class="block-one-ad">
<h5>New stylish designer handbags</h5>
<a class="btn btn-default btn-lg" href="products.php?section=Women&category=Handbag&subcategory=Sling">View More</a>
</div>
<img class="img-responsive" src="images/contents/index-block-1.jpg" />
</div>
</div>
<div class="col-md-4 col-lg-4">
<div class="row">
<div class="col-md-12 col-lg-12 index-block-two">
<img class="img-responsive" src="images/contents/index-block-2.jpg" />
<div class="block-two-ad">
<h4>Fancy Traditional Jewelries</h4>
<a class="btn btn-default btn-lg" href="products.php?section=Women&category=Jewelry&subcategory=Necklace">Traditional Jewels</a>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12 col-lg-12 index-block-three">
<img class="img-responsive" src="images/contents/index-block-3.jpg" />
<div class="block-three-ad">
<a class="btn btn-default btn-lg" href="products.php?section=Women&category=Jewelry&subcategory=Bracelet">Imported Jewels</a>
</div>
</div>
</div>
</div>
<div class="col-md-4 col-lg-4">
<div class="index-block-four">
<img class="img-responsive" src="images/contents/index-block-4.jpg" />
<div class="block-four-ad">
<h5>Get the perfect quality men&#39;s wallets and purses</h5>
<a class="btn btn-default btn-lg" href="products.php?section=Men&category=Wallet&subcategory=Leather">Men Wallets</a>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4 col-lg-4">
<div class="index-block-five">
<img class="img-responsive" src="images/contents/index-block-5.jpg" />
<div class="block-five-ad">
<h5>Cool &amp; Trendy wearings for men</h5>
<a class="btn btn-default btn-lg" href="products.php?section=Men&category=Jewelry&subcategory=Bracelet">Men&#39;s Wearings</a>
</div>
</div>
</div>
<div class="col-md-8 col-lg-8">
<div class="index-block-six">
<img class="img-responsive" src="images/contents/index-block-6.jpg" />
<div class="block-six-ad">
<h5>Stylish apparels and accessories for kids and toddlers</h5>
<a class="btn btn-default btn-lg" href="products.php?section=Kids&category=Apparels&subcategory=Shirt">Coolest Kids Apparels</a>
</div>
</div>
</div>
</div>
</div>
<?php include('footer.php'); ?>

<!-- Modal Loader Begin /-->
<div id="indexModal" class="modal fade slow" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close modal-close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h3><span><img class="img-responsive pull-left modalLogo" src="images/logo/logo.png" /></span> Like us on facebook now!</h3>
</div>
<div class="modal-body">
<img class="img-responsive" src="images/contents/index-modal.jpg" />
<p>Visit our facebook page now and get more exclusive updates</p>
<div class="fb-like" data-href="https://www.facebook.com/Lumibella-890072817724970/timeline/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal Loader End /-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/call.animsition.js"></script>
<script src="js/countcart.js"></script>
<script src="js/js.cookie.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
     if ($.cookie('pop') == null) {
         $('#indexModal').modal('show');
         $.cookie('pop', '7');
     }
 });
</script>
</body>
</html>
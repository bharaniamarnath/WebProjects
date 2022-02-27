<script type="text/javascript" src="<?php echo base_url() ?>resources/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>resources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".no-js").hide();
		$(".page-wrapper").show();
	});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#openMainNav').click(function(){
		$('#mainNav').animate({
		  left: "0px"
		}, 200);

		$('body').animate({
		  left: "250px"
		}, 200);
	});
	$('#closeMainNav').click(function(){
		$('#mainNav').animate({
		  left: "-250px"
		}, 200);

		$('body').animate({
		  left: "0px"
		}, 200);
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#mainNav .nav-link').click(function(){
		$('#mainNav').animate({
		  left: "-250px"
		}, 200);

		$('body').animate({
		  left: "0px"
		}, 200);
	});
});
</script>
<script>
$(document).ready(function() {
var docHeight = $(window).height();
var footerHeight = $('.footbar').height();
var footerTop = $('.footbar').position().top + footerHeight;
if (footerTop < docHeight) {
$('.footbar').css('margin-top', 10+ (docHeight - footerTop) + 'px');
}
});
</script>
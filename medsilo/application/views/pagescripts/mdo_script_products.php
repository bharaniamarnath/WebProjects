<script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/bs-modal-fullscreen.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/scriptProducts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/ekko-lightbox.min.js"></script>
<!-- Lightbox Script -->
<script type="text/javascript">
$(document).delegate('[data-toggle="lightbox"]', 'click', function(event) { 
event.preventDefault(); 
$(this).ekkoLightbox(); 
}); 
</script>


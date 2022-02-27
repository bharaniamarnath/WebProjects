<script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/validateCareer.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#cdob').datepicker({
		format: "dd/mm/yyyy"
	});
});
</script>

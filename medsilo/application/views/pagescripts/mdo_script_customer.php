<script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/validateList.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resources/js/validatePrescription.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper 
    var x = 1; //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append('<div><a href="javascript:void(0);" class="small pull-right mb-1 remove_button" title="Remove field"><i class="fa fa-times pr-1"></i>Remove</a><small class="form-text text-fuschia">Product ' + x + '</small><input class="form-control product my-1" type="text" name="product[' + x + ']" value="" /><small class="form-text text-fuschia">Quantity</small><input class="form-control quantity my-1" type="text" name="quantity[' + x + ']" value="" /></div>'); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
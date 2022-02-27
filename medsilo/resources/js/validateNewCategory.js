$(document).ready(function() {
jQuery.validator.addMethod("charsonly",function(value,element){
	return this.optional(element) || /^[A-Za-z\s\.]+$/.test(value);
},"Numbers and special characters not allowed.");
jQuery.validator.addMethod("numsonly",function(value,element){
	return this.optional(element) || /^[0-9\s\.]+$/.test(value);
},"Letters and special characters not allowed.");
jQuery.validator.addMethod("filteredtext",function(value,element){
	return this.optional(element) || /^[0-9A-za-z_\s\.\,\/\@\$\!\-\?\&\%\(\)]+$/.test(value);
},"Special characters not allowed.");
var validator = $("#ncform").validate({
	ignore: [],
	rules: {
		ncname: {
			required: true,
			filteredtext: true,
			minlength: 4,
			maxlength: 30
		}
	},
	messages: {
		ncname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		}
	},
	submitHandler: function(form) {
		$("#sendform").prop("disabled",true);
		var wait = '<h1 class="text-strike"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
		$(form).ajaxSubmit({
			type:"POST",
			data: $('#ncform').serialize(),
			url:baseurl+'admin/category/add',
			beforeSend: function(){
				$("#statusModal").on('show.bs.modal', function () {
					$("#statusModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#statusModal .modal-body").html(data);
				validator.resetForm();
				$("#sendform").prop("disabled",false);
			},
			error: function(jxt,status,message) {
				console.log(status + message);
				$("#sendform").prop("disabled",false);
			}
		});
	}
});
});
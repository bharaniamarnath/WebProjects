$(document).ready(function() {
jQuery.validator.addMethod("charsonly",function(value,element){
	return this.optional(element) || /^[A-Za-z\s\.]+$/.test(value);
},"Numbers and special characters not allowed.");
jQuery.validator.addMethod("numsonly",function(value,element){
	return this.optional(element) || /^[0-9\s\.]+$/.test(value);
},"Letters and special characters not allowed.");
jQuery.validator.addMethod("filteredtext",function(value,element){
	return this.optional(element) || /^[0-9A-za-z_\s\.\,\@\$\!\-\?\&\%\(\)]+$/.test(value);
},"Special characters not allowed.");
var validator = $("#epform").validate({
	ignore: [],
	rules: {
		epname: {
			required: true,
			filteredtext: true,
			minlength: 4,
			maxlength: 30
		},
		epcategory: {
			required: true
		},
		eptype: {
			required: true
		},
		epcombination: {
			required: true,
			minlength: 4,
			maxlength: 512
		},
		epdescription: {
			required: true,
			minlength: 4,
			maxlength: 1024
		},
		epindications: {
			required: true,
			minlength: 4,
			maxlength: 1024
		}
	},
	messages: {
		epname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		epcombination: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 512 characters")
		},
		epdescription: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 4096 characters")
		},
		epindications: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 4096 characters")
		}
	},
	errorPlacement: function(error, element) {
		if(element.attr("name") === "epimage"){
			error.appendTo("#file-error");
		}
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendform").prop("disabled",true);
		var wait = '<h1 class="text-strike"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
		$(form).ajaxSubmit({
			type:"POST",
			data: $('#epform').serialize(),
			url:baseurl+'admin/product/modify',
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
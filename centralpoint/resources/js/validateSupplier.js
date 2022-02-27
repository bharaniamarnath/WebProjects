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
var validator = $("#suform").validate({
	ignore: [],
	rules: {
		suname: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 30
		},
		sulicno: {
			required: true,
			minlength: 4,
			maxlength: 25
		},
		lictype: {
			required: true
		},
		licstatus: {
			required: true
		},
		subizact: {
			required: true
		},
		suphone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 15
		},
		suemail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 56
		},
		suaddress: {
			required: true,
			minlength: 4,
			maxlength: 1024,
			filteredtext: true
		},
		suterms: {
			required: true
		}
	},
	messages: {
		suname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		suphone: {
			minlength: jQuery.validator.format("Must have atleast 10 digits."),
			maxlength: jQuery.validator.format("Must not exceed 15 digits.")
		},
		sumail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		suaddress: {
			maxlength: jQuery.validator.format("Must have only 1024 characters")
		},
		suterms: {
			required: "Terms & Conditions must be accepted"
		}
	},
	errorPlacement: function(error, element) {
		if (element.attr("name") === "suterms") {
			error.insertAfter("#check-label");
		} 
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendform").prop("disabled",true);
		var wait = '<h1 class="text-fuschia"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
		$(form).ajaxSubmit({
			type:"POST",
			data: $('#suform').serialize(),
			url:baseurl+'supplier/send',
			beforeSend: function(){
				$("#enquiryModal").on('show.bs.modal', function () {
					$("#enquiryModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#enquiryModal .modal-body").html(data);
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
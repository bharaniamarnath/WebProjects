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
var validator = $("#prform").validate({
	ignore: [],
	rules: {
		prname: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 40
		},
		premail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 50
		},
		prphone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 15
		},
		prcategory: {
			required: true
		},
		prfile: {
			required: true,
			accept: "application/pdf,application/msword"
		},
		prterms: {
			required: true
		}
	},
	messages: {
		prname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		premail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		prphone: {
			minlength: jQuery.validator.format("Must have atleast 10 digits."),
			maxlength: jQuery.validator.format("Must not exceed 15 digits.")
		},
		prfile: {
			required: "Prescription file is required",
			accept: "File must be PDF or DOC, less than 2MB"
		},
		prterms: {
			required: "Terms & Conditions must be accepted"
		}
	},
	errorPlacement: function(error, element) {
		if (element.attr("name") === "plterms") {
			error.insertAfter("#pr-label");
		}
		else if (element.attr("name") === "prcategory") {
            error.insertAfter("#pr-label-retail-shop");       
        }
		else if(element.attr("name") === "prfile"){
			error.appendTo("#file-error");
		}
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendprescription").prop("disabled", true);
		var wait = '<h1 class="text-fuschia"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: baseurl+'customer/prescription',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
			beforeSend: function(){
				$("#customerModal").on('show.bs.modal', function () {
					$("#customerModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#customerModal .modal-body").html(data);
				validator.resetForm();
				$("#sendprescription").prop("disabled",false);
			},
			error: function(jxt,status,message) {
				console.log(status + message);
				$("#sendprescription").prop("disabled",false);
			}
		});
	}
});
});
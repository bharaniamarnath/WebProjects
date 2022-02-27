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
var validator = $("#cform").validate({
	ignore: [],
	rules: {
		cname: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 40
		},
		cemail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 50
		},
		cphone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 15
		},
		cgender: {
			required: true
		},
		cdob: {
			required: true
		},
		cqualification: {
			required: true
		},
		cexperience: {
			required: true
		},
		caddress: {
			required: true
		},
		cfile: {
			required: true,
			accept: "application/pdf,application/msword"
		},
		cterms: {
			required: true
		}
	},
	messages: {
		cname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		cemail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		cphone: {
			minlength: jQuery.validator.format("Must have atleast 10 digits."),
			maxlength: jQuery.validator.format("Must not exceed 15 digits.")
		},
		cfile: {
			required: "Resume file is required",
			accept: "File must be PDF or DOC, less than 2MB"
		},
		cterms: {
			required: "Terms & Conditions must be accepted"
		}
	},
	errorClass: 'error',
	errorPlacement: function(error, element) {
		if (element.attr("name") === "cterms") {
			error.insertAfter("#check-label");
		}
        else if (element.attr("name") === "cgender") {
            error.insertAfter("#radio-label-f");       
        }
		else if (element.attr("name") === "cfile"){
			error.appendTo("#file-error");
		}
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendform").prop("disabled", true);
		var wait = '<h1 class="text-fuschia"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: baseurl+'career/send',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
			beforeSend: function(){
				$("#careerModal").on('show.bs.modal', function () {
					$("#careerModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#careerModal .modal-body").html(data);
				validator.resetForm();
				$("#file-label").html("");
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
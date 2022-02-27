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
$.validator.addClassRules("product", {
	required: true,
	minlength: 4,
	maxlength: 100
});
$.validator.addClassRules("quantity", {
	required: true,
	minlength: 2,
	maxlength: 15
});
var validator = $("#plform").validate({
	ignore: [],
	rules: {
		plname: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 30
		},
		plphone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 15
		},
		plemail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 56
		},
		plcategory: {
			required: true
		},
		plterms: {
			required: true
		}
	},
	messages: {
		plname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		plphone: {
			minlength: jQuery.validator.format("Must have atleast 10 digits."),
			maxlength: jQuery.validator.format("Must not exceed 15 digits.")
		},
		plemail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		emessage: {
			maxlength: jQuery.validator.format("Must have only 1024 characters")
		},
		plterms: {
			required: "Terms & Conditions must be accepted"
		}
	},
	errorPlacement: function(error, element) {
		if (element.attr("name") === "plterms") {
			error.insertAfter("#pl-label");
		}
		else if (element.attr("name") === "plcategory") {
            error.insertAfter("#pl-label-retail-shop");       
        }
		else if (element.hasClass("product")) {
			error.insertAfter(element);
		}
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendlist").prop("disabled",true);
		var wait = '<h1 class="text-fuschia"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
		$(form).ajaxSubmit({
			type:"POST",
			data: $('#plform').serialize(),
			url:baseurl+'customer/sendlist',
			beforeSend: function(){
				$("#customerModal").on('show.bs.modal', function () {
					$("#customerModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#customerModal .modal-body").html(data);
				validator.resetForm();
				$("#sendlist").prop("disabled",false);
			},
			error: function(jxt,status,message) {
				console.log(status + message);
				$("#sendlist").prop("disabled",false);
			}
		});
	}
});
});
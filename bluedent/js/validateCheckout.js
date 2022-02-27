$(document).ready(function() {
jQuery.validator.addMethod("charsonly",function(value,element){
	return this.optional(element) || /^[A-Za-z\s\.]+$/.test(value);
},"Numbers and special characters not allowed.");
jQuery.validator.addMethod("numsonly",function(value,element){
	return this.optional(element) || /^[0-9\s\.]+$/.test(value);
},"Letters and special characters not allowed.");
$("#checkoutForm").validate({
	rules: {
		dname: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 28
		},
		demail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 56
		},
		dphone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 10
		},
		daddr: {
			required: true,
			minlength: 4,
			maxlength: 1024
		},
		dpin: {
			required: true,
			numsonly: true,
			minlength: 6,
			maxlength: 6
		}
	},
	messages: {
		dname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		demail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		dphone: {
			minlength: jQuery.validator.format("Must have only 10 digits."),
			maxlength: jQuery.validator.format("Must have only 10 digits.")
		},
		daddr: {
			maxlength: jQuery.validator.format("Must have only 1024 characters")
		},
		dpin: {
			minlength: jQuery.validator.format("Must have only 6 digits."),
			maxlength: jQuery.validator.format("Must have only 6 digits.")			
		}
	},
	submitHandler: function(form){
		$("#enquiry-submit").show().slideDown();
		form.submit();
	}
});
});
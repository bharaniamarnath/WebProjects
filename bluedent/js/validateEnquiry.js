$(document).ready(function() {
jQuery.validator.addMethod("charsonly",function(value,element){
	return this.optional(element) || /^[A-Za-z\s\.]+$/.test(value);
},"Numbers and special characters not allowed.");
jQuery.validator.addMethod("numsonly",function(value,element){
	return this.optional(element) || /^[0-9\s\.]+$/.test(value);
},"Letters and special characters not allowed.");
$("#enquiryForm").validate({
	rules: {
		ename: {
			required: true,
			charsonly: true,
			minlength: 4,
			maxlength: 28
		},
		eemail: {
			required: true,
			email: true,
			minlength: 4,
			maxlength: 56
		},
		ephone: {
			required: true,
			numsonly: true,
			minlength: 10,
			maxlength: 10
		},
		eenquiry: {
			required: true,
			minlength: 4,
			maxlength: 1024
		}
	},
	messages: {
		ename: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		eemail: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		ephone: {
			minlength: jQuery.validator.format("Must have only 10 digits."),
			maxlength: jQuery.validator.format("Must have only 10 digits.")
		},
		eenquiry: {
			maxlength: jQuery.validator.format("Must have only 1024 characters")
		}
	},
	submitHandler: function(form){
		$("#enquiry-submit").show().slideDown();
		form.submit();
	}
});
});
$(document).ready(function() {
jQuery.validator.addMethod("charsonly",function(value,element){
	return this.optional(element) || /^[A-Za-z\s\.]+$/.test(value);
},"Numbers and special characters not allowed.");
jQuery.validator.addMethod("numsonly",function(value,element){
	return this.optional(element) || /^[0-9\s\.]+$/.test(value);
},"Letters and special characters not allowed.");
jQuery.validator.addMethod("alphanumonly",function(value,element){
	return this.optional(element) || /^[-A-Za-z0-9\s\.+&,_ ]+$/.test(value);
},"Special characters not allowed.");
$("#replyEnquiryForm").validate({
	rules: {
		replyTo: {
			required: true,
			email: true,
			minlength: 4
		},
		replySubject: {
			required: true,
			maxlength: 50,
			minlength: 4
		},
		replyMessage: {
			required: true,
			maxlength: 1024,
			minlength: 4,
			alphanumonly: true
		}
	},
	messages: {
		replyTo: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		replySubject: {
			maxlength: jQuery.validator.format("Must have only 50 characters")
		},
		replyMessage: {
			maxlength: jQuery.validator.format("Must have only 1024 characters")
		}
	},
	submitHandler: function(form){
		form.submit();
	}
});
});
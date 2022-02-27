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
$("#adminLoginForm").validate({
	rules: {
		username: {
			required: true,
			minlength: 4,
			maxlength: 20
		},
		passwd: {
			required: true,
			maxlength: 20,
			minlength: 4
		}
	},
	messages: {

	},
	submitHandler: function(form){
		form.submit();
	}
});
});
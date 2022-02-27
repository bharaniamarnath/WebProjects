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
$("#addFileForm").validate({
	rules: {
		filename: {
			required: true,
			minlength: 4
		}
	},
	messages: {
		filename: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		}
	},
	submitHandler: function(form){
		form.submit();
	}
});
});
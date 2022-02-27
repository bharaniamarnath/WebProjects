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
$("#addProductForm").validate({
	rules: {
		pname: {
			required: true,
			minlength: 4
		},
		pcategory: {
			required: true
		},		
		psubcategory: {
			required: true
		},
		pdescription: {
			required: true,
			maxlength: 1024
		},
		image: {
			required: true
		}
	},
	messages: {
		pname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		pdescription: {
			maxlength: jQuery.validator.format("Must have only 10000 characters")
		}
	},
	submitHandler: function(form){
		form.submit();
	}
});
});
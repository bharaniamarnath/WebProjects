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
var validator = $("#npform").validate({
	ignore: [],
	rules: {
		npname: {
			required: true,
			filteredtext: true,
			minlength: 4,
			maxlength: 30
		},
		npcategory: {
			required: true
		},
		nptype: {
			required: true
		},
		npcombination: {
			required: true,
			minlength: 4,
			maxlength: 512
		},
		npdescription: {
			required: true,
			minlength: 4,
			maxlength: 1024
		},
		npindications: {
			required: true,
			minlength: 4,
			maxlength: 1024
		},
		npimage: {
			required: true,
			accept: "image/jpg,image/jpeg"
		}
	},
	messages: {
		npname: {
			minlength: jQuery.validator.format("Must have atleast 4 characters.")
		},
		npcombination: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 512 characters")
		},
		npdescription: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 4096 characters")
		},
		npindications: {
			minlength: jQuery.validator.format("Must have only 4 characters"),
			maxlength: jQuery.validator.format("Must have only 4096 characters")
		},
		npimage: {
			required: "Product image is required",
			accept: "File must be JPG format, less than 2MB"
		}
	},
	errorPlacement: function(error, element) {
		if(element.attr("name") === "npimage"){
			error.appendTo("#file-error");
		}
		else {
			error.appendTo(element.parent());
		}
	},
	submitHandler: function(form) {
		$("#sendform").prop("disabled", true);
		var wait = '<h1 class="text-strike"><i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i></h1><h1 class="display-4">Please Wait...</h1>';
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            enctype: "multipart/form-data",
            url: baseurl+'admin/product/add',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
			beforeSend: function(){
				$("#statusModal").on('show.bs.modal', function () {
					$("#statusModal .modal-body").html(wait);
				}).modal();
			},
			success: function(data) {
				$("#statusModal .modal-body").html(data);
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
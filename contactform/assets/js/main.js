$(document).ready(function(){

    jQuery.validator.addMethod("zipcodeformat", function(value, element) {
        return this.optional(element) || /^\d{5}(?:[-\s]\d{4})?$/.test(value);
    }, "Please specify a valid ZIP code");

    // Group Registration

    $("#contactForm").validate({
        rules: {
            contactName: {
                required: true,
                rangelength: [4, 28]
            },
            contactEmail: {
                required: true,
                email: true,
                rangelength: [8, 56]
            },
            contactPhone: {
                required: true,
                phoneUS: true,
                rangelength: [10, 10]
            },
            contactMessage: {
                required: true,
                rangelength: [8, 256]
            },
            contactFile: {
                required: true,
                accept: "application/pdf"
            },
            contactCaptcha: {
                required: true,
                equalTo: "#contactCaptchaVal"
            },
            contactTerms: {
                required: true
            }
        },
        messages: {
            contactCaptcha: {
                equalTo: "Incorrect Answer"
            },
            contactFile: {
                accept: "Only PDF file format is accepted"
            }
        },
        errorPlacement: function(error, element) {
            if(element.attr("name") == "contactTerms") {
                error.appendTo("#contactTermsError");
            }
            else if(element.attr("name") == "contactFile") {
                error.appendTo("#contactFileError");
            }
            else{
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            if($(form).valid()){
                $('#contactFormSend').attr('disabled', true);
                $('#contactFormSend').addClass('disabled');
                $('#contactFormSend').attr('value', 'Processing...')
                form.submit();
            }
            return false;
        }
    });

});


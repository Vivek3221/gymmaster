
function reloadCaptcha()
{

    jQuery('#captcha_image').prop('src', 'securimage/securimage_show.php?sid=' + Math.random());
}

$(function () {
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    });
    jQuery.validator.addMethod("isValidPhoneNo", function (value, element) {
        return $("#phoneno").intlTelInput("isValidNumber"); // return true if field is ok or should be ignored
    });
});

$(document).ready(function () {

    //$("#phone_full").val($("#phoneno").intlTelInput("getNumber"));


   
    
    
    
    $("#editProfileForm").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            "Users[name]": {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/

            },
            "Users[password]": {
                required: true
            }
        },
        messages: {
            "Users[name]": {
                required: 'Enter Name',
                regex: 'Enter valid  name'
            },

            "Users[password]": {
                required: 'Enter password',
            }
        }
    });
     $("#addusers").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            user_type: {
                required: true
            },
            location: {
                required: true
            },
            name: {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/
            },
            dob: {
                required: true
            },
            
            email: {
                required: true,
               regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/
                },
            
            
            mobile_no: {
                required: true,
               // isValidCmobileNo: true,
                regex: /^$|^[0-9]{10,15}$/
            },
             emerg_no: {
                regex: /^$|^[0-9]{5,15}$/
            }
        },
        messages: {
            user_type: {
                required: 'Select user type'
            },
            location: {
                required: 'Enter location'
            },
            name: {
                required: 'Enter name',
                regex: 'Enter valid  name'
            },
            dob: {
                required: 'Enter DOB'
            },
           
            email: {
                required: 'Enter email Id',
                regex: 'Enter valid email Id'
            },
            mobile_no: {
                required:'Enter mobile number',
               // isValidUmobileNo:'Enter valid mobile number',
               regex: 'Enter valid mobile No.'
            },
            emerg_no: {
                regex: 'Enter valid mobile No.'
            }
        }
    });
     $("#payment").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            user_type: {
                required: true
            },
            mode_ofpay: {
                required: true
            },
            course_duration: {
                required: true
            },
            active: {
                required: true
            },
            location: {
                required: true
            },
            name: {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/
            },
            dob: {
                required: true
            },
            payment: {
                required: true,
                regex: /[0-9]$/
            },
            b_payment: {
                regex: /^$|^[0-9]$/
            },
            
            email: {
                required: true,
               regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/
                },
            
            
            mobile_no: {
                required: true,
               // isValidCmobileNo: true,
                regex: /^$|^[0-9]{10,15}$/
            },
             emerg_no: {
                regex: /^$|^[0-9]{5,15}$/
            },
            password: {
                required: true,
                regex: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/

            },
            cpassword: {
                required: true,
                equalTo: "#npassword"
            }
        },
        messages: {
            user_type: {
                required: 'Select user type'
            },
            mode_ofpay: {
                required: 'Select mode of payment'
            },
            course_duration: {
                required: 'Select course of duration'
            },
            active: {
                required: 'Select status'
            },
            location: {
                required: 'Enter location'
            },
            name: {
                required: 'Enter name',
                regex: 'Enter valid  name'
            },
            dob: {
                required: 'Enter DOB'
            },
            payment: {
                required: 'Enter payment',
                regex: 'Enter valid payment'
            },
            b_payment: {
                regex: 'Enter valid due payment'
            },
           
            email: {
                required: 'Enter email Id',
                regex: 'Enter valid email Id'
            },
            mobile_no: {
                required:'Enter mobile number',
               // isValidUmobileNo:'Enter valid mobile number',
               regex: 'Enter valid mobile No.'
            },
            emerg_no: {
                regex: 'Enter Valid mobile No.'
            },
            password: {
                required: 'Enter password',
                regex: 'Enter password 6-16 alphanumeric & one special character.'
            },
            cpassword: {
                required: 'Enter confirm password',
                equalTo: 'Passwor & confirm password does not match'
            }
        }
    });
     $("#editusers").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            user_type: {
                required: true
            },
            name: {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/
            },
            
            email: {
                required: true,
               regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/
                },
            
            
            mobile_no: {
                required: true,
               // isValidCmobileNo: true,
                regex: /^$|^[0-9]{5,15}$/
            }
        },
        messages: {
            user_type: {
                required: 'Select User type'
            },
            name: {
                required: 'Enter User Name',
                regex: 'Enter valid  name'
            },
           
            email: {
                required: 'Enter Email Id',
                regex: 'Enter valid Email Id'
            },
            mobile_no: {
                required:'Enter Mobile number',
               // isValidUmobileNo:'Enter valid mobile number',
               regex: 'Enter valid mobile No.'
            }
        }
    });
     $("#addexercise").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            body_id: {
                required: true
            },
            name: {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/
            }
        },
        messages: {
            body_id: {
                required: 'Select Body'
            },
            name: {
                required: 'Enter Exercise Name',
                regex: 'Enter valid  name'
            }
        }
    });
     $("#editexercise").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            body_id: {
                required: true
            },
            name: {
                required: true,
               regex: /^[a-zA-Z ]{3,50}$/
            }
        },
        messages: {
            body_id: {
                required: 'Select Body'
            },
            name: {
                required: 'Enter Exercise Name',
                regex: 'Enter valid  name'
            }
        }
    });
    $("#adminloginform").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            email: {
                required: true,
               regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/

            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Enter Email Id',
                regex: 'Enter valid Email Id'
            },

            password: {
                required: 'Enter password',
            }
        }
    });
    
    $("#bodym").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            weight: {
                required: true,
               regex: /^[0-9]{1,3}$/

            },
            height: {
                required: true,
               regex: /^[0-9]{1,3}$/

            },
            neck: {
                required: true,
               regex: /^[0-9]{1,3}$/

            },
            password: {
                required: true
            }
        },
        messages: {
            weight: {
                required: 'Enter weight',
                regex: 'Enter weight in KG'
            },
            height: {
                required: 'Enter height',
                regex: 'Enter height in CM'
            },
            neck: {
                required: 'Enter neck',
                regex: 'Enter neck in Inch'
            },

            password: {
                required: 'Enter password',
            }
        }
    });
    
     $("#changepassword").validate({
        ignore: ":hidden",
        errorElement: 'span',
        errorClass: 'help-inline',
        highlight: function (element) {
            $(element).parent().addClass("error");
        },
        unhighlight: function (element) {
            $(element).parent().removeClass("error");
        },
        rules: {

            password: {
                required: true
            },
            newpassword: {
                required: true,
                regex: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/

            },
            confirmpassword: {
                required: true,
                equalTo: "#npassword",
                regex: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/
            }

        },
        messages: {

            password: {
                required: 'Enter your current password.'
            },
            newpassword: {
                required: 'Enter new password',
                regex: 'Enter password 6-16 alphanumeric & one special character.'
            },
            confirmpassword: {
                required: 'Enter confirm password',
                equalTo: 'password and confirm password do not match.'
            }
        }
    });
    

});





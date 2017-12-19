
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
    $("#errorloginform").validate({
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

            "Users[email]": {
                required: true,
               regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/

            },
            "Users[password]": {
                required: true
            }
        },
        messages: {
            "Users[email]": {
                required: 'Enter Email Id',
                regex: 'Enter valid Email Id'
            },

            "Users[password]": {
                required: 'Enter password',
            }
        }
    });
    $("#personalBioForm").validate({
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
            industry_id: {
                required: true
            },
           first_name: {
               required: true,
                regex: /^[a-zA-Z ]{3,50}$/,
                minlength: 2,
                maxlength: 20
            },
            email: {
                required: true
            },
           
            bday: {
                required: true
            },
            
            gender: {
                required: true
            },
            about_me: {
                required: true,
                maxlength: 500
            }


        },
        messages: {
            industry_id: {
                required: 'Select Industry'
            },
            first_name: {
                required: 'Enter name',
                regex: 'Enter valid name',
            },
            email: {
                required: 'Enter Email'
            },
            
            
            bday: {
                required: 'Select Date'
            },
            
            gender: {
                required: 'select your gender'
            },
            about_me: {
                required: 'please fill maximum 500 character'
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
    $("#addnews").validate({
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

//            weightage: {
//                required: true
//            },
           "title[en_US]": {
                required: true
            },
           "description[en_US]": {
                required: true
            },
           category_id: {
                required: true
            },
           city_id: {
                required: true
            },
           images: {
                required: true
            },
           
//           source_from: {
//                required: true
//            },
           source_url: {
                regex: /^$|^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
            },
           
           tag_id: {
                required: true
            }
           

        },
        messages: {

//            weightage: {
//                required: 'Enter Weightage.'
//            },
            "title[en_US]": {
                required: 'Enter Add Title.'
            },
            "description[en_US]": {
                required: 'Enter Add Description.'
            },
            category_id: {
                required: 'Select Category.'
            },
            city_id: {
                required: 'Select Location'
            },
            images: {
                required: 'Upload Image'
            },
            
//            source_from: {
//                required: 'Enter Source From.'
//            },
            source_url: {
               regex: 'Enter a valid URL link (eg. https://abc.com).'
            },
            tag_id: {
                required: 'Enter Add Title.'
            }
        }
    });
    $("#editnews").validate({
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

//            weightage: {
//                required: true
//            },
           "title[en_US]": {
                required: true
            },
           "description[en_US]": {
                required: true
            },
           category_id: {
                required: true
            },
           city_id: {
                required: true
            },
//           images: {
//                required: true
//            },
           
//           source_from: {
//                required: true
//            },
           source_url: {
                regex: /^$|^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/|www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/
            },
           
           tag_id: {
                required: true
            }
           

        },
        messages: {

//            weightage: {
//                required: 'Enter Weightage.'
//            },
            "title[en_US]": {
                required: 'Enter Add Title.'
            },
            "description[en_US]": {
                required: 'Enter Add Description.'
            },
            category_id: {
                required: 'Select Category.'
            },
            city_id: {
                required: 'Select Location'
            },
//            images: {
//                required: 'Upload Image'
//            },
            
//            source_from: {
//                required: 'Enter Source From.'
//            },
            source_url: {
               regex: 'Enter a valid URL link (eg. https://abc.com).'
            },
            tag_id: {
                required: 'Enter Add Title.'
            }
        }
    });
    $("#subscribe").validate({
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
                regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/,
                maxlength: 40
            }
        },
        messages: {


            email: {
                required: 'Enter email id',
                regex: 'Enter valid Email Id'
                
            }
        }
    });
    $("#personalize1").validate({
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


           "categoryids[]": {
                required: true
            }
        },
        messages: {


            "categoryids[]": {
                required: 'Select Category'
                
            }
        }
    });
    $("#personalize").validate({
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


           "categoryids[]": {
                required: true
            }
        },
        messages: {


            "categoryids[]": {
                required: 'Select Category'
                
            }
        }
    });
    $("#forgotemail").validate({
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
            }
        },
        messages: {


            email: {
                required: 'Enter Email Id',
                regex: 'Enter valid Email Id'
                
            }
        }
    });
    $("#errorforgotemail").validate({
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
            }
        },
        messages: {


            email: {
                required: 'Enter Email Id',
                regex: 'Enter valid Email Id'
                
            }
        }
    });
    
    
     $("#forgotpassword").validate({
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
                required: true,
                regex: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/
            },
            
            confirmpassword: {
                required: true,
                equalTo: "#npassword"
            }
        },
        messages: {


            password: {
                required: 'Enter Password',
                regex: 'Enter password 6-16 alphanumeric & one special character.'
            },
            
            confirmpassword: {
                required: 'Enter Password',
                equalTo: "password and confirm password do not match."
            }
        }
    });
    
   $("#contactus").validate({
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
            reg_name: {
                required: true,
                regex: /^[a-zA-Z ]{3,50}$/,
                minlength: 2,
                maxlength: 50
            },

             reg_email: {
                required: true,
                regex : /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$|^[0-9]{5,15}$/

            },
            phoneno: {
                required: true,
                regex: /^[0-9]{5,15}$/
            },
            subject: {
                required: true
            },
            message: {
                required: true
            }
        },
        messages: {
            reg_name: {
                required: 'Enter name',
                regex: 'Enter valid name',
            },
            reg_email: {
                required: 'Enter Email Id',
                 regex : 'Enter valid Email Id (eg. abc@xyz.com).'
            },
            phoneno: {
                required: 'Enter mobile number',
                regex: 'Enter valid mobile number'
            },
            subject: {
                required: 'Enter subject'
            },
            message: {
                required: 'Enter message'
            }
        }
    });

});





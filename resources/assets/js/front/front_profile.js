/* FORM VALIDATION RULE -- FORM */
var UpdateFormRulesFront = {
    username: {
        required: true,
        maxlength: 30,
    },
    email: {
        required: true,
        email: true,
    },
    password: {
        pswchecker: true,
    },
    password_confirmation: {
        equalTo: "#password",
    },
    // TODO Make a custom validation for birthdate using DateISO function
    gender: {
        required: true,     // TODO Make a custom validation rule for gender
    },
    // TODO Make a validation of Languaje
    firstname: {
        required: true,
        maxlength: 20
    },
    lastname: {
        required: true,
        maxlength: 60
    },
    address: {
        required: true,
        minlength: 10,
        maxlength: 60,
    },
    // TODO Make a validation of City
    // TODO Make a validation of Country
    zipcode: {
        required: true,
        number: true,
        minlength: 3,
        maxlength: 10,
    },
    bio: {
        maxlength: 116,
    }
};

$(document).ready(function () {

    // Getting the current time for datetimepicker inputs
    var dtpicker = $('.datepicker');
    /* TODO Get the current time, validate not input a pass date */
    // let now = new Date();
    // dtpicker.val(now.getDay().to + '/' + now.getMonth() + '/' + now.getFullYear());

    /* ADDING CUSTOM VALIDATION RULE */
    // strong pasword rule
    // $.validator.addMethod("pswchecker", function (value, element) {
    //     if (value === "") {
    //         return true;
    //     }
    //     else if (value.length < 8) {
    //         return false;
    //     }
    //     else if (!value.match(/[A-z]/)) {
    //         return false;
    //     }
    //     /* I don't know if necesary */
    //     // else if(!value.match(/[A-Z]/)){
    //     //     return false;
    //     // }
    //     else if (!value.match(/\d/)) {
    //         return false;
    //     }
    //     else return true;
    // }, "Password must be strong and its minimun length must be 8");
    //
    // /* INITIALIZATION OF VALIDATION PLUGINS */
    // setFormValidation($('#div_formContainer').find('#ftm_profileUpdate'), UpdateFormRulesFront);

    /* ATACHING EVENTS */
    $("form#ftm_profileUpdate input#avatar").change(function () {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('img#profile-pic-card').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(this.files[0]);
    });

});



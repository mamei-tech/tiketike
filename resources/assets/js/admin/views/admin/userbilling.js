
/* FORM VALIDATION RULE -- FORM */
let UpdateFormRules = {
    accnumber: {
        required: true,
        digits: true,
        minlength:14,
        maxlength: 16,
    },
    cvv: {
        digits: true,
        minlength:3,
        maxlength: 4,
    },
    expdate_month:{
        required: true,
        range: [1, 12],
        minlength:2,
        maxlength: 2,
    },
    expdate_year:{
        required: true,
        minlength:4,
        maxlength: 4,
        goodyear: true,
    }
};

$(document).ready(function () {

    let iy = parseInt("2013");
    let py = new Date(Date.now()).getFullYear() - 1;

    console.log(iy);
    console.log(py);


    if (iy > py)
        console.log("big");
    else
        console.log("small");



    /* ADDING CUSTOM VALIDATION RULE */
    // strong pasword rule
    $.validator.addMethod("goodyear", function (value, element) {

        if (value === "") {
            return false;
        }
        else if (parseInt(value) <= new Date(Date.now()).getFullYear() - 1) {
            return false;
        }
        else if (!value.match(/(20[1-3][0-9])/)) {
            return false;
        }
        else return true;
    }, "You most enter a valid year using YYYY format.");

    /* INITIALIZATION OF VALIDATION PLUGINS */
    setFormValidation($('#div_formContainer').find('form#ftm_userBillingInfo'), UpdateFormRules);

});



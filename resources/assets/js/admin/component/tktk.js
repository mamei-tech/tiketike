window.isGood2ApendID = function (url) {

    if (url.length <= 0)
        return false;
    let slashPos = url.lastIndexOf('/');

    if (slashPos > 5) {
        let part = url.slice(slashPos + 1);
        if ($.isNumeric(part))
            return false;
    }
    return true;
};

/* FORM HOUSE KEEPING  */
window.hosekeeping = function hosekeeping(frm, dfltholder = null) {

    $.each(frm.find('input'), function (i, item) {

        // Not touching the token input
        if (item.name !== "_token" && item.type === "text") {
            // Cleaning input type text
            item.value = "";
        }

        if (item.name !== "_token" && item.type === "password") {
            // Cleaning input type password
            item.value = "";
        }

        if (item.name !== "_token" && item.type === "file") {
            // Cleaning input type file
            item.value = "";
        }

    });

    if (dfltholder) {
        $.each(frm.find('img'), function (i, item) {
            item.src = dfltholder;
        });
    }

};


/* FORM VALIDATIONS */
window.setFormValidation = function setFormValidation(frm, pRules, modalid = null) {
    $(frm).validate({
        rules: pRules,
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
            $(element).closest('.form-check').removeClass('has-success').addClass('has-danger');

            // If modalide has been send, shakeit
            if (modalid)
                shakeModal(modalid);
        },
        success: function (element) {
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).closest('.form-check').removeClass('has-danger').addClass('has-success');
        },
        /*errorPlacement: function(error, element) {
            $(element).append(error);
        }*/
    });
};


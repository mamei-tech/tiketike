
/* FORM VALIDATION RULE -- FORM */
let confrafflesrules = {
    transactionfee: {
        required: true,
        number: true,
        max: 50,
    },
    minextractbalance: {
        required: true,
        number: true,
        max: 70,
    }

};

$(document).ready(function () {

    /* INITIALIZATION OF VALIDATION PLUGINS */
    setFormValidation($('div.card-body').find('form#frm_configraffle'), confrafflesrules);
});

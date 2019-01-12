/* Getting vars */
var err_admsec = $('div#err_admsec');
var msg_admsec = $('div#msg_admsec');
var err_ajax = $('div#err_modalajax');

function btn_closeerrbox() {
    err_admsec.fadeOut('fast', 'swing');
    msg_admsec.fadeOut('fast', 'swing');
    err_ajax.fadeOut('fast', 'swing');

    let ajaxmsgcontainer = $('span ul li#ajaxresponsemsg');
    if (ajaxmsgcontainer.length) {
        ajaxmsgcontainer.html("");
    }
}

window.shakeModal = function shakeModal(modalid) {
    let div2shake = $(modalid).find('div.modal-dialog.animated');

    div2shake.addClass('shake');
    setTimeout(function () {
        div2shake.removeClass('shake');
    }, 1000);
};


window.showajaxerror = function showajaxerror(modalid, message=null) {

    if(message != null && message !== "") {
        $('span ul li#ajaxresponsemsg').html(message);
        err_ajax.fadeIn('slow', 'swing');
    }
    else{
        $('span ul li#ajaxresponsemsg').html("ERROR Something went wrong");
        err_ajax.fadeIn('slow', 'swing');
    }

    // if modalid has been send shakeit
    if(modalid)
        shakeModal(modalid);
};

/* Message Box notification element in admin section */
$(document).ready(function () {

    /* FadeIn errors box & message box if exist */
    // let err_admsec = $('div#err_admsec');
    // let msg_admsec = $('div#msg_admsec');

    if (err_admsec.length) {
        err_admsec.fadeIn('slow', 'swing');
    }
    if (msg_admsec.length) {
        msg_admsec.fadeIn('slow', 'swing');
    }

    /* Adding listeners Error Dialog */
    $('button.close.btn-close').click(function () {
        btn_closeerrbox();
    });

});


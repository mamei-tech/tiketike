/* Languaje switcher action */
function changeLang(langcode) {
    $('li#liLangSW form select').val(langcode);
    $('li#liLangSW form').submit();
}

/* Navbar Scripts */
$(document).ready(function () {

    // Change To Spanish Click Event
    let spaButtom = $('li.nav-item.dropdown div#langOptns #langOpt_spa');
    if (!spaButtom.hasClass('disabled')) {
        spaButtom.click(function (e) {
            e.preventDefault();
            changeLang('es');
        });
    }

    // Change To English Click Event
    let engButtom = $('li.nav-item.dropdown div#langOptns #langOpt_eng');
    if (!engButtom.hasClass('disabled')) {
        engButtom.click(function (e) {
            e.preventDefault();
            changeLang('en');
        });
    }

    // Logout function
    $('li.nav-item div.dropdown-menu a#navBar_logoutlink').click(function (e) {
        // alert('You clicked on Like button');
        e.preventDefault();
        $('li.nav-item form#navlogout-form').submit()
    });

});


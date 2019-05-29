$('#view-password').on('change',function (e) {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
});


/* On ready */
$(function () {
    $('.slick-vertical').slick({
        infinite: true,
        slidesToShow: 3,
        arrows:false,
        verticalSwiping: true,
        swipeToSlide: true,
        slidesToScroll: 1,
        vertical: true,
        autoplay:true,
        autoplaySpeed: 6000,
        pauseOnHover: true,
        initialSlide: 9,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    initialSlide: 9,
                    infinite: true,
                    arrows:false,
                    vertical: false,
                    autoplay:true,
                    autoplaySpeed: 6000,
                    pauseOnHover: true,

                }

            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });





    // Check screen size for fixing the navbar
    if(window.screen.width * window.devicePixelRatio <= 1199) {
        let $div = $('div#navdiv-rightcolum');

        if ($div.hasClass('col-md-5')) {
            $div.removeClass();
        }
    }


    // Check the event of resizing screen for fixing the navbar
    $(window).resize(function() {

        if(window.screen.width * window.devicePixelRatio <= 1199) {
            let $div = $('div#navdiv-rightcolum');

            if ($div.hasClass('col-md-5')) {
                $div.removeClass();
            }
        }

        if(window.screen.width * window.devicePixelRatio > 1199) {
            let $div = $('div#navdiv-rightcolum');

            $div.removeClass();
            $div.addClass('col-md-5');
        }
    });

});

var password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

function validatePassword() {
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Password Don't Match");

    }else {
        confirm_password.setCustomValidity('');
    }

}

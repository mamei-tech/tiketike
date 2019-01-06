
/* On ready */
$(function () {


    $('.slick-vertical').slick({
        infinite: true,
        slidesToShow: 3,
        arrows:false,
        slidesToScroll: 1,
        vertical: true,
        autoplay:true,
        autoplaySpeed: 2000,
        pauseOnHover: true,
        initialSlide: 0,

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

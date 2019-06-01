$(document).ready(function () {
    Agencia.init();


    $("#owl-demo").owlCarousel({

        autoPlay: 3000, //Set AutoPlay to 3 seconds
        pagination: true,
        items: 4,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]

    });
    revapi = jQuery('.tp-banner').show().revolution({
        delay: 6000,
        startwidth: 1170,
        startheight: 200,
        hideThumbs: true,
        fullWidth: "on",
        fullScreen: "on",
        touchenabled: "on",                      // Enable Swipe Function : on/off
        onHoverStop: "on",                       // Stop Banner Timet at Hover on Slide on/off
        fullScreenOffsetContainer: ""
    });

});

$('.slicklanding').slick({
    autoplay: true,
    dots: true,
    slidesPerRow: 4,
    slidesToShow: 1,
    arrows: false,
    rows: 2,
    responsive: [
        {
            breakpoint: 769,
            settings: {
                slidesPerRow: 2
            }

        },
        {
            breakpoint: 601,
            settings: {
                slidesPerRow: 2
            }

        },
        {
            breakpoint: 550,
            settings: {
                slidesPerRow: 2,
                rows: 4,
            }

        },
        {
            breakpoint: 480,
            settings: {
                slidesPerRow: 2,
                rows: 4,
            }

        },

        {
            breakpoint: 400,
            settings: {
                slidesPerRow: 2,
                rows: 4,
            }

        }
    ]
});


smoothScroll.init({
    speed: 1000, // Integer. How fast to complete the scroll in milliseconds
    offset: 0, // Integer. How far to offset the scrolling anchor location in pixels

});


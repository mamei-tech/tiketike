@include('partials.front_modals.terminos_y_condiciones_modal')

<footer>
    <div class="piedepagina">

        {{--        <li class="margin-left-20 pull-right padding-top-20 ">--}}
        {{--            <a data-toggle="modal" href="#terminosModal" title="Términos y Condiciones"--}}
        {{--               class="colorB texto16 sinkinSans500M padding-top-40">Términos y Condiciones</a>--}}
        {{--        </li>--}}


        <div class="col-lg-11 pull-right">
            <div class="col-md-4 col-lg-4 col-xs-12 footer-tittle" style="padding: 40px">
                <h1 class="footer-tittle" style="padding-bottom: 20px">ABOUT US</h1>
                <p>Lorem ipsum es el texto que se usa habitualmente en diseño gráfico en demostraciones de tipografías o
                    de borradores de diseño para probar el diseño visual antes de insertar el texto final.</p>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-12 footer-tittle" style="padding: 40px">
                <h1 class="footer-tittle" style="padding-bottom: 20px">QUICK LINKS</h1>
                <ul class="fa-ul" >
                    <li class="footer-links" style="border-bottom:solid #c9c9c9 1px;"><span class="fa-li"><i class="ti-angle-right colorY texto-negrita padding-top5"></i></span><a class="colorB"
                                href="#"><h4>ALERTS AND STUFF</h4></a></li>

                    <li class="footer-links"style="border-bottom:solid #c9c9c9 1px;"><span class="fa-li"><i class="ti-angle-right colorY texto-negrita padding-top5"></i></span><a class="colorB"
                                href="#"><h4>CUSTOM SHORTCODES</h4></a></li>
                    <li class="footer-links"style="border-bottom:solid #c9c9c9 1px;"><span class="fa-li"><i class="ti-angle-right colorY texto-negrita padding-top5"></i></span><a class="colorB"
                                href="#"><h4>PRICING PLANS</h4></a></li>
                    <li class="footer-links"style="border-bottom:solid #c9c9c9 1px;"><span class="fa-li"><i class="ti-angle-right colorY texto-negrita padding-top5"></i></span><a class="colorB"
                                href="#"><h4>TOOGLE ELEMENTS</h4></a>
                    </li>
                    <li class="footer-links"><span class="fa-li"><i class="ti-angle-right colorY texto-negrita padding-top5"></i></span><a class="colorB"
                                href="#"><h4>TYPOGRAPHY</h4></a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-4 col-xs-12" style="padding: 40px">
                <h1 class="footer-tittle" style="padding-bottom: 20px">GET IN TOUCH</h1>
                <ul class="fa-ul" >


                    <li class="ico-footer-home" style="color: white"><h4>66 South Street Window 6 Wonderland</h4></li>
                    <li class="ico-footer-telephone" style="color: white"><h4>+440 5454 86 4---OFFICE <br> +1 305 548 54 85----HOME</h4></li>
                    <li class="ico-footer-email" style="color: white"><h4>tiketikes@gmail.com</h4></li>

                </ul>
            </div>
        </div>

    </div>


</footer>

<script src="{{ asset('js/front/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('js/front/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/front/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('js/front/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js') }}"></script>
<script src="{{ asset('js/front/plugins/bootbox/bootbox.min.js') }}"></script>
<script src="{{ asset('js/front/plugins/jquery.blockui.min.js') }}"></script>
<script src="{{ asset('js/front/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/front/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('js/front/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js') }}"
        type="text/javascript"></script>
<script src="{{ asset('js/front/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('js/front/plugins/fancybox/source/jquery.fancybox.js?v=2.1.3') }}"
        type="text/javascript"></script>

<script src="{{ asset('js/front/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/front/plugins/tooltipster.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/front/agencia.js') }}"></script>
<script src="{{ asset('js/front/back-to-top.js') }}"></script>
<script src="{{ asset('js/front/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('js/front/jquery.easypiechart.min.js') }}"></script>
<script src="{{ asset('js/front/chart.js') }}"></script>
<script src="{{ asset('js/front/slick.js') }}"></script>
<script src="{{ asset('js/front/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/front/uploader/modernizr.min.js') }}"></script>
<script src="{{ asset('js/front/uploader/uploadHBR.min.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.select2').select2();
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
        // revapi = jQuery('.tp-banner').show().revolution({
        //     delay: 1000,
        //     startwidth: 1170,
        //     startheight: 500,
        //     hideThumbs: false,
        //     fullWidth: "on",
        //     fullScreen: "off",
        //     touchenabled: "on",                      // Enable Swipe Function : on/off
        //     onHoverStop: "on",                       // Stop Banner Timet at Hover on Slide on/off
        //     fullScreenOffsetContainer: ""
        // });

    });

</script>
<script src="{{ asset('js/front/plugins/jquery.bootpag.js') }}"></script>
<script>

    smoothScroll.init({
        speed: 1000, // Integer. How fast to complete the scroll in milliseconds
        offset: 0, // Integer. How far to offset the scrolling anchor location in pixels

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
                breakpoint: 400,
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
                breakpoint: 550,
                settings: {
                    slidesPerRow: 2,
                    rows: 4,
                }

            }
            ,
            {
                breakpoint: 601,
                settings: {
                    slidesPerRow: 2,
                    rows: 2,
                }

            }
            ,
            {
                breakpoint: 769,
                settings: {
                    slidesPerRow: 2,
                    rows: 2,
                }

            },
            {
                breakpoint: 1280,
                settings: {
                    slidesPerRow: 3,
                    rows: 2,
                }

            }
        ]
    });

</script>

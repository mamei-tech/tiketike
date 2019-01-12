var Agencia = function () {

    // inicializar componentes JQ
    var _init_components = function () {

        if (jQuery.fancybox) {
            $('.fancybox').fancybox();
        } else {
            console.log('Debe incluir jquery.fancybox.js')
        }

        //if (jQuery.slimScroll) {
        _slimScroll('.scroller');
        //}else {
        //console.log('Debe incluir jquery.slimscroll.js')
        //}

        $('#myTab a').click(function (e) {
            e.preventDefault();
            //$(this).tab('show');
        });

        // para el scroll de las p'aginas
        $('#scrollContent').slimScroll({
            height: '550px',
            size: '0px',
            railVisible: false,
            railOpacity: 0.3,
            wheelStep: 10,
            allowPageScroll: true,
            disableFadeOut: false
        });
        // para el carrousel de 2 filas del home
        $("#owl-demo1").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination: true,
            items: 4,
            rows: 2,
            multipleRow: true,
           multipleRow: true,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [768, 1],
            itemsMobile: [479, 2]
        });
        // para el carrousel de usuarios
        $("#owl-demousuarios").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination: false,
            navigation: true,
            items: 5,
            itemsDesktop: [1199, 5],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [768, 1],
            itemsMobile: [479, 3]
        });
        // para el carrousel de 1 filas y 3 columnas de la vista responsive del listado de rifas
        $("#owl-demo2").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination: true,
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 3],
            itemsTablet: [768, 3],
            itemsMobile: [479, 3]
        });

        $('a[data-toggle=agencia]').click(function (e) {
            e.preventDefault();
            var nuevo = $(this).attr('href');
            nuevo = $('#destinos').find('div#' + nuevo);

            var activo = $('#destinos').find('div.active');
            activo.removeClass('active');
            activo.addClass('hidden');

            nuevo.addClass('active');
            nuevo.removeClass('hidden');
        });

        // para el login
        jQuery.cookie = function (key, value, options) {
            if (arguments.length > 1 && (value === null || typeof value !== "object")) {
                options = jQuery.extend({}, options);
                if (value === null) {
                    options.expires = -1;
                }
                if (typeof options.expires === 'number') {
                    var days = options.expires, t = options.expires = new Date();
                    t.setDate(t.getDate() + days);
                }
                return (document.cookie = [encodeURIComponent(key), '=', options.raw ? String(value) : encodeURIComponent(String(value)), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
            }
            options = value || {};
            var result, decode = options.raw ? function (s) {
                return s;
            } : decodeURIComponent;
            return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
        };
    };

    var _login = function (e) {

        var form_login = $('#form_login');

        e.preventDefault();
        $('#error').remove();

        _startLoading(form_login.parents('div.fancybox-skin'));

        $.ajax({
            'url': 'login',
            'data': form_login.serialize(),
            'dataType': 'json',
            'type': 'POST',
            'success': function (data) {
                if (data.ok == 't') {
                    var usuario = $('#login_correo').val();
                    usuario = usuario.replace("@", "___");
                    if (document.getElementById('remember_pass').checked) {
                        var clave = $('#login_password').val();
                        $.cookie(usuario, clave, {expires: 360});
                    }
                    else {
                        if ($.cookie(usuario)) {
                            $.cookie(usuario, null);
                        }
                    }
                    window.location = data.url;
                }
                else {
                    $('<div id="error" class="alert alert-danger">' + data.msg + '</div>').insertAfter('.form-signin-heading');
                }

                _stopLoading(form_login.parents('div.fancybox-skin'));
            }
        });

    };

    var _register = function (e) {
        e.preventDefault();
        $('#error').remove();

        var form = $("#form_registro");
        _startLoading(form.parents('div.fancybox-skin'));

        $.ajax({
            'url': 'registro',
            'data': form.serialize(),
            'dataType': 'json',
            'type': 'POST',
            'success': function (data) {
                if (data.ok == 't') {
                    window.location = data.href;
                } else {
                    $('<div id="error" class="alert alert-danger">' + data.msg + '</div>').insertAfter('.form-signin-heading');
                }

                _stopLoading(form.parents('div.fancybox-skin'));
            }
        });
    };

    /*
     * Muestra el div que indica que se está realizando una operación
     */
    var _startLoading = function (obj) {

        var html = '<div class="loading-message "><div class="block-spinner-bar">' +
            '<div class="bounce1"></div>' +
            '<div class="bounce2"></div>' +
            '<div class="bounce3"></div>' +
            '</div></div>';

        var conf = {
            message: html,
            css: {
                border: '0',
                padding: '0',
                backgroundColor: 'none'
            },
            overlayCSS: {
                backgroundColr: '#555',
                opacity: 0.6,
                cursor: 'wait'
            }
        };

        if (typeof obj == 'undefined') {
            $.blockUI(conf);
        } else {
            obj.block(conf);
        }

    };

    /*
     * Elimina el div que indica que se está realizando una operación
     */
    var _stopLoading = function (obj) {
        if (typeof obj == 'undefined') {
            $.unblockUI();
        } else {
            obj.unblock({});
        }
    };

    var _slimScroll = function (el) {
        $(el).each(function () {
            if ($(this).attr("data-initialized")) {
                return; // exit
            }

            var height;

            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }

            $(this).slimScroll({
                allowPageScroll: true, // allow page scroll when the element scroll is ended
                color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : '#000'),
                railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#ccc'),
                height: height,
                size: '5px',
                opacity: .6,
                alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),

                disableFadeOut: true
            });

            $(this).attr("data-initialized", "1");
        });
    };

    var _carousel2 = function (){
        $("#owl-demo2").owlCarousel({
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            pagination: true,
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsMobile: [479, 2]

        });
    };
    var _carousel = function (){
        $("#owl-demo").owlCarousel({
            pagination: false,
            navigation: true,
            autoPlay: 3000, //Set AutoPlay to 3 seconds
            items: 3,
            itemsDesktop: [1199, 2],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsMobile: [479, 2]

        });
    };
    var _selector = function (){
        asd("#open-categoria","#close-categoria",".selectCategoria");
        asd("#open-destino","#close-destino",".selectDestino");
        function asd(open_btn,close_btn,container){
            $(open_btn).click(function (e) {
                e.preventDefault()
                $(container).fadeIn("300");

            });
            $(close_btn).click(function (e) {
                e.preventDefault()
                $(container).fadeOut("300");
            });
            $(container).hover(
               null,
                function () {
                    $(this).fadeOut("300");
                }
            );

        }}

    var _datePicker = function(){
        $(".date-picker").datepicker("option","showOptions",{direction:"up"});
        //$(".fecha").datepicker();

        $(".change-visibility").click(function () {
            App.changeVisibility($(this));
        });
    };
    var _pageFixed = function(){
         function NavScrolling () {
             if (jQuery(window).scrollTop()>650){
                 jQuery(".header").addClass("fixNav");
             }
             else {
                 jQuery(".header").removeClass("fixNav");
             }
         }
         jQuery(window).scroll(function () {
             if (jQuery(window).scrollTop() >800) {
                 jQuery(".menu").addClass("buscador-fixed");
             }
             else {
                 jQuery(".menu").removeClass("buscador-fixed");
             }
         });

         NavScrolling();

         jQuery(window).scroll(function() {
             NavScrolling ();
         });

     };
    var _handleSearch = function() {
        $('.search-btn').click(function () {
            if($('.search-btn').hasClass('show-search-icon')){
                if ($(window).width()>767) {
                    $('.search-box').fadeOut(300);
                } else {
                    $('.search-box').fadeOut(0);
                }
                $('.search-btn').removeClass('show-search-icon');
            } else {
                if ($(window).width()>767) {
                    $('.search-box').fadeIn(300);
                } else {
                    $('.search-box').fadeIn(0);
                }
                $('.search-btn').addClass('show-search-icon');
            }
        });

        // close search box on body click
        if($('.search-btn').size() != 0) {
            $('.search-box, .search-btn').on('click', function(e){
                e.stopPropagation();
            });

            $('body').on('click', function() {
                if ($('.search-btn').hasClass('show-search-icon')) {
                    $('.search-btn').removeClass("show-search-icon");
                    $('.search-box').fadeOut(300);
                }
            });
        }
    }

    var _tab = function(){
        $('#myTab a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    }

    var  _pagination = function(){
        $('#paginador').bootpag({
                paginationClass: 'pagination',
                total: 5,
                page: 3
            }
        );
    }
    var _init_filtro_home = function () {
        $('#categoria,#modalidad').change(function (e) {
            e.preventDefault();
            //alert($(this).attr('id'));
            filtro_hotel($(this).attr('id'));
        });

        $('#flt_hotel').change(function (e) {
            window.location = $(this).val();
        });
    };
    var _handleMobiToggler = function () {
        $(".mobi-toggler").on("click", function(event) {
            event.preventDefault();//the default action of the event will not be triggered

            $(".header").toggleClass("menuOpened");
            $(".header").find(".header-navigation").toggle(300);
        });
    }
    var _search = function () {
        $('.search-btn').click(function () {
            if ($('.search-btn').hasClass('show-search-icon')) {
                if ($(window).width() > 767) {
                    $('.search-box').fadeOut(300);
                } else {
                    $('.search-box').fadeOut(0);
                }
                $('.search-btn').removeClass('show-search-icon');
            } else {
                if ($(window).width() > 767) {
                    $('.search-box').fadeIn(300);
                } else {
                    $('.search-box').fadeIn(0);
                }
                $('.search-btn').addClass('show-search-icon');
            }
        });
    }



    return {
        init: function () {
            _init_components();
            _handleMobiToggler();
            _carousel2();
            _carousel();
            _selector();
            _datePicker();
            _pageFixed();
            _tab();
            _pagination();
            _search();
            _slimScroll();
        },
        init_filtro_home: function () {
            _init_filtro_home();
        },
        login: function (e) {
            _login(e);
        },
        register: function (e) {
            _register(e);
        },


    }

}();

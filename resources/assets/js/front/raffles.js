import axios from 'axios';

require('./carousel');

/* On ready */
$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');
    var acountries = [];

    uploadHBR.init({
        "target": "#uploads",
        "max": 3,
        "textNew": "ADD",
        "textTitle": "Click here or drag to upload an imagem",
        "textTitleRemove": "Click here remove the imagem"
    });
    $('#reset').click(function () {
        uploadHBR.reset('#uploads');
    });

    $('#all').on('click', function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        $('#categoriesR').className += ' activo';
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': 'Todos',
                'countries': acountries
            }
        }).then(function (response) {
            e.target.parentElement.className = 'active';
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#Rall').on('click', function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        $('#categoriesR').className += ' activo';
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        axios.get(route('filter.front.raffles'), {
            params: {
            'category': 'Todos',
            'countries': acountries
            }
        }).then(function (response) {
            e.target.parentElement.className = 'active';
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('.filters').on('click', function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var category = $(e.target).html();
        var categories = document.getElementById('categoriesR');
        categories.classList.add('activo');
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'countries': acountries
            }
        }).then(function (response) {
            e.target.parentElement.className = 'active';
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#percent').on('click', function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'criteria': 'percent',
                'countries': acountries
            }
        }).then(function (response) {
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#price').on('click', function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#percentR').on('click', function (e) {
        e.preventDefault();
        var percent = document.getElementById('percentR');
        percent.className += ' activo';
        var price = document.getElementById('priceR');
        if (price.className.replace(/[\n\t]/g, "").indexOf(" activo") > -1)
            price.classList.remove("activo");
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        var category = $('div.listadoCategoriaR ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'criteria': 'percent',
                'countries': acountries
            }
        }).then(function (response) {
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#priceR').on('click', function (e) {
        e.preventDefault();
        var percent = document.getElementById('priceR');
        percent.className += ' activo';
        var price = document.getElementById('percentR');
        if (price.className.replace(/[\n\t]/g, "").indexOf(" activo") > -1)
            price.classList.remove("activo");
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var category = $('div.listadoCategoriaR ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = "Todos";
        // alert(category);
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('input#countries').on('change', function (e) {
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        var raffles_content = $('.rafflescontent');
        raffles_content.html('');
        array.forEach(function (element, index) {
            acountries[index] = element['dataset'].value;
        });
        var filters = document.getElementById('filtersR');
        filters.classList.add('activo');
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = "Todos";
        axios.get(route('filter.front.raffles'), {
            params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {
            var array_response = response.data.data;
            var append = '';
            array_response.forEach(function (element, index) {
                var medias = element.medias.split(';');
                var raffle = '<div class="row padding20 bg-rifas1 center-block ' + element.id + '">' +
                    '<div class="col-xs-4 col-md-6 raffle_carousel">' +
                    '<div class="hidden-lg visible-xs padding-top-10 padding-left-0">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="">' +
                    '</div>' +
                    '<div id="myCarousel' + element.id + '" class="carousel carouselRifas slide hidden-xs " data-ride="carousel">' +
                    '<div class="carousel-inner" role="listbox">' +
                    '<div class="item active">' +
                    '<img src="' + medias[0] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[1] + '" class="dimenImgCarouselR" alt="First slide"></div>' +
                    '<div class="item">' +
                    '<img src="' + medias[2] + '" class="dimenImgCarouselR" alt="First slide"></div></div>' +
                    '<ol class="carousel-indicators">' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="0" class="active"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="1"></li>' +
                    '<li data-target="#myCarousel' + element.id + '" data-slide-to="2"></li>' +
                    '</ol></div></div>' +
                    '<div class="col-xs-8 col-md-6 padding-top10R" style="padding-left: 5px">' +
                    '<span class="texto16 colorV hidden-lg visible-xs pull-left margin-right-10 sinkinSans600SB">' + element.progress + '%</span>' +
                    '<span class="texto14 colorN pull-left sinkinSans600SB texto14">' + element.owner_name + '</span>' +
                    '<span class="ti-location-pin texto16 colorN"></span><span class="texto14 sinkinSans600SB texto14 colorN">' +
                    '<img class="flag-country" src="' + element.location_flag + '"></span>' +
                    '<h4 class=" text-uppercase sinkinSans400R textoR">' +
                    '<a class="colorN" href="' + element.link_to_raffle + '">' + element.title + '</a></h4>' +
                    '<div class="hidden-lg texto8"><span class="sinkinSans300L ">Cost:</span><span class="sinkinSans600SB">' + element.price + '</span></div>' +
                    '<div class="costo hidden-xs"><div class="pull-left porcientoCompletado"><span class="texto35 sinkinSans600SB colorN">' + element.progress + '%</span><br>' +
                    '<span class="sinkinSans400R">Completed</span></div><div class="pull-left padding-top-20 padding-left30">' +
                    '<span class="sinkinSans300L texto10">Cost:</span><br><span class="colorN sinkinSans600SB">$' + element.price + '</span>' +
                    '</div></div>' +
                    '<ul class="list-unstyled list-inline padding-top-20 hidden-xs pull-right">' +
                    '<li class=" margin-right-10"><a href="' + element.follow_link + '">' +
                    '<span class="ti-face-smile texto-negrita colorV margin-right-5 texto16" title="Seguir"></span> <span class="colorV sinkinSans600SB">Seguir</span>' +
                    '</a></li><li class=" margin-right-10"><a data-toggle="modal" data-target="' + element.to_modal + '" href="" title="Compartir">' +
                    '<span class="ti-share texto-negrita colorV margin-right-5 texto16"></span><span class="colorV sinkinSans600SB" id="share_buttom">Compartir</span></a>' +
                    '</li>' +
                    '<li class=""><button type="button" class="btn btn-info btnSiguiente"><span class="ti-arrow-right"></span></button></li>' +
                    '</ul></div></div></div>';
                append += raffle;
            });
            raffles_content.html(append);
            $(".carousel").carousel({
                interval: 1500,
                pause: "hover"
            });
        }).catch(function (error) {
            console.log(error);
        });
    });

    jQuery('.tp-banner').show().revolution({
        delay: 1000,
        responsiveLevels:[4096,1024,778,480],
        gridwidth:[1140,800,750,540],
        gridheight:[600,600,980,231],
        hideThumbs: false,
        fullWidth: "on",
        fullScreen: "off",
        touchenabled: "on",                      // Enable Swipe Function : on/off
        onHoverStop: "on",                       // Stop Banner Timet at Hover on Slide on/off
        // fullScreenOffsetContainer: ""
    });
});

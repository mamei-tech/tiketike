import axios from 'axios';

/* On ready */
$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('#all').on('click',function (e) {
        e.preventDefault();
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        axios.post('api/filterByCategory',{
            'category' : 'Todos'
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
            $('div.listadoCategoriaN ul li a#all').parent().addClass('active');
            $('div.listadoCategoriaR ul li a#all').parent().addClass('active');
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('.filters').on('click',function (e) {
        e.preventDefault();
        var category = $(e.target).html();
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        axios.post('api/filterByCategory',{
            'category' : category
        }).then(function (response) {
            $('div.listadoCategoriaN ul li a#'+category).parent().addClass('active');
            $('div.listadoCategoriaR ul li a#'+category).parent().addClass('active');
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#percent').on('click',function (e) {
        e.preventDefault();
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        // alert(category);
        axios.post('api/filterByPercent',{
            'category': category,
            'criteria': 'percent'
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#price').on('click',function (e) {
        e.preventDefault();
        // $(e.target).addClass('active');
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        // alert(category);
        axios.post('api/filterByPercent',{
            'category': category,
            'criteria': 'price'
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
});

import axios from 'axios';

/* On ready */
$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');
    var acountries = [];

    $('#all').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        axios.post('api/filterByCategory',{
            'category' : 'Todos',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
            $('div.listadoCategoriaN ul li a#all').parent().addClass('active');
            $('div.listadoCategoriaR ul li a#Rall').parent().addClass('active');
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#Rall').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        axios.post('api/filterByCategory',{
            'category' : 'Todos',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
            $('div.listadoCategoriaN ul li a#all').parent().addClass('active');
            $('div.listadoCategoriaR ul li a#Rall').parent().addClass('active');
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('.filters').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $(e.target).html();
        $('div.listadoCategoriaN ul li[class="active"]').removeClass('active');
        $('div.listadoCategoriaR ul li[class="active"]').removeClass('active');
        axios.post('api/filterByCategory',{
            'category' : category,
            'countries': acountries
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
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        axios.post('api/filterByPercent',{
            'category': category,
            'criteria': 'percent',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#price').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $('div.listadoCategoriaN ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        axios.post('api/filterByPrice',{
            'category': category,
            'criteria': 'price',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#percentR').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $('div.listadoCategoriaR ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = 'Todos';
        axios.post('api/filterByPercent',{
            'category': category,
            'criteria': 'percent',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('#priceR').on('click',function (e) {
        e.preventDefault();
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $('div.listadoCategoriaR ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = "Todos";
        // alert(category);
        axios.post('api/filterByPrice',{
            'category': category,
            'criteria': 'price',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });

    $('input#countries').on('change',function (e) {
        acountries = [];
        var countries = $('input#countries:checked');
        var array = countries.toArray();
        array.forEach(function (element,index) {
            acountries[index] = element['value'];
        });
        var category = $('div.listadoCategoriaR ul li[class="active"] a').html();
        if (category === 'Todos' || category === 'All')
            category = "Todos";
        axios.post(route('filter.by.country'),{
            'category': category,
            'criteria': 'price',
            'countries': acountries
        }).then(function (response) {
            $('.rafflescontent').html("");
            $('.rafflescontent').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
});

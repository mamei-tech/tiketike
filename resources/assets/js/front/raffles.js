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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': 'Todos',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.post(route('filter.front.raffles'),{
            'category' : 'Todos',
            'countries': acountries
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'criteria': 'percent',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'criteria': 'percent',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
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
        axios.get(route('filter.front.raffles'),{ params: {
                'category': category,
                'criteria': 'price',
                'countries': acountries
            }
        }).then(function (response) {

            console.log(response.data);
        }).catch(function (error) {
            console.log(error);
        });
    });
});

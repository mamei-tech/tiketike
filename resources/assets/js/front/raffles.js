import axios from 'axios';

/* On ready */
$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('#all').on('click',function (e) {
        e.preventDefault();
        axios.post('api/filterByCategory',{
            'category' : 'Todos'
        }).then(function (response) {
            $('.paddingRifas').html("");
            $('.paddingRifas').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
    $('.filters').on('click',function (e) {
        e.preventDefault();
        var category = $(e.target).html();
        $(e.target).addClass('active');
        axios.post('api/filterByCategory',{
            'category' : category
        }).then(function (response) {
            $('.paddingRifas').html("");
            $('.paddingRifas').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
    $('#percent').on('click',function (e) {
        e.preventDefault();
        axios.post('api/filterByPercent').then(function (response) {
            $('.paddingRifas').html("");
            $('.paddingRifas').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
    $('#price').on('click',function (e) {
        e.preventDefault();
        axios.post('api/filterByPrice').then(function (response) {
            $('.paddingRifas').html("");
            $('.paddingRifas').html(response.data['raffles']);
        }).catch(function (error) {
            console.log(error);
        });
    });
});

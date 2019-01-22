import axios from 'axios';

$(document).ready(function () {
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('.slick-vertical').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var userid = $("[data-slick-index='" +nextSlide+ "'] .slick-list").attr('id');

        axios.post('api/getUser',{
            'userid': userid
        }).then(function (response) {
            $('#created_raffles').html('');
            $('#winned_raffles').html('');
            $('#sold_tickets').html('');
            $('#created_raffles').html(response.data['created_raffles']);
            $('#winned_raffles').html(response.data['winned_raffles']);
            $('#sold_tickets').html(response.data['sold_tickets']);
            $('#link_to_profile').href = '';
            $('#link_to_profile').href = '';
        }).catch(function (error) {
            console.log(error);
        })
    });
});

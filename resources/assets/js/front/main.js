import axios from 'axios';
$(document).ready(function () {

    $("#terminosModal").modal("show");


    $('.select2').select2();
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
            $('#name').html(response.data['name']);
            $('#country').html(response.data['country']);
            $('#created_raffles').html(response.data['created_raffles']);
            $('#winned_raffles').html(response.data['winned_raffles']);
            $('#sold_tickets').html(response.data['sold_tickets']);
            $('#link_to_profile').href = '';
            $('#link_to_profile').attr('href', route('profile.info',{userid}));
            $('.field-item .even')
        }).catch(function (error) {
            console.log(error);
        })
    });

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
});

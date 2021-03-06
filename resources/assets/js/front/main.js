import axios from 'axios';

$(document).ready(function () {

    if (window.location.href === route('main').url() + "#terminosModal") {
        $("#terminosModal").modal("show");
    }

    $('.select2').select2();
    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');
    var start = true;
    $('#normalSlick').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        if (start) {
            var userid = $("[data-slick-index='" + 1 + "'] .slick-list").attr('id');
            start = false;
        } else {
            if (nextSlide == 9)
                userid = $("[data-slick-index='" + 0 + "'] .slick-list").attr('id');
            else
                var userid = $("[data-slick-index='" + (nextSlide + 1) + "'] .slick-list").attr('id');
        }
        axios.post(route('get.user'), {
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
            $('#shared_raffles').html(response.data['shared_raffles']);
            $('#link_to_profile').href = '';
            $('#link_to_profile').attr('href', route('profile.info', {userid}));
            $('.field-item .even');
        }).catch(function (error) {
            console.log(error);
        })
    });

    $('#responsiveSlick').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        var userid = $("[data-slick-index='" + nextSlide + "'] .slick-list").attr('id');
        axios.post(route('get.user'), {
            'userid': userid
        }).then(function (response) {
            $('#created_raffles_xs').html('');
            $('#winned_raffles_xs').html('');
            $('#sold_tickets_xs').html('');
            $('#name_xs').html(response.data['name'] + '  /');
            $('#country_xs').html('  ' + response.data['country']);
            $('#created_raffles_xs').html(response.data['created_raffles']);
            $('#shared_raffles_xs').html(response.data['shared_raffles']);
            $('#winned_raffles_xs').html(response.data['winned_raffles']);
            $('#sold_tickets_xs').html(response.data['sold_tickets']);
            $('#link_to_profile_xs').href = '';
            $('#link_to_profile_xs').attr('href', route('profile.info', {userid}));
            $('.field-item .even');
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

    $('form[id="ftm_createRaffle"]').validate({
        rules: {
            title: {
                required: true,
                maxlength: 30,
            },
            description: {
                required: true,
                minlength: 15,
            },
            price: {
                required: true,
                min: 1
            },
            category: {
                required: true
            },
            localization: {
                required: true
            }
        },
        messages: {
            title: {
                required: 'This field is required',
                maxlength: 'The max length of this field is 30 characters'
            },
            description: {
                required: 'This field is required',
                minlength: 'The minimum length of this field is 15 characters'
            },
            price: {
                required: 'This field is required',
                min: 'The minimum value of price is 1'
            },
            localization: {
                required: 'This field is required',
            },
            category: {
                required: 'This field is required',
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

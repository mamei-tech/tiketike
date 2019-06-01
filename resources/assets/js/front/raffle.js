import axios from 'axios';
/* On ready */
$(document).ready(function () {
    $('#comenta').click(function (e) {
        e.preventDefault();
        $('#comentarios').fadeIn("slow");
        $('#scrollContent').css({
            'height' : '776px',
            'overflow-y' : 'scroll'
        });
    });


    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('input.tickets').on('change',function () {
        var amount = $('input.tickets:checked').length;
        $('#countTickets').html(amount);
    });

    $('form[id="ftm_editRaffle"]').validate({
        rules: {
            title: {
                required: true,
                maxlength: 30,
            },
            description: {
                required: true,
                minlength: 15,
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
                required : 'This field is required',
                maxlength: 'The max length of this field is 30 characters'
            },
            description: {
                required: 'This field is required',
                minlength: 'The minimum length of this field is 15 characters'
            },
            localization: {
                required: 'This field is required',
            },
            category: {
                required: 'This field is required',
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

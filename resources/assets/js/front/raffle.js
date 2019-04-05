import axios from 'axios';
/* On ready */
$(document).ready(function () {
    $('#comenta').click(function (e) {
        e.preventDefault();
        $('#comentarios').fadeIn("300");
        $('#scrollContent').css({
            'height' : '550px',
            'overflow-y' : 'scroll'
        });
        // $('#scrollContent').scrollTo('#commentContent');
    });


    var clipboard = new ClipboardJS('.btncopy');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });


    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    $('input.tickets').on('change',function () {
        var amount = $('#countTickets').html();
        var update = parseInt(amount) + 1;
        $('#countTickets').html(update);
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

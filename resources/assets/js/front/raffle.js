import axios from 'axios';
import ClipboardJS from 'clipboard';
/* On ready */

$(document).ready(function () {
    new ClipboardJS('.btncopy');
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
                maxlength: 120,
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
                maxlength: 'The max length of this field is 120 characters'
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

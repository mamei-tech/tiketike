import axios from 'axios';





function populate_cities_select()
{
    let city_id = $('select#contry-select').val();
    let user_id = $('input#user_id').val();

    let url = route('get.cities', [city_id, user_id]);

    axios.get(url, {}).then(function (response) {

        let $select = $('select#cities-select');

        $select.empty();
        $select.append('<option class="bs-title-option" value="">City</option>');

        $.each( response.data.cities, function( key, value ) {
            let selected = response.data.selected === value.id ? 'selected' : '';
            $select.append('<option class="bs-title-option" value="' + value.id + '"' + selected +'>' + value.name + '</option>');
        });

    }).catch(function (error) {
        console.log(error);
    })
}

$(document).ready(function () {


    var text = $('#foo').value();
    alert(text);


    
    // Getting the current time for datetimepicker inputs
    var dtpicker = $('.datepicker');
    /* TODO Get the current time, validate not input a pass date */
    // let now = new Date();
    // dtpicker.val(now.getDay().to + '/' + now.getMonth() + '/' + now.getFullYear());

    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    /* ADDING CUSTOM VALIDATION RULE */
    // strong pasword rule
    $.validator.addMethod("pswchecker", function (value, element) {
        if (value === "") {
            return true;
        }
        else if (value.length < 8) {
            return false;
        }
        else if (!value.match(/[A-z]/)) {
            return false;
        }
        /* I don't know if necesary */
        // else if(!value.match(/[A-Z]/)){
        //     return false;
        // }
        else if (!value.match(/\d/)) {
            return false;
        }
        else return true;
    }, "Password must be strong and its minimun length must be 8");

    /* INITIALIZATION OF VALIDATION PLUGINS */
    // setFormValidation($('#ftm_profileUpdate'), UpdateFormRulesFront);
    $('form[id="ftm_profileUpdate"]').validate({
        rules: {
            username: {
                required: true,
                maxlength: 30,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                pswchecker: true,
            },
            password_confirmation: {
                equalTo: "#password",
            },
            // TODO Make a custom validation for birthdate using DateISO function
            gender: {
                required: true,     // TODO Make a custom validation rule for gender
            },
            // TODO Make a validation of Languaje
            firstname: {
                required: true,
                maxlength: 20
            },
            lastname: {
                required: true,
                maxlength: 60
            },
            address: {
                required: true,
                minlength: 10,
                maxlength: 60,
            },
            // TODO Make a validation of City
            // TODO Make a validation of Country
            zipcode: {
                required: true,
                number: true,
                minlength: 3,
                maxlength: 10,
            },
            bio: {
                maxlength: 116,
            }
        },
        messages: {
            username: 'This field is required',
            lastname: 'This field is required',
            email: 'Enter a valid email',
            password: {
                minlength: 'Password must be at least 8 characters long'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    populate_cities_select();

    /* ATACHING EVENTS */
    $("form#ftm_profileUpdate input#avatar").change(function () {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('img#profile-pic-card').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(this.files[0]);
    });

    $('select#contry-select').change(function (e) {
        e.preventDefault();

        let city_id = $(e.target).val();
        let user_id = $('input#user_id').val();

        let url = route('get.cities', [city_id, user_id]);

        axios.get(url, {}).then(function (response) {

            let $select = $('select#cities-select');

            $select.empty();
            $select.append('<option class="bs-title-option" value="">City</option>');

            $.each( response.data.cities, function( key, value ) {
                let selected = response.data.selected === value.id ? 'selected' : '';
                $select.append('<option class="bs-title-option" value="' + value.id + '"' + selected +'>' + value.name + '</option>');
            });

        }).catch(function (error) {
            console.log(error);
        })
    })
});




/*FORM VALIDATION RULES*/

import {AxiosInstance as axios} from "axios";

let PublishFormRules = {
    profit: {
        number: true,
        required: true,
    },
    commissions: {
        number: true,
        required: true
    },
    tcount: {
        number: true,
        validTicketCount: true
    },
    tprice: {
        number: true,
        validTicketPrice: true
    }
};

/* FORM POPLULATION -- MODALS */
function popultDeleteForm(id, title, price) {

    let deleteForm = $('div#frm_deleteRaffle form');

    deleteForm.find('input#tb_id').val(id);
    deleteForm.find('input#tb_title').val(title);
    deleteForm.find('input#tb_price').val(price);
}

function populatePublishForm(id, price) {

    let publishForm = $('div#frm_publishRaffle form');

    publishForm.find('input#tb_id').val(id);
    publishForm.find('input#tb_price').val(price);
}

/* DEFINITION -- MODALS */
function openDeleteModal() {
    setTimeout(function () {
        $('#mdal_deleteRaffle').modal('show');
    }, 30);
}

function openPublishModal() {
    setTimeout(function () {
        $('#mdal_publishRaffle').modal('show');
    }, 30);
}

$(document).ready(function () {

    // gettings the forms
    let deleteForm = $('div#frm_deleteRaffle form');
    let publishForm = $('div#frm_publishRaffle form');
    let editForm = $('div#frm_editRaffle form');

    //These are the actions of both forms when are loaded
    let originalDeleteFormAction = deleteForm.attr('action');
    let originalPubFormAction = publishForm.attr('action');
    let originalEditFormAction = editForm.attr('action');

    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_uraffles').DataTable({
        "pagingType": "simple_numbers",
        "bPaginate": false,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 3 },
        ],
        order: [1, 'asc'],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });

    let table = $('#tbl_uraffles').DataTable();

    /* INTERACTION -- CRUD BUTTONS */

    // Delete a record
    table.on('click', '.remove', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        // Call to populate the delete form
        popultDeleteForm(row[0], row[1], row[2]);
        // Opnening the modal
        openDeleteModal();

        e.preventDefault();
    });

    // Delete a record
    table.on('click', '.btn-info', function (e) {
        e.preventDefault();
        let tr = $(this).closest('tr');
        let row = table.row(tr).data();
        axios.post(route('v1.uraffle.fetch'), {
            id: row[0]                                 // Can be 'tcount' or 'tprice'
        }).then(function (response) {
            inputs['id'].val(response.data['id']);
            inputs['title'].val(response.data['title']);
            var description = document.createTextNode(response.data['description']);
            document.getElementById('tb_editdescription').appendChild(description);
            inputs['eprice'].val(response.data['price']);
            var owner = response.data['owner'];
            $('#tb_eowner').val(owner).trigger('change');
            $('#tb_ecategory').val(response.data['category']).trigger('change');
            $('#tb_elocation').val(response.data['location']).trigger('change');
            editForm.attr('action', originalEditFormAction + '/' + response.data['id']);
            setTimeout(function () {
                $('#mdal_editRaffle').modal('show');
            }, 30);
        }).catch(function (error) {
            // console.log(error);
            showajaxerror('#mdal_editRaffle',  error.response.data.error['message']);
        });
    });

    /* BUTTONS INTERACTION -- MODAL FORMS */
    publishForm.find('button#publishBtn').click(function () {
        if (publishForm.valid())
            publishForm.attr('action', originalPubFormAction + '/' + inputs['id'].val());
        else
            showajaxerror('#mdal_publishRaffle');
    });

    deleteForm.find('button#deleteBtn').click(function () {
        deleteForm.attr('action', originalDeleteFormAction + '/' + deleteForm.find('input#tb_id').val());
    });

    // Making an array of all inputs
    let inputs = {
        'id': publishForm.find('input#tb_id'),
        'price': publishForm.find('input#tb_price'),
        'profit': publishForm.find('input#tb_profit'),
        'commissions': publishForm.find('input#tb_commissions'),
        'tCount': publishForm.find('input#tb_tcount'),
        'tPrice': publishForm.find('input#tb_tprice'),
        'criteria': publishForm.find('input#tb_criteria'),
        'title': editForm.find('input#tb_title'),
        'description': editForm.find('input#tb_editdescription'),
        'eprice': editForm.find('input#tb_price'),
        'owner': editForm.find('input#tb_owner'),
        'category': editForm.find('input#tb_category'),
        'location': editForm.find('input#tb_location'),
    };

    //Publish a raffle
    $('a#rpublish').click(function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        hosekeeping(publishForm);
        populatePublishForm(row[0], row[2]);
        openPublishModal();
        e.preventDefault();
    });

    let emptyRequiredFields = function () {
        return inputs['profit'].val() === '' || inputs['commissions'].val() === '';
    };

    //Clear tCount and tPrice inputs
    inputs['profit'].keydown(function () {
        inputs['tCount'].val('');
        inputs['tPrice'].val('');
    });

    //Clear tCount and tPrice inputs
    inputs['commissions'].keydown(function () {
        inputs['tCount'].val('');
        inputs['tPrice'].val('');
    });

    inputs['tCount'].keypress(function () {
        return !emptyRequiredFields();
    }).keyup(function () {
        if (parseFloat(this.value) > 0) {

            inputs['criteria'].val('tprice');

            axios.post(route('v1.uraffle.computetval'), {
                id: inputs['id'].val(),
                profit: parseFloat(inputs['profit'].val()),
                tcount: parseInt(this.value),
                commissions: parseInt(inputs['commissions'].val()),
                criteria: 'tprice'                                              // Can be 'tcount' or 'tprice'
            }).then(function (response) {
                //Set the ticket price input to the price computed by the server
                inputs['tPrice'].val(response.data['tprice']);
            }).catch(function (error) {
                // console.log(error);
                showajaxerror('#mdal_publishRaffle',  error.response.data.error['message']);
            });
        }
        else
            inputs['tPrice'].val('');
    });

    inputs['tPrice'].keypress(function () {
        return !emptyRequiredFields();
    }).keyup(function () {
        if (parseFloat(this.value) > 0){

            inputs['criteria'].val('tcount');

            axios.post(route('v1.uraffle.computetval'), {
                id: inputs['id'].val(),
                profit: parseFloat(inputs['profit'].val()),
                tprice: parseFloat(this.value),
                commissions: parseInt(inputs['commissions'].val()),
                criteria: 'tcount'                                              // Can be 'tcount' or 'tprice'
            }).then(function (response) {
                //Set the ticket count input to the count computed by the server
                inputs['tCount'].val(response.data['tcount']);
            }).catch(function (error) {
                // console.log(error);
                showajaxerror(error.response.data.error['message']);
            });
        }
        else
            inputs['tCount'].val('');
    });

    /* REGISTRATING CUSTOM VALIDATION METHODS -- VALIDATE */
    $.validator.addMethod('validTicketCount', function (value) {
        return !emptyRequiredFields() && parseInt(value) > 0;
    }, 'Fill the others fields and set a correct value in this field.');

    $.validator.addMethod('validTicketPrice', function (value) {
        return !emptyRequiredFields() && parseFloat(value) > 0;
    }, 'Fill the others fields and set a correct value in this field.');


    // INITIALIZING VAIDATION PLUGINS
    setFormValidation(publishForm, PublishFormRules, '#mdal_publishRaffle');

    $('#btn_addraffle').on('click',function () {
        setTimeout(function () {
            $('#mdal_addRaffle').modal('show');
        }, 30);
    });

    /* ATACHING EVENTS */
    $("input#f_image").change(function () {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('img#promo-img').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(this.files[0]);
    });
});

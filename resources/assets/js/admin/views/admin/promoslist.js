let CreateFormRules = {
    name: {
        required: true,
        maxlength: 30,
    },
    alternative: {
        required: true,
        maxlength: 200
    },
    website: {
        required: true,
        maxlength: 200,
        url: true
    },
    expdate: {
        // TODO add validation for before date here
        required: true,
        dateISO: true
    },
};


/* FORM POPLULATION -- MODALS */
function popultDeleteForm(name) {
    let deleteForm = $('div#mdal_deletePromo form');

    deleteForm.find('input#tb_name').val(name);
}

function popultDetailsForm(name, type, status, expdate, originalDetailsLinkAction) {
    let detailsForm = $('div#mdal_detailsPromo form');

    detailsForm.find('p#tb_name').html('<b>' + name + '<b>');

    (type === '1')
        ? detailsForm.find('p#tb_type').html('<b>Principal<b>')
        : detailsForm.find('p#tb_type').html('<b>Secundary<b>');

    (status === '1')
        ? detailsForm.find('p#tb_status').html('<b>Enable<b>')
        : detailsForm.find('p#tb_status').html('<b>Disable<b>');

    detailsForm.find('p#tb_expdate').html('<b>' + expdate + '<b>');

    // Getting & Populating the rest of the data
    getPromoData(name, detailsForm, originalDetailsLinkAction);
}

function popultEditForm(id, name, type, status, expdate) {
    let editForm = $('div#mdal_editPromo form');

    editForm.find('p#tb_id').html(id);
    editForm.find('input#tb_name').val(name);
    editForm.find('input#tb_expdate').val(expdate);

    // Setting up TYPE
    if (type !== 'Principal' && editForm.find('input#tb_type').prop('checked') === false)
        editForm.find('input#tb_type').click();
    if (type === 'Principal' && editForm.find('input#tb_type').prop('checked') === true)
        editForm.find('input#tb_type').click();

    // Setting up STATUS
    if ($(status).attr("id") === 'unable' && editForm.find('input#tb_status').prop('checked') === true)
        editForm.find('input#tb_status').click();
    if ($(status).attr("id") !== 'unable' && editForm.find('input#tb_status').prop('checked') === false)
        editForm.find('input#tb_status').click();

    // Getting & Populating the rest of the data
    getPromoDataEdit(name, editForm);
}

/* DEFINITION -- MODALS */
/* TODO Move this method to aux and making a generic method usin the modal id as a parameter. Do this for all scripts */
function openDeleteModal() {
    setTimeout(function () {
        $('#mdal_deletePromo').modal('show');
    }, 30);
}

function openCreateModal() {
    setTimeout(function () {
        $('#mdal_createPromo').modal('show');
        getClient();
    }, 30);
}

function openDetailModal() {
    setTimeout(function () {
        $('#mdal_detailsPromo').modal('show');
    }, 30);
}

function openEditModal() {
    setTimeout(function () {
        $('#mdal_editPromo').modal('show');
    }, 30);
}

/* POPULATING DATA */
function getClient() {

    let select = $('select#slt_client');

    // Cleaning the select first
    select.empty();

    // TODO use the package that allows use the routes name in javascript
    // axios.get('http://localhost/tiketike/public/api/adm7HidkOduO1/v1/cliproml'
    axios.get(route('v1.promo.clients'), {}).then(function (response) {

        $.each(response.data.clients, function (i, item) {

            select.append($('<option>', {
                value: item.id,
                text: item.name
            }));
        });

        // Refreshing the select
        select.selectpicker('refresh');

    }).catch(function (error) {
        showajaxerror('#mdal_createPromo', error.response.data.error['message']);
    });
}

function getPromoDataEdit(name, editForm) {
    // TODO use the package that allows use the routes name in javascript
    // axios.post('http://localhost/tiketike/public/api/adm7HidkOduO1/v1/casckit'
        axios.post(route('v1.promo.promodata'), {
        name: name,
    }).then(function (response) {

        // Populating the rest of the form
        editForm.find('input#slt_client').val(response.data['clientname']);
        editForm.find('input#tb_alt').val(response.data['alternative']);
        editForm.find('input#tb_website').val(response.data['website']);
        // Check if exist an image
        if(response.data['imageurl'])
            editForm.find('img#promo-img').attr('src', response.data['imageurl']);
    }).catch(function (error) {
        showajaxerror('#mdal_detailsPromo', error.response.data.error['message']);
    });
}

function getPromoData(name, detailsForm, originalDetailsLinkAction) {
    // TODO use the package that allows use the routes name in javascript
    axios.post(route('v1.promo.promodata'), {
        name: name,
    }).then(function (response) {

        // Populating the rest of the form
        detailsForm.find('a#tb_client').html('<b>' + response.data['clientname'] + '<b>');
        detailsForm.find('p#tb_alt').html(response.data['alternative']);
        detailsForm.find('a#tb_website').attr('href', response.data['website']);
        detailsForm.find('span#s_clientid').attr('value', response.data['clientid']);
        // Check if exist an image
        if(response.data['imageurl'])
            detailsForm.find('img#promo-img').attr('src', response.data['imageurl']);

        // Setting the client link up
        detailsForm.find('a#tb_client').attr('href', originalDetailsLinkAction + '/' + detailsForm.find('span#s_clientid').attr('value'));
    }).catch(function (error) {
        showajaxerror('#mdal_detailsPromo', error.response.data.error['message']);
    });
}


$(document).ready(function () {

    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    // gettings the forms
    let deleteForm = $('div#frm_deletePromo form');
    let detailsForm = $('div#frm_detailsPromo form');
    let createForm = $('div#frm_createPromo form');
    let editForm = $('div#frm_editPromo form');

    // saving the original placeholder image url
    let dfltholder = createForm.find('img#promo-img').attr('src');

    //These are the actions of both forms when are loaded
    let originalDeleteFormAction = deleteForm.attr('action');
    let originalEditFormAction = editForm.attr('action');
    let originalDetailsLinkAction = detailsForm.find('a#tb_client').attr('href');

    //Starting Datepicker
    let dtpicker = $('.datepicker');
    dtpicker.datetimepicker({
        format: 'YYYY-MM-DD',
        icons: {
            time: "now-ui-icons tech_watch-time",
            date: "now-ui-icons ui-1_calendar-60",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'now-ui-icons arrows-1_minimal-left',
            next: 'now-ui-icons arrows-1_minimal-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });

    // Starting Table
    $('#table_promo').DataTable({
        /* TODO User the norma or reduced buttoms here */
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            // {visible: false, targets: 0},
            {responsivePriority: 1, targets: 1},
            {responsivePriority: 2, targets: 3}
        ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });

    var table = $('#table_promo').DataTable();

    /* INTERACTION -- CRUD BUTTONS */

    //Add Role
    $('button#btn_addpromo').click(function (e) {
        hosekeeping(createForm, dfltholder);

        openCreateModal();

        e.preventDefault();
    });

    // Edit record
    table.on('click', '.edit', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        // Call to populate the delete form
        popultEditForm(row[0], row[1], row[2], row[3], row[4]);

        // Opnening the modal
        openEditModal();

        e.preventDefault();
    });

    // Delete a record
    table.on('click', '.remove', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        // Call to populate the delete form
        popultDeleteForm(row[1]);

        // Opnening the modal
        openDeleteModal();

        e.preventDefault();
    });

    //Detail record
    table.on('click', '.like', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        // Call to populate the delete form
        popultDetailsForm(row[1], row[2], row[3], row[4], originalDetailsLinkAction);

        // Opnening the modal
        openDetailModal();

        e.preventDefault();
    });

    /* BUTTONS INTERACTION -- MODAL FORMS */
    deleteForm.find('button#deleteBtn').click(function () {
        deleteForm.attr('action', originalDeleteFormAction + '/' + deleteForm.find('input#tb_name').val());
    });

    editForm.find('button#editBtn').click(function () {
        editForm.attr('action', originalEditFormAction + '/' + editForm.find('p#tb_id').html());
    });

    /* ATACHING EVENTS */
    $("input#f_image").change(function () {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('img#promo-img').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(this.files[0]);
    });

    /* AUTOMATION OPS --  */
    if ($('span#show_modal').html() === 'show') {
        openCreateModal();
    }

    /* CUSTOM VALIDATION METHODS */

    /* INITIALIZATION OF VALIDATION PLUGINS */
    setFormValidation($('div#frm_createPromo').find('form'), CreateFormRules, '#mdal_createPromo');
    setFormValidation($('div#frm_editPromo').find('form'), CreateFormRules, '#mdal_editPromo');   // The same rules

});



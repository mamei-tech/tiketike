let CreateFormRules = {
    name: {
        required: true,
        maxlength: 30,
    },
    email: {
        required: true,
        maxlength: 35,
        email: true,
    },
    contact: {
        required: true,
    }
};

/* FORM POPLULATION -- MODALS */
function popultDeleteForm(clientid, clientname) {
    let deleteForm = $('div#mdal_deletePromoClient form');

    deleteForm.find('input#tb_clientid').val(clientid);
    deleteForm.find('input#tb_clientname').val(clientname);
}

function popultEditForm(id, name, contact, email) {

    let editForm = $('div#mdal_editPromoClient form');

    editForm.find('input#tb_id').val(id);
    editForm.find('input#tb_name').val(name);
    editForm.find('input#tb_contact').val(contact);
    editForm.find('input#tb_email').val(email);
}

/* DEFINITION -- MODALS */
function openDeleteModal() {
    setTimeout(function () {
        $('#mdal_deletePromoClient').modal('show');
    }, 30);
}

function openCreateModal() {
    setTimeout(function () {
        $('#mdal_createPromoClient').modal('show');
    }, 30);
}

function openEditModal() {
    setTimeout(function () {
        $('#mdal_editPromoClient').modal('show');
    }, 30);
}

$(document).ready(function () {

    /*  SETTING UP AXIOS HEADERS  */

    // gettings the forms
    let deleteForm = $('div#frm_deletePromoclient form');
    let createForm = $('div#frm_createPromoClient form');
    let editForm = $('div#frm_editPromoClient form');

    //These are the actions of both forms when are loaded
    let originalDeleteFormAction = deleteForm.attr('action');
    let originalEditFormAction = editForm.attr('action');

    // Starting Table
    $('#table_promo').DataTable({
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

    //Create Promo Client
    $('button#btn_addpromoclient').click(function (e) {
        hosekeeping(createForm);

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
        popultDeleteForm(row[0], row[1]);

        // Opnening the modal
        openDeleteModal();

        e.preventDefault();
    });

    /* BUTTONS INTERACTION -- MODAL FORMS */
    deleteForm.find('button#deleteBtn').click(function () {
        deleteForm.attr('action', originalDeleteFormAction + '/' + deleteForm.find('input#tb_clientid').val());
    });

    editForm.find('button#editBtn').click(function () {
        editForm.attr('action', originalEditFormAction + '/' + editForm.find('input#tb_id').val());
    });

    /* ATACHING EVENTS */
    $("input#f_image").change(function () {

        let reader = new FileReader();

        reader.onload = function (e) {
            $('img#promo-img').attr('src', e.target.result).fadeIn('slow');
            console.log(e.target);
        };
        reader.readAsDataURL(this.files[0]);
    });

    /* AUTOMATION OPS --  */
    if ($('span#show_modal').html() === 'show') {
        openCreateModal();
    }

    /* CUSTOM VALIDATION METHODS */

    /* INITIALIZATION OF VALIDATION PLUGINS */
    setFormValidation($('div#frm_createPromoClient').find('form'), CreateFormRules, '#mdal_createPromoClient');
    setFormValidation($('div#frm_editPromoClient').find('form'), CreateFormRules, '#mdal_editPromoClient');   // The same rules

});



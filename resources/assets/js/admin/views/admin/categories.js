

/* FORM POPLULATION -- MODALS */
function popultDeleteForm(id, category, icon) {

    let deleteForm = $('div#frm_deleteCategories form');

    deleteForm.find('input#tb_id').val(id);
    deleteForm.find('input#tb_title').val(category);
    deleteForm.find('input#tb_price').val(icon);
}

function populateEditForm(id, category, icon) {

    let editForm = $('div#mdal_editCategory form');

    editForm.find('input#tb_id').val(id);
    editForm.find('input#tb_category').val(category);
    editForm.find('input#tb_icon').val(icon);
}

/* DEFINITION -- MODALS */
function openDeleteModal() {
    setTimeout(function () {
        $('#mdal_deleteCategories').modal('show');
    }, 30);
}

function openEditModal() {
    setTimeout(function () {
        $('#mdal_editCategory').modal('show');
    }, 30);
}

$(document).ready(function () {

    // gettings the forms
    let deleteForm = $('div#frm_deleteCategories form');
    let editForm = $('div#frm_editCategory form');

    //These are the actions of both forms when are loaded
    let originalDeleteFormAction = deleteForm.attr('action');
    let originalPubFormAction = editForm.attr('action');

    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_categories').DataTable({
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

    let table = $('#tbl_categories').DataTable();

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

    /* BUTTONS INTERACTION -- MODAL FORMS */
    editForm.find('button#updateCategory').click(function () {
        if (editForm.valid())
            editForm.attr('action', originalPubFormAction + '/' + 3);
        else
            showajaxerror('#mdal_publishRaffle');
    });

    deleteForm.find('button#deleteBtn').click(function () {
        deleteForm.attr('action', originalDeleteFormAction + '/' + deleteForm.find('input#tb_id').val());
    });

    // Making an array of all inputs

    //Publish a raffle
    $('a#rpublish').click(function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        hosekeeping(editForm);
        populateEditForm(row[0],row[1], row[2]);
        openEditModal();
        e.preventDefault();
    });

    $('#btn_addcategory').on('click',function () {
        // e.preventDefault();
        // alert('add category');
        // //TODO aqui va la parte del modal de crear una categoria
        setTimeout(function () {
            $('#mdal_addCategory').modal('show');
        }, 30);
    });
});

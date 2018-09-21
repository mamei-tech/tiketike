
/* FORM POPLULATION -- MODALS */
function popultDeleteForm(id, title, price) {

    let deleteForm = $('div#frm_deleteRaffle form');

    deleteForm.find('input#tb_id').val(id);
    deleteForm.find('input#tb_title').val(title);
    deleteForm.find('input#tb_price').val(price);
}

/* DEFINITION -- MODALS */
function openDeleteModal() {
    setTimeout(function () {
        $('#mdal_deleteRaffle').modal('show');
    }, 30);
}


$(document).ready(function () {

    // gettings the forms
    let deleteForm = $('div#frm_deleteRaffle form');

    //These are the actions of both forms when are loaded
    let originalDelFormAction = deleteForm.attr('action');

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_araffles').DataTable({
        "pagingType": "simple_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            // { responsivePriority: 1, targets: 0 },
            // { responsivePriority: 2, targets: 5 },
            // { responsivePriority: 3, targets: 2 },
            // { responsivePriority: 4, targets: 8 },
        ],
        order: [1, 'asc'],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    let table = $('#tbl_araffles').DataTable();

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


    deleteForm.find('button#deleteBtn').click(function () {
        deleteForm.attr('action', originalDelFormAction + '/' + deleteForm.find('input#tb_id').val());
    });
});

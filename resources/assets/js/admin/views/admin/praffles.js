
/* FORM POPLULATION -- MODALS */
function popultAnulleForm(id, title, profit, progress) {

    let deleteForm = $('div#frm_anulleRaffle form');

    deleteForm.find('input#tb_id').val(id);
    deleteForm.find('input#tb_title').val(title);
    deleteForm.find('input#tb_price').val(profit);
    deleteForm.find('input#tb_progress').val(progress);
}

/* DEFINITION -- MODALS */

function openDeleteModal(){
    setTimeout(function(){
        $('#mdal_anulleRaffle').modal('show');
    }, 30);

}

$(document).ready(function () {

    // Showing the hidden input only for publish raffles
    let anulleForm = $('div#frm_anulleRaffle form');

    let originalAnullFormAction = anulleForm.attr('action');

    anulleForm.find('div#alternateprogressrow').show();

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_praffles').DataTable({
        "pagingType": "simple_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 5 },
            { responsivePriority: 3, targets: 2 },
            { responsivePriority: 4, targets: 8 },
        ],
        order: [ 1, 'asc' ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });

    let table = $('#tbl_praffles').DataTable();

    /* INTERACTION -- CRUD BUTTONS */

    // Delete a record
    table.on('click', '.remove', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        // Call to populate the delete form
        let solds = parseInt(row[5]);
        let tcount = parseInt(row[6]);
        //3th arg is progress percent rounded to two decimals
        popultAnulleForm(row[0], row[1], row[2], (solds * tcount / 100).toFixed(2));

        // Opnening the modal
        openDeleteModal();

        e.preventDefault();
    });

    // click anulle btn
    anulleForm.find('button#anulleBtn').click(function () {
        anulleForm.attr('action', originalAnullFormAction + '/' + anulleForm.find('input#tb_id').val());
    });
});





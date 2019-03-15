
$(document).ready(function () {

    /* CONFIGURATION -- DATATABLE */
    $('#groups_table').DataTable({
        "pagingType": "simple_numbers",
        "bPaginate": true,
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
});

function openRaffleReferralsModal() {

    setTimeout(function () {
        $('#mdal_raffleReferrals').modal('show');
    }, 30);
}

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

    $("#tbl_referrals").DataTable({
        "pagingType": "simple_numbers",
        "bPaginate": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 2 },
        ],
        order: [1, 'asc'],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    let table = $('#groups_table').DataTable();

    table.on('click', '.btn-info', function (e) {

        e.preventDefault();

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();

        axios.get(route('v1.groups.rafflereferrals', row[0])).then(function (response) {

            let table = document.getElementById("tbl_referrals");
            $('#tbl_referrals tr:not(:first-child)').remove();

            let rows = response['data']['referrals'];

            for (let i = 0; i < rows.length; i++) {

                let row = table.insertRow(-1);

                let id = row.insertCell(0);
                let name = row.insertCell(1);
                let tickets = row.insertCell(2);

                id.innerHTML = rows[i]['id'];
                name.innerHTML = rows[i]['name'];
                tickets.innerHTML = rows[i]['shared_tickets'];
            }

            openRaffleReferralsModal();

        }).catch(function (error) {
            console.log(error);
        });
    });
});
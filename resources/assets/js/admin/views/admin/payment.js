$(document).ready(function () {

    // gettings the forms
    // let deleteForm = $('div#frm_deleteRaffle form');
    // let publishForm = $('div#frm_publishRaffle form');
    //
    // //These are the actions of both forms when are loaded
    // let originalDeleteFormAction = deleteForm.attr('action');
    // let originalPubFormAction = publishForm.attr('action');

    /*  SETTING UP AXIOS HEADERS  */
    axios.defaults.headers.common['Authorization'] = "Bearer " + $('meta[name=access-token]').attr('content');

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_ppending').DataTable({
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
    let table = $('#tbl_ppending').DataTable();

    /* INTERACTION -- CRUD BUTTONS */

    // Delete a record
    table.on('click', '.details', function (e) {

        let tr = $(this).closest('tr');
        let row = table.row(tr).data();
        var description = document.getElementById('details_description');
        var content = document.getElementById('details_content');
        var text = document.createElement('p');
        text.innerHTML = "<h4>Description</h4>"+row[2];
        description.appendChild(text);
        axios.post(route('payment.pending.details'), {
            payment: row[0]                                              // Can be 'tcount' or 'tprice'
        }).then(function (response) {
            //Set the ticket count input to the count computed by the server
            var text = document.createElement('p');
            var user = response.data.user.split(';');
            text.innerHTML = "<h4>Total price to pay: </h4>$ "+response.data.amount+"<br>";
            text.innerHTML += "<h4>To the user:</h4>";
            user.forEach(function (value, index, array) {
                text.innerHTML += value+"<br>";
            });
            content.appendChild(text);
        }).catch(function (error) {
            // console.log(error);
            showajaxerror(error.response.data.error['message']);
        });
        setTimeout(function () {
            $('#pp_details').modal('show');
        }, 30);

        e.preventDefault();
    });
});

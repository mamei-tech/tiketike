/* FORM POPLULATION -- MODALS */
function popultDeleteForm(userId, username, lastname, email) {

    let deleteForm = $('div#frm_deleteUser form');

    deleteForm.find('input#tb_id').val(userId);
    deleteForm.find('input#tb_name').val(username);
    deleteForm.find('input#tb_lastname').val(lastname);
    deleteForm.find('input#tb_email').val(email);

    // Updating the id parameter in action attrib
    // let currentFormAction = route();

    deleteForm.attr('action', route('users.destroy', userId));
}

function popultUpdateForm(userid, name, lastname, email, role) {
    // console.log('aqui estoy');

    // $('div#frm_deleteRole input#tb_id').val(roleid);
    // $('div#frm_deleteRole input#tb_name').val(roleName);
    // $('div#frm_deleteRole input#tb_description').val(roleDescription);

    let updateForm = $('div#frm_userupdate form');

    updateForm.find('input#tb_id').val(userid);
    updateForm.find('input#tb_name').val(name);
    updateForm.find('input#tb_lastname').val(lastname);
    updateForm.find('input#tb_email').val(email);
    if(role !== "") {
        var select = updateForm.find('select#tb_roles');
        var option = select.find('option#' + role);
        option.attr('selected', 'selected');
    }

    // Updating the id parameter in action attrib
    let currentFormAction = updateForm.attr('action');

    /* that way we don't need isGood2ApendID method */
    if (isGood2ApendID(currentFormAction))
        updateForm.attr('action', currentFormAction + '/' + userid);
}

//Delete
function showDeleteForm(){
    $('#mdal_deleteUser').find('#frm_deleteUser').fadeIn('fast', null, 30 );
    $('.error').removeClass('alert alert-danger').html('');
}

function openDeleteModal(){
    showDeleteForm();
    setTimeout(function(){
        $('#mdal_deleteUser').modal('show');
    }, 30);

}

//Update
function showUpdateForm(){
    $('#mdal_userupdate').find('#frm_userupdate').fadeIn('fast', null, 30 );
    $('.error').removeClass('alert alert-danger').html('');
}

function openUpdateModal(){
    showUpdateForm();
    setTimeout(function(){
        $('#mdal_userupdate').modal('show');
    }, 30);
}

$(document).ready(function () {
    $('#table_users').DataTable({
        "pagingType": "full_numbers",
        "bPaginate": false,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 2 }
        ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });

    var table = $('#table_users').DataTable();

    // Edit record
    table.on('click', '.edit', function (e) {
        let $tr = $(this).closest('tr');
        let row = table.row($tr).data();

        // Call to populate the delete form
        popultUpdateForm(row[0], row[1], row[2],row[3],row[4]);
        // Opnening the modal
        openUpdateModal();

        e.preventDefault();

        /* Focusing input */
        setTimeout(function() {
            $('#mdal_userupdate').find('#frm_userupdate').find('input#tb_name').focus();
        }, 500);
    });

    // Delete a record
    table.on('click', '.remove', function (e) {
        e.preventDefault();

        let $tr = $(this).closest('tr');
        let row = table.row($tr).data();

        // Call to populate the delete form
        popultDeleteForm(row[0], row[1], row[2],row[3]);
        // Opnening the modal
        openDeleteModal();

        /*let $tr = $(this).closest('tr');
        table.row($tr).remove().draw();*/
    });

    //Like record
    table.on('click', '.like', function () {
        alert('You clicked on Like button');
    });
});



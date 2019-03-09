/* FORM VALIDATION RULE -- MODALS */
let formCreateRules = {
    name: {
        required: true,
        maxlength: 20
    },
    description: {
        required: true
    }
};

/* FORM POPLULATION -- MODALS */
function popultDeleteForm(roleid, roleName, roleDescription) {

    // $('div#frm_deleteRole input#tb_id').val(roleid);
    // $('div#frm_deleteRole input#tb_name').val(roleName);
    // $('div#frm_deleteRole input#tb_description').val(roleDescription);

    let deleteForm = $('div#frm_deleteRole form');

    deleteForm.find('input#tb_id').val(roleid);
    deleteForm.find('input#tb_name').val(roleName);
    deleteForm.find('input#tb_description').val(roleDescription);

    // Updating the id parameter in action attrib
    let currentFormAction = deleteForm.attr('action');

    /* TODO Maybe is better to save the action url at the beggining and averride every time populate runs
    /* that way we don't need isGood2ApendID method */
    if (isGood2ApendID(currentFormAction))
        deleteForm.attr('action', currentFormAction + '/' + roleid);
    /* TODO if elese condition ocours notice the error to the user */
}

function popultUpdateForm(roleid, roleName, roleDescription, rolePermissions) {

    let updateForm = $('div#frm_updateRole form');

    updateForm.find('input#tb_id').val(roleid);
    updateForm.find('input#tb_name').val(roleName);
    updateForm.find('input#tb_description').val(roleDescription);
    let permissions = rolePermissions.split(",");
    permissions.forEach(function (value, index, array) {
        updateForm.find('input#i'+value).prop('checked',true);
    });

    // Updating the id parameter in action attrib
    let currentFormAction = updateForm.attr('action');

    /* TODO Maybe is better to save the action url at the beggining and averride every time populate runs
    /* that way we don't need isGood2ApendID method */
    if (isGood2ApendID(currentFormAction))
        updateForm.attr('action', currentFormAction + '/' + roleid);
    /* TODO if elese condition ocours notice the error to the user */
}


/* DEFINITION -- MODALS */
//Crete
function showCreateForm(){
    $('#mdal_createRole').find('#frm_createRole').fadeIn('fast', null, 30 );
    $('.error').removeClass('alert alert-danger').html('');
}

function openCreateModal(){
    showCreateForm();
    setTimeout(function(){
        $('#mdal_createRole').modal('show');
    }, 30);

}

//Delete
function showDeleteForm(){
    $('#mdal_deleteRole').find('#frm_deleteRole').fadeIn('fast', null, 30 );
    $('.error').removeClass('alert alert-danger').html('');
}

function openDeleteModal(){
    showDeleteForm();
    setTimeout(function(){
        $('#mdal_deleteRole').modal('show');
    }, 30);

}

//Update
function showUpdateForm(){
    $('#mdal_updateRole').find('#frm_updateRole').fadeIn('fast', null, 30 );
    $('.error').removeClass('alert alert-danger').html('');
}

function openUpdateModal(){
    showUpdateForm();
    setTimeout(function(){
        $('#mdal_updateRole').modal('show');
    }, 30);
}

$(document).ready(function () {

    /* CONFIGURATION -- DATATABLE */
    $('#tbl_roles').DataTable({
        /* TODO User the norma or reduced buttoms here */
        "pagingType": "simple_numbers",
        "autoWidth" : false,
        "bPaginate": false,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,

        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: 3 },

            { "width": "6px", "targets": 0 },
            { "width": "10px", "targets": 1 },
            { "width": "10px", "targets": 2 },
            { "width": "60px", "targets": 3 },
            { "width": "10px", "targets": 4 },
        ],
        order: [ 1, 'asc' ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }
    });

    let table = $('#tbl_roles').DataTable();

    /* INTERACTION -- CRUD BUTTONS / FORMS BUTTONS */

    // Edit record
    table.on('click', '.edit', function (e) {
        let $tr = $(this).closest('tr');
        let row = table.row($tr).data();

        // Call to populate the delete form
        popultUpdateForm(row[0], row[1], row[2],row[3]);
        // Opnening the modal
        openUpdateModal();

        e.preventDefault();

        /* Focusing input */
        setTimeout(function() {
            $('#mdal_updateRole').find('#frm_updateRole').find('input#tb_name').focus();
        }, 500);
    });

    // Delete a record
    table.on('click', '.remove', function (e) {

        let $tr = $(this).closest('tr');
        let row = table.row($tr).data();

        // Call to populate the delete form
        popultDeleteForm(row[0], row[1], row[2]);
        // Opnening the modal
        openDeleteModal();

        /*let $tr = $(this).closest('tr');
        table.row($tr).remove().draw();*/
        e.preventDefault();
    });

    /* TODO Use this booton for reserve permission to the role */
    //Like record
    table.on('click', '.like', function (e) {
        alert('You clicked on Like button');
        e.preventDefault();
    });

    //Add Role
    $('button#btn_addrole').click(function () {
        openCreateModal();

        hosekeeping($('#mdal_createRole').find('#frm_createRole'));

        /* Focusing input */
        setTimeout(function() {
            $('#mdal_createRole').find('#frm_createRole').find('input#tb_name').focus();
        }, 500);
    });

    // Role create submit
    $('button#btn_rolescreatesubmt').click(function () {
        if (!$('#mdal_createRole').find('#frm_createRole').find('form').valid())
            showajaxerror('#mdal_createRole');
    });

    // Role update submit
    $('button#btn_roleupdatesubmt').click(function () {
        if (!$('#mdal_updateRole').find('#frm_updateRole').find('form').valid())
            showajaxerror('#mdal_updateRole');
    });



    /* AUTOMATION OPS --  */
    if($('span#show_modal').html() === 'show') {
        openCreateModal();
    }

    /* INITIALIZATION OF VALIDATION PLUGINS */
    setFormValidation($('#mdal_createRole').find('#frm_createRole').find('form'), formCreateRules);
    setFormValidation($('#mdal_updateRole').find('#frm_updateRole').find('form'), formCreateRules);     //The formCreateRules works here too
});





$(document).ready(function () {

    var deleteLogModal = $('div#delete-log-modal'),
        deleteLogForm  = $('form#delete-log-form'),
        submitBtn      = deleteLogForm.find('button[type=submit]');

    $("a[href='#delete-log-modal']").on('click', function(event) {
        event.preventDefault();
        var date = $(this).data('log-date');
        deleteLogForm.find('input[name=date]').val(date);

        let modalText = deleteLogModal.find('.modal-body p').html();
        deleteLogModal.find('.modal-body p').html(modalText + '<span class="badge badge-primary">' + date + '</span>.');

        deleteLogModal.modal('show');
    });

    deleteLogForm.on('submit', function(event) {
        event.preventDefault();
        submitBtn.button('loading');

        $.ajax({
            url:      $(this).attr('action'),
            type:     $(this).attr('method'),
            dataType: 'json',
            data:     $(this).serialize(),
            success: function(data) {
                submitBtn.button('reset');
                if (data.result === 'success') {
                    deleteLogModal.modal('hide');
                    location.reload();
                }
                else {
                    alert('AJAX ERROR ! Check the console !');
                    console.error(data);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                alert('AJAX ERROR ! Check the console !');
                console.error(errorThrown);
                submitBtn.button('reset');
            }
        });

        return false;
    });

    deleteLogModal.on('hidden.bs.modal', function() {
        deleteLogForm.find('input[name=date]').val('');
        deleteLogModal.find('.modal-body p').html('');
    });
});


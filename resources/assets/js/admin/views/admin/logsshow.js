$(document).ready(function () {

    var deleteLogModal = $('div#delete-log-modal'),
        deleteLogForm  = $('form#delete-log-form'),
        submitBtn      = deleteLogForm.find('button[type=submit]');

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
                    location.replace("{{ route('log-viewer::logs.list') }}");
                }
                else {
                    alert('OOPS ! This is a lack of coffee exception !')
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
});

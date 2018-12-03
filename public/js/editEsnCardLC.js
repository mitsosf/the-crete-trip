
$('#edit-esncard').on('click', function () {
    $('#edit-esncard-modal').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
        method: 'POST',
        url: url,
        data:{
            esncard: $('#new-esn-card').val(),
            _token: token
        }
    }).done(function (msg) {
        //$('#esncard').text(msg['new-esncard']);
        $('#modal-save').modal('hide');
        location.reload();
    })
});
$(document).ready(function () {
    $('#autore').change(function () {
        if ($(this).val() === 'altro') {
            $('#altroAutore').show();
        } else {
            $('#altroAutore').hide();
        }
    });

    $('#libriTable').DataTable();
});

$(document).ready(function () {
    $('#libriTable').DataTable();
});

$(document).ready(function () {
    $('#autore').change(function () {
        if ($(this).val() === 'altro') {
            $('#altroAutore').show();
        } else {
            $('#altroAutore').hide();
        }
    });

});

$(document).ready(function () {
    $('.autore_modifica').change(function () {
        if ($(this).val() === 'altro') {
            $('.altroAutore').show();
        } else {
            $('.altroAutore').hide();
        }
    });

});

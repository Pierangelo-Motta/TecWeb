function updateNotifications() {
    $.ajax({
        type: 'GET',
        url: 'include/get_notifications.php',
        success: function(data) {
            $('#notification-list').html(data);
        },
        error: function(error) {
            console.log('Errore durante l\'aggiornamento delle notifiche:', error);
        }
    });
}

$(document).ready(function() {
    updateNotifications();
    //FIXME: un pò un overkill usare AJAX qui, almeno che non fai il refresh continuo con un setInterval
});

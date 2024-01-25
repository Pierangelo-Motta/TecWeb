let utenteId, dataOra;

$(document).ready(function() {
    // Inizializza la variabile alreadyLiked a null
    let alreadyLiked = null;

    // Recupera il valore dalla variabile PHP tramite AJAX
    $.ajax({
        type: 'POST',
        url: 'include/likePost.php',
        data: { utenteId: utenteId, dataOra: dataOra },
        dataType: 'json',
        success: function(response) {
            console.log(response);

            // Imposta la variabile alreadyLiked con il valore ottenuto dalla risposta dell'AJAX
            alreadyLiked = response.alreadyLiked;

            // Imposta l'icona del pollice pieno o vuoto a seconda dello stato iniziale
            $('.like-button').each(function() {
                // Inizializza le variabili all'interno della funzione .each()
                let emptyThumb = $(this).find('#emptyThumb');
                let filledThumb = $(this).find('#filledThumb');

                if (alreadyLiked) {
                    emptyThumb.hide();
                    filledThumb.show();
                } else {
                    emptyThumb.show();
                    filledThumb.hide();
                }
            });

            // Gestione dell'evento click sul pulsante "like"
            $('.like-button').on('click', function() {
                let utenteId = $(this).data('utenteid');
                let dataOra = $(this).data('dataora');
                let likeCountElement = $(this).closest('.card-body').find('.like-count');
                let emptyThumb = $(this).find('#emptyThumb');
                let filledThumb = $(this).find('#filledThumb');

                $.ajax({
                    type: 'POST',
                    url: 'include/likePost.php',
                    data: { utenteId: utenteId, dataOra: dataOra },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);

                        if (response.status === "success") {
                            let currentLikes = parseInt(likeCountElement.text());

                            if (response.likeRemoved) {
                                likeCountElement.text(currentLikes - 1);
                                emptyThumb.show();
                                filledThumb.hide();
                            } else {
                                likeCountElement.text(currentLikes + 1);
                                emptyThumb.hide();
                                filledThumb.show();
                            }
                        } else {
                            console.error("Errore durante l'aggiornamento del like:", response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Errore durante la richiesta AJAX:", status, error);
                        console.log(xhr.responseText);
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            console.error("Errore durante la richiesta AJAX:", status, error);
            console.log(xhr.responseText);
        }
    });
});

$(document).ready(function() {
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
            success: function(response) {
                console.log(response);

                if (response.trim() === "success") {
                    let currentLikes = parseInt(likeCountElement.text());
                    likeCountElement.text(currentLikes + 1);

                    // Mostra o nascondi le icone vuote e piene
                    emptyThumb.toggle();
                    filledThumb.toggle();
                } else {
                    console.error("Errore durante l'aggiornamento del like.");
                }
            },
            error: function(xhr, status, error) {
                console.error("Errore durante la richiesta AJAX:", status, error);
                console.log(xhr.responseText);
            }
        });
    });
});

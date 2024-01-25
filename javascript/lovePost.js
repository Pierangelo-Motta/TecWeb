$(document).ready(function() {
    $('.love-button').on('click', function() {
        let utenteId = $(this).data('utenteid');
        let dataOra = $(this).data('dataora');
        let loveCountElement = $(this).closest('.card-body').find('.love-count');
        let emptyHeart = $(this).find('#emptyHeart');
        let filledHeart = $(this).find('#filledHeart');

        $.ajax({
            type: 'POST',
            url: 'include/lovePost.php',
            data: { utenteId: utenteId, dataOra: dataOra },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                if (response.status === "success") {
                    let currentLoves = parseInt(loveCountElement.text());

                    if (response.loveRemoved) {
                        loveCountElement.text(currentLoves - 1);
                        emptyHeart.classList.remove("d-none");
                        filledHeart.classList.add("d-none");
                    } else {
                        loveCountElement.text(currentLoves + 1);
                        emptyHeart.classList.add("d-none");
                        filledHeart.classList.remove("d-none");
                    }
                } else {
                    console.error("Errore durante l'aggiornamento del love:", response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Errore durante la richiesta AJAX:", status, error);
                console.log(xhr.responseText);
            }
        });
    });
});

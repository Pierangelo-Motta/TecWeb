$(document).ready(function() {
    $('.like-button').on('click', function() {
        let utenteId = $(this).data('utenteid');
        let dataOra = $(this).data('dataora');
        let likeCountElement = $(this).closest('.card-body').find('.like-count');
        let emptyThumb = $(this).find('.emptyThumb');
        let filledThumb = $(this).find('.filledThumb');

        $.ajax({
            type: 'POST',
            url: 'include/likePost.php',
            data: { utenteId: utenteId, dataOra: dataOra },
            dataType: 'json',
            success: function(response) {

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
});


document.querySelectorAll(".like-button svg").forEach(elem => {
    console.log(elem + " / " + elem.getAttribute("mustshow"));
    if(elem.getAttribute("data-mustshow") === "0"){
        elem.style.display = "none";
    } else {
        elem.style.display = "block";
    }
})

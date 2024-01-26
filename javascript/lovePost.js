$(document).ready(function() {
    $('.love-button').on('click', function() {
        let utenteId = $(this).data('utenteid');
        let dataOra = $(this).data('dataora');
        let loveCountElement = $(this).closest('.card-body').find('.love-count');
        let emptyHeart = $(this).find('.emptyHeart');
        let filledHeart = $(this).find('.filledHeart');

        $.ajax({
            type: 'POST',
            url: 'include/lovePost.php',
            data: { utenteId: utenteId, dataOra: dataOra },
            dataType: 'json',
            success: function(response) {

                if (response.status === "success") {
                    let currentLoves = parseInt(loveCountElement.text());

                    if (response.loveRemoved) {
                        loveCountElement.text(currentLoves - 1);
                        console.log(emptyHeart.classList + " # " + filledHeart);
                        // emptyHeart.classList.remove("d-none");
                        // filledHeart.classList.add("d-none");
                        emptyHeart.show();
                        filledHeart.hide();
                    } else {
                        loveCountElement.text(currentLoves + 1);
                        // emptyHeart.classList.add("d-none");
                        // filledHeart.classList.remove("d-none");
                        emptyHeart.hide();
                        filledHeart.show();
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


document.querySelectorAll(".love-button svg").forEach(elem => {
    console.log(elem + " / " + elem.getAttribute("mustshow"));
    if(elem.getAttribute("data-mustshow") === "0"){
        elem.style.display = "none";
    } else {
        elem.style.display = "block";
    }
})

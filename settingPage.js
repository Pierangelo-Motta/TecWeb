/** Gestione della visibilità degli oggetti sulla pagina */

document.addEventListener('DOMContentLoaded', function () {

    // Click event for "Cambia password"
    document.querySelector('.password').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('passwordContent').style.display = 'block';
    });

    // Click event for "Modifica la tua descrizione utente"
    document.querySelector('.description').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('descriptionContent').style.display = 'block';
    });

    // Click event for "Cambia immagine del profilo"
    document.querySelector('.profile').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('profileContent').style.display = 'block';
    });

    // Click event for "Gestisci Libri"
    document.querySelector('.book').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('bookContent').style.display = 'block';
    });

    // Click event for "Gestisci Medagliere"
    document.querySelector('.goal').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('goalContent').style.display = 'block';
    });

    // Click event for "Elimina account"
    document.querySelector('.delete').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('deleteContent').style.display = 'block';
    });

    // Click event for "Cambia password"
    document.querySelector('.manage').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('manageContent').style.display = 'block';
    });

    function hideAllContent() {
        // Hide all content divs
        let contentDivs = document.querySelectorAll('.content');
        for (let i = 0; i < contentDivs.length; i++) {
            contentDivs[i].style.display = 'none';
        }
    }

});

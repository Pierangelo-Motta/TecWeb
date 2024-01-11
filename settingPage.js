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

    // Click event for "Elimina account"
    document.querySelector('.delete').addEventListener('click', function () {
        hideAllContent();
        document.getElementById('deleteContent').style.display = 'block';
    });

    function hideAllContent() {
        // Hide all content divs
        let contentDivs = document.querySelectorAll('.content');
        for (let i = 0; i < contentDivs.length; i++) {
            contentDivs[i].style.display = 'none';
        }
    }
});

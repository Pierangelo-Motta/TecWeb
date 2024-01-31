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
    let book = document.querySelector('.book');
    if (book) {
        book.addEventListener('click', function () {
            hideAllContent();
        document.getElementById('bookContent').style.display = 'block';
    });}
    // questo codice, lancia un'eccezione se non  sono admin (book non esiste sulla pagina)
    // document.querySelector('.book').addEventListener('click', function () {
    //     hideAllContent();
    //     document.getElementById('bookContent').style.display = 'block';
    // });

    // Click event for "Gestisci Medagliere"
    let goal = document.querySelector('.goal');
    if (goal) {
        goal.addEventListener('click', function () {
            hideAllContent();
            document.getElementById('goalContent').style.display = 'block';
        });
    }
    // questo codice, lancia un'eccezione se non  sono admin (goal non esiste sulla pagina)
    // document.querySelector('.goal').addEventListener('click', function () {
    //     hideAllContent();
    //     document.getElementById('goalContent').style.display = 'block';
    // });

    
    // Click event for "Elimina account"
    let deleteUser = document.querySelector('.delete');
    if (deleteUser) {
        deleteUser.addEventListener('click', function () {
            hideAllContent();
            document.getElementById('deleteContent').style.display = 'block';
        });

    }
    // questo codice, lancia un'eccezione se non  sono admin (delete non esiste sulla pagina)
    // document.querySelector('.delete').addEventListener('click', function () {
    //     hideAllContent();
    //     document.getElementById('deleteContent').style.display = 'block';
    // });


    // Click event for "Cambia password"
    let manage = document.querySelector('.manage');
    if (manage) {
        manage.addEventListener('click', function () {
            hideAllContent();
            document.getElementById('manageContent').style.display = 'block';
        });
    }
    // questo codice, lancia un'eccezione se non  sono admin (manage non esiste sulla pagina)
    // document.querySelector('.manage').addEventListener('click', function () {
    //     hideAllContent();
    //     document.getElementById('manageContent').style.display = 'block';
    // });

    function hideAllContent() {
        // Hide all content divs
        let contentDivs = document.querySelectorAll('.content');
        for (let i = 0; i < contentDivs.length; i++) {
            contentDivs[i].style.display = 'none';
        }
    }

});

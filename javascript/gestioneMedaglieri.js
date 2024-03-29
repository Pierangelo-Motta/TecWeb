
let medagliereid;

$('#dropdownMenu p').on('click', function () {
    const titolo = $(this).attr('data-titolo');
    const descrizione = $(this).attr('data-descrizione');
    medagliereid = $(this).attr('data-medagliereid');
    console.log(medagliereid);
    // Set the values in the input fields
    $('#selectedItemTitoloInput').val(titolo);
    $('#selectedItemDescrizioneInput').val(descrizione);

    fetch('include/libriInMedagliere.php?idLibro=' + medagliereid)
        .then(response => response.json())
        // .then(data => console.log(data))
        .then(data => addLibriToList(data))
        // .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
});


// renderizzo i libri appartenenti al medagliere
function addLibriToList(libriInMedagliere) {
    let libriList = document.getElementById("libriList");
    // console.log(libriList);

    // Clear existing content before adding new list items
    libriList.innerHTML = '';
    libriInMedagliere.forEach(function (libro) {
        let listItem = document.createElement("li");
        listItem.className = "list-group-item";

        let removeButton = document.createElement("button");
        removeButton.className = "btn btn-danger btn-sm m-2 removebtn";
        removeButton.textContent = "X";
        removeButton.id = "btn_" + libro.id;

        let bookTitle = document.createTextNode(libro.titolo);

        listItem.appendChild(removeButton);
        listItem.appendChild(bookTitle);

        libriList.appendChild(listItem);
        // console.log("Aggiunto libro: id " + libro.id + " titolo: " + libro.titolo);
    });
    // console.log(getRemainingBooks());
}


document.addEventListener('DOMContentLoaded', function () {
    // Event listener for the "X" buttons
    document.getElementById('libriList').addEventListener('click', function (event) {
        if (event.target.classList.contains('removebtn')) {
            // Check if the clicked element has the 'removebtn' class
            // If yes, it's the "X" button

            // Get the corresponding list item
            let listItem = event.target.closest('.list-group-item');

            // Remove the list item from the list
            listItem.remove();

            // ottego i libri rimasti
            let remainingBooks = getRemainingBooks();
            console.log(remainingBooks);

            // da implementare per salvare lo stato su db
            

        }

    });

    console.log("PAGE LOADED");

});

// funzione per ottenere l'elenco dei libri rimasti nel medagliere (anche dopo eliminazione)
function getRemainingBooks() {
    let libriList = document.getElementById('libriList');
    let medId = medagliereid;

    let remainingBooks = [];

    libriList.querySelectorAll('.list-group-item').forEach(function (listItem) {
        let bookId = listItem.querySelector('.removebtn').id.replace('btn_', '');
        let bookTitle = listItem.textContent.trim();

        remainingBooks.push({ id: bookId, titolo: bookTitle, medagliere_id: medId });
    });

    return remainingBooks;
}

// funzione che aggiunge nuovi libri all'elenco del medagliere
function addBookToLibriList(bookId, bookTitle) {
    let libriList = document.getElementById("libriList");
    let listItem = document.createElement("li");
    listItem.className = "list-group-item";

    let removeButton = document.createElement("button");
    removeButton.className = "btn btn-danger btn-sm m-2 removebtn";
    removeButton.textContent = "X";
    // 
    removeButton.id = "btn_" + bookId;

    let bookTitleNode = document.createTextNode(bookTitle);

    listItem.appendChild(removeButton);
    listItem.appendChild(bookTitleNode);

    libriList.appendChild(listItem);

}

// permette di selezionare libri dalla tabella libri e aggiungerli all'elenco del medagliere

$(document).ready(function () {
    // Click event handler for the libriTable
    $('#libriTable').on('click', 'tbody tr', function () {
        // Ottengo il titolo del libro e l'id
        let bookTitle = $(this).find('td').text();
        let bookId = $(this).find('td').attr('id').replace('libroid-', '');

        // chiamo la funzione per aggiungere libri all'elenco del medagliere
        addBookToLibriList(bookId, bookTitle);

        $(this).hide();

        // console.log("aggiunto libro id: " + bookId);
        // console.log(getRemainingBooks());
        // console.log("ESISTE: " + isBookIdInArray(bookId, getRemainingBooks()));

    });

});


document.getElementById('salvaLibriInMedagliere').addEventListener('click', function (event) {
    console.log("salvaLibriInMedagliere btn premuto");
    console.log(getRemainingBooks());
    const remainingBooks = getRemainingBooks();
    console.log("Data to be sent:", remainingBooks);
    // Make a POST request to the backend PHP script
    fetch('include/insertLibriInMedagliere.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ books: remainingBooks })
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            openPopup();
            // Handle success or error
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error
        });

})

document.addEventListener('click', function (event) {
    // Code to be executed on each click
    // console.log('Click detected!');
    // console.log('Clicked element:', event.target);
    // console.log('Clicked element:', event.target.getAttribute('id').replace('btn_', ''));
    let bookId = event.target.getAttribute('id').replace('btn_', '');
    let stringa = "btn_" + bookId;
    if (event.target.getAttribute('id') === stringa) {
        console.log("OK: " + stringa);
        let targetRow = $('#libriTable tbody tr').filter(function () {
            let rowBookId = $(this).find('td').attr('id').replace('libroid-', '');
            return rowBookId === bookId;
        });

        targetRow.show();
    }

});


function openPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("popup").style.display = "block";
}

function closePopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("popup").style.display = "none";
}


document.getElementById('chiudi-popup').addEventListener('click', function () {
   closePopup();
}) 
document.addEventListener('DOMContentLoaded', function () {
    let tableRows = document.querySelectorAll('.medaglieri-row');

    tableRows.forEach(function (row) {
        row.addEventListener('click', function () {
            // this.style.color = "red";
            let description = this.getAttribute('data-description');
            document.getElementById('descriptionContainer').innerHTML = description;
        });
    });
});

// document.addEventListener('DOMContentLoaded', function () {
//     // const dropdownButton = document.getElementById('dropdownButton');
//     const dropdownMenu = document.getElementById('dropdownMenu');
//     // console.log(dropdownMenu);
//     const selectedItemText = document.getElementById('selectedItemTitolo');
//     // console.log("selectedItemText:" + selectedItemText.value);
//     const selectedItemDescription = document.getElementById('selectedItemDescrizione');

//     dropdownMenu.addEventListener('click', function (event) {
//         const selectedValue = event.target.getAttribute('titolo');
//         const selectedItemDescriptionValue = event.target.getAttribute('descrizione');
//         console.log("selectedValue:" + selectedValue);
//         console.log("selectedItemDescriptionValue:" + selectedItemDescriptionValue);

//         if (selectedValue) {
//             selectedItemText.innerText = selectedValue;
//         }
//         if (selectedValue) {
//             selectedItemDescription.innerText = selectedItemDescriptionValue;
//         }
//     });

// });


$('#dropdownMenu p').on('click', function () {
    const titolo = $(this).attr('data-titolo');
    const descrizione = $(this).attr('data-descrizione');
    medagliereid = $(this).attr('data-medagliereid');
    console.log(medagliereid);
    // Set the values in the input fields
    $('#selectedItemTitoloInput').val(titolo);
    $('#selectedItemDescrizioneInput').val(descrizione);

    // Perform an AJAX request to the server
    // let xhr = new XMLHttpRequest();
    // xhr.open("GET", "include/libriInMedagliere.php?idLibro=" + id + "", true);
    // xhr.onreadystatechange = function () {
    //     if (xhr.readyState == 4 && xhr.status == 200) {
    //         // Handle the response from the server
    //         let data = JSON.parse(xhr.responseText);
    //         console.log(data);
    //     }
    // };
    // xhr.send();
    fetch('include/libriInMedagliere.php?idLibro=' + medagliereid)
        .then(response => response.json())
        // .then(data => console.log(data))
        .then(data => addLibriToList(data))
        // .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
});

// let dropdown = document.getElementById('dropdownButton');

// dropdown.addEventListener('change', function () {
//     // Get the selected value
//     let selectedValue = dropdown.value;
//     console.log("selectedValue: " + selectedValue);
//     // Perform a GET request or any other action with the selected value
//     // Example: You can use fetch API to make a GET request
//     fetch('include/libriInMedagliere.php?idLibro=' + selectedValue)
//         .then(response => response.json())
//         .then(data => console.log(data))
//         .catch(error => console.error('Error:', error));
// })

// Clear existing content before adding new list items
function addLibriToList(libriInMedagliere) {
    let libriList = document.getElementById("libriList");
    
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
    });
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
            
            //TODO: da implementare per salvare lo stato su db
            // Perform an AJAX request to update the database with the remaining books
            fetch('include/updateMedagliereDB.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ action: 'update', books: remainingBooks }),
            })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));
                 
           
        }
        
        
    });
    
});

// funzione per ottenere l'elenco dei libri rimasti nel medagliere dopo un'eliminazione
function getRemainingBooks() {
    let libriList = document.getElementById('libriList');
    let remainingBooks = [];
    
    libriList.querySelectorAll('.list-group-item').forEach(function (listItem) {
        let bookId = listItem.querySelector('.removebtn').id.replace('btn_', '');
        let bookTitle = listItem.textContent.trim();
        
        remainingBooks.push({ id: bookId, titolo: bookTitle });
    });
    
    return remainingBooks;
}

// funzione che aggiunge libri all'elenco del medagliere
function addBookToLibriList(bookId, bookTitle) {
    let libriList = document.getElementById("libriList");
    
    let listItem = document.createElement("li");
    listItem.className = "list-group-item";
    
    let removeButton = document.createElement("button");
    removeButton.className = "btn btn-danger btn-sm m-2 removebtn";
    removeButton.textContent = "X";
    // You may need to dynamically generate unique IDs for each button
    removeButton.id = "btn_" + bookId;
    
    let bookTitleNode = document.createTextNode(bookTitle);
    
    listItem.appendChild(removeButton);
    listItem.appendChild(bookTitleNode);
    
    libriList.appendChild(listItem);
}

// permette di selezionare libri dalla tabella libri e aggiungerli all'elenco del medagliere
// TODO: inserire il btn per l'eliminazione con id del libro....
$(document).ready(function () {
    // Click event handler for the libriTable
    $('#libriTable').on('click', 'tbody tr', function () {
        // Ottengo il titolo del libro e l'id
        var bookTitle = $(this).find('td').text();
        var bookId = $(this).find('td').attr('id').replace('libroid-', '');

        // chiamo la funzione per aggiungere libri all'elenco del medagliere
        addBookToLibriList(bookId, bookTitle);
    });
});

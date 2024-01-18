document.addEventListener('DOMContentLoaded', function () {
    var tableRows = document.querySelectorAll('.medaglieri-row');

    tableRows.forEach(function (row) {
        row.addEventListener('click', function () {
            // this.style.color = "red";
            var description = this.getAttribute('data-description');
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

$('#dropdownMenu a').on('click', function () {
    const titolo = $(this).attr('titolo');
    const descrizione = $(this).attr('descrizione');

    // Set the values in the input fields
    $('#selectedItemTitoloInput').val(titolo);
    $('#selectedItemDescrizioneInput').val(descrizione);
});
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

document.addEventListener('DOMContentLoaded', function () {
    // const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const selectedItemText = document.getElementById('selectedItemText');

    dropdownMenu.addEventListener('click', function (event) {
        const selectedValue = event.target.getAttribute('data');
        const selectedItemDescription = event.target.getAttribute('data-value-descr');
        if (selectedValue) {
            selectedItemText.innerText = selectedValue;
        }
        if (selectedValue) {
            selectedItemDescription.innerText = selectedItemDescription;
        }
    });

});
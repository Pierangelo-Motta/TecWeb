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
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
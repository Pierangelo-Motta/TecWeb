function showAutocomplete(inputValue, tipologia) {
    var tipo = tipologia;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var userList = JSON.parse(xhr.responseText);
            var filteredUsers = userList.filter(function (user) {
                return user.username.toLowerCase().includes(inputValue.toLowerCase());
            });

            var deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');
            deleteUserAutocompleteResults.innerHTML = '';

            filteredUsers.forEach(function (user) {
                var option = document.createElement('div');
                option.textContent = user.username;
                option.addEventListener('click', function () {
                    document.getElementById(tipo).value = user.username;
                    deleteUserAutocompleteResults.innerHTML = '';
                });
                deleteUserAutocompleteResults.appendChild(option);
            });

            // Show/hide the autocomplete results container based on the number of results
            deleteUserAutocompleteResults.style.display = filteredUsers.length > 0 ? 'block' : 'none';
        }
    };

    xhr.open('GET', 'include/userList.php', true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();
}

document.addEventListener('click', function (event) {
    var autocompleteContainer = document.querySelector('.du-autocomplete-container');
    var deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');

    if (!autocompleteContainer.contains(event.target)) {
        deleteUserAutocompleteResults.style.display = 'none';
    }
});

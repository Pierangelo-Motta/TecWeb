function showAutocomplete(inputValue, tipologia, classe) {
    let tipo = tipologia;
    let cl = classe;
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let userList = JSON.parse(xhr.responseText);
            let filteredUsers = userList.filter(function (user) {
                return user.username.toLowerCase().includes(inputValue.toLowerCase());
            });

            let autocompleteResults = document.getElementById(cl);
            autocompleteResults.innerHTML = '';

            filteredUsers.forEach(function (user) {
                let option = document.createElement('div');
                option.textContent = user.username;
                option.addEventListener('click', function () {
                    document.getElementById(tipo).value = user.username;
                    autocompleteResults.innerHTML = '';
                });
                autocompleteResults.appendChild(option);
            });

            // Show/hide the autocomplete results container based on the number of results
            autocompleteResults.style.display = filteredUsers.length > 0 ? 'block' : 'none';
        }
    };

    xhr.open('GET', 'include/userList.php', true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();
}

document.addEventListener('click', function (event) {
    let deleteUserAutocompleteContainer = document.querySelector('.du-autocomplete-container');
    let deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');


    if (!deleteUserAutocompleteContainer.contains(event.target)) {
        deleteUserAutocompleteResults.style.display = 'none';
    }

    let manageUserAutocompleteContainer = document.querySelector('.autocomplete-container');
    let manageUserAutocompleteResults = document.getElementById('autocompleteResults');

    if (!manageUserAutocompleteContainer.contains(event.target)) {
        manageUserAutocompleteResults.style.display = 'none';
    }

});

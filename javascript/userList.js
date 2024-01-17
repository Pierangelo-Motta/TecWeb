if (typeof fu === 'undefined') {
    let fu;
}

function showAutocomplete(inputValue, tipologia, classe) {
    let tipo = tipologia;
    let cl = classe;
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let userList = JSON.parse(xhr.responseText);
            filteredUsers = userList.filter(function (user) {
                return user.username.toLowerCase().includes(inputValue.toLowerCase());
            });
            // console.log(filteredUsers);
            fu = filteredUsers;
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
                // console.log(option);
            });

            // Show/hide the autocomplete results container based on the number of results
            autocompleteResults.style.display = filteredUsers.length > 0 ? 'block' : 'none';
            autocompleteResults.style.color = "#0b5ed7";
            // console.log(autocompleteResults);


        }
    };

    xhr.open('GET', 'include/userList.php', true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();

    // console.log("xhr done: inside");

}


document.addEventListener('click', function (event) {
    // delete user
    document.getElementById('userSelect').addEventListener('input', function () {
        showAutocomplete(this.value, 'userSelect', 'deleteUserAutocompleteResults');
    });

    // manage user
    document.getElementById('manageThisUser').addEventListener('input', function () {
        showAutocomplete(this.value, 'manageThisUser', 'autocompleteResults');
        // console.log("xhr done: outside");
    });
    // console.log(fu);

    // Gestione cancellazione utente 
    let deleteUserAutocompleteContainer = document.querySelector('.du-autocomplete-container');
    let deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');

    if (!deleteUserAutocompleteContainer.contains(event.target)) {
        deleteUserAutocompleteResults.style.display = 'none';
    }

    // Gestione management utente
    let manageUserAutocompleteContainer = document.querySelector('.autocomplete-container');
    let manageUserAutocompleteResults = document.getElementById('autocompleteResults');

    if (!manageUserAutocompleteContainer.contains(event.target)) {
        manageUserAutocompleteResults.style.display = 'none';
    }

    //new
    // let manageThisUser = document.getElementById('manageThisUser');
    // let checkBoxFlag = document.getElementById('isAdminCheckbox');
    // utente = manageThisUser.value;
    // isUtenteAdmin = filteredUsers.find(user => user.username === manageThisUser.value).isAdmin;
    // isUtenteBanned = filteredUsers.find(user => user.username === manageThisUser.value).stato;

    // console.log(filteredUsers);
    // console.log(manageThisUser.value + " -> " + filteredUsers.find(user => user.username === manageThisUser.value).isAdmin);
    // console.log("000: " + utente + " -> " + isUtenteAdmin);
    //gestione del check admin
    // if (utente.length > 0) {
    //     (isUtenteAdmin === 1) ? checkBoxFlag.checked = true : checkBoxFlag.checked = false;
    // }

    // if (utente.length > 0) {
    //     console.log("001");
    //     // (isUtenteAdmin === 1) ? checkBoxFlag.checked = true : checkBoxFlag.checked = false;
    //     (isUtenteAdmin === 1) ? document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1" checked>' : document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1">';
    // }


});


// document.getElementById('isAdminCheckbox').addEventListener('change', function () {
// // Check if the checkbox is checked
//     if (isUtenteAdmin === 1) {
//         // Checkbox was checked, update to unchecked
//         document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1">';
//         isUtenteAdmin = 0;
//     } else {
//         // Checkbox was unchecked, update to checked
//         document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1" checked>';
//         isUtenteAdmin = 1;
//     }
// });

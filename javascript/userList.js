// let isUtenteAdmin;
// let isUtenteBanned;

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
            let fu = new Array();
            fu = filteredUsers;
            let autocompleteResults = document.getElementById(cl);
            autocompleteResults.innerHTML = '';

            filteredUsers.forEach(function (user) {
                let option = document.createElement('div');
                option.textContent = user.username;
                option.addEventListener('click', function () {
                    document.getElementById(tipo).value = user.username;
                    autocompleteResults.innerHTML = '';
                    let utente = user.username;
                    let isUtenteAdmin = fu.find(x => x.username === utente)?.isAdmin;
                    let isUtenteBanned = fu.find(x => x.username === utente)?.stato;
                    
                    let checkBoxFlag = document.getElementById('isAdminCheckbox');
                    if (utente.length > 0) {
                        checkBoxFlag.checked = isUtenteAdmin === 1;
                    }
                    let bannedCheckBoxFlag = document.getElementById('userBannedCheckbox');
                    if (utente.length > 0) {
                        bannedCheckBoxFlag.checked = isUtenteBanned === 1;
                    }
                    console.log("040: user->" + utente + " isAdmin->" + isUtenteAdmin + " isBanned->"+ isUtenteBanned);
                });
                autocompleteResults.appendChild(option);
                // console.log(option);
                // Move the logic inside the onreadystatechange callback
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
    // utente = manageThisUser.value;
    // console.log("000 utente: " + utente);
    // console.log(fu);

    // isUtenteAdmin = fu.find(x => x.username === utente).isAdmin;
    // isUtenteBanned = fu.find(user => user.username === manageThisUser.value).stato;

    // console.log(manageThisUser.value + " -> " + filteredUsers.find(user => user.username === manageThisUser.value).isAdmin);
    // console.log("020: " + utente + " -> " + isUtenteAdmin);
    
    //gestione del check admin
    // console.log(updatedUserInformation);
    // let changingState = 1;
    // let changedState = 0;

    // if (utente.length > 0) {
    //     // (isUtenteAdmin === 1 && changingState && !changedState) ? checkBoxFlag.checked = true : checkBoxFlag.checked = false;
    //     // (isUtenteAdmin === 1 && changingState && !changedState) ? checkBoxFlag.checked = true : checkBoxFlag.checked = false;
    // }

    // if (utente.length > 0) {
        // console.log("001");
        // (isUtenteAdmin === 1) ? checkBoxFlag.checked = true : checkBoxFlag.checked = false;
        // (isUtenteAdmin === 1) ? document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1" checked>' : document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1">';
    // }


});


// document.getElementById('isAdminCheckbox').addEventListener('click', function () {
//     // Check if the checkbox is checked
//     if (isUtenteAdmin === 1) {
//         // Checkbox was checked, update to unchecked
//         // document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1">';
//         isUtenteAdmin = 0;
//         console.log("030: " + isUtenteAdmin);
//     } else {
//         // Checkbox was unchecked, update to checked
//         // document.getElementById('adminBox').innerHTML = '<label for="isAdminCheckbox">Amministratore:</label><input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1" checked>';
//         isUtenteAdmin = 1;
//         console.log("035: " + isUtenteAdmin);

//     }
// });



document.addEventListener("DOMContentLoaded", function () {
    let messaggioErrorePwd1 = document.getElementById('passwordNotChanged1');
    let messaggioErrorePwd2 = document.getElementById('passwordNotChanged2');
    let messaggioPasswordChanged = document.getElementById('passwordChanged');
    
    messaggioErrorePwd1.style.display = "none";
    messaggioErrorePwd2.style.display = "none";
    messaggioPasswordChanged.style.display = "none";

    // console.log("here");
    if (window.location.href.endsWith("pwdup=KO1")) {
        messaggioErrorePwd1.style.display = "block";
    }
    if (window.location.href.endsWith("pwdup=KO2")) {
        messaggioErrorePwd2.style.display = "block";
    }

    if (window.location.href.endsWith("pwdup=OK")) {
        messaggioPasswordChanged.style.display = "block";
    }

})  


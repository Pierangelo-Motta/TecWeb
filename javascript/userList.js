let xhr = new XMLHttpRequest(); // Declare xhr globally
let userList;
let manageThisUser;
let checkBoxFlag;

function showAutocomplete(inputValue, tipologia, classe) {
    let tipo = tipologia;
    let cl = classe;
    //xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            userList = JSON.parse(xhr.responseText);
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

            // Now that the XMLHttpRequest is complete, add the click event listener for checkBoxFlag
            addCheckBoxEventListener();

        }
    };


    xhr.open('GET', 'include/userList.php', true);

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // linea aggiunta per settare l' "X-Requested-With header" che indica che questa è una richiesta AJAX.
    xhr.send();

}

document.addEventListener('click', function (event) {
    manageThisUser = document.getElementById('manageThisUser');
    checkBoxFlag = document.getElementById('isAdminCheckbox');
    //gestione del check admin
    if (manageThisUser.value.length > 0) {
        console.log(manageThisUser.value);
        console.log(userList.find(user => user.username === manageThisUser.value).isAdmin);
        if (userList.find(user => user.username === manageThisUser.value).isAdmin === 1) {
            checkBoxFlag.checked = true;
        }
        else { checkBoxFlag.checked = false; }
    }

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
    //console.log(userList);
});

function addCheckBoxEventListener() {
    checkBoxFlag.addEventListener('click', function () {
        checkBoxFlag.checked = !checkBoxFlag.checked;
    });
}

// Initialize the checkbox event listener
addCheckBoxEventListener();


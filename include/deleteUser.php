<?php
require_once('login.model.php');
?>


<style>
.card {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
}

/* Additional style for better spacing */
.form-group {
    margin-bottom: 1rem;
}

.manageThisUser {
    width: 100px;
}

.du-autocomplete-container {
    position: relative;
}

.deleteUserAutocomplete-results {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    border: 1px solid #ccc;
    border-top: none;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-height: 150px;
    overflow-y: auto;
}

.deleteUserAutocomplete-results div {
    padding: 8px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #ccc;
}

.deleteUserAutocomplete-results div:hover {
    background-color: #f0f0f0;
}
</style>

<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="" method="post">

                <!-- Dropdown menu for selecting a user -->
                <div class="form-group">
                    <label for="userSelect">Seleziona Utente:</label>
                    <div class="du-autocomplete-container">
                        <input type="text" id="userSelect" name="userSelect" oninput="showAutocomplete(this.value)">
                        <div id="deleteUserAutocompleteResults" class="deleteUserAutocomplete-results"></div>
                    </div>

                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <input type="button" class="btn btn-primary" value="Elimina Utente">
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function showAutocomplete(inputValue) {
    // Fetch data from the server based on the input value
    // This could be an AJAX request to a PHP script that queries the database
    // For simplicity, we'll use a static array here
    let userList = <?php echo json_encode(getListaElencoUtenti()); ?>;

    // Filter the user list based on the input value
    let filteredUsers = userList.filter(function(user) {
        return user.username.toLowerCase().includes(inputValue.toLowerCase());
    });

    // Display the autocomplete results
    let deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');
    deleteUserAutocompleteResults.innerHTML = '';

    filteredUsers.forEach(function(user) {
        let option = document.createElement('div');
        option.textContent = user.username;
        option.addEventListener('click', function() {
            document.getElementById('userSelect').value = user.username;
            deleteUserAutocompleteResults.innerHTML = '';
        });
        deleteUserAutocompleteResults.appendChild(option);
    });

    // Show/hide the autocomplete results container based on the number of results
    deleteUserAutocompleteResults.style.display = filteredUsers.length > 0 ? 'block' : 'none';
}

// Close the autocomplete results when clicking outside the input and results
document.addEventListener('click', function(event) {
    let autocompleteContainer = document.querySelector('.du-autocomplete-container');
    let deleteUserAutocompleteResults = document.getElementById('deleteUserAutocompleteResults');

    if (!autocompleteContainer.contains(event.target)) {
        deleteUserAutocompleteResults.style.display = 'none';
    }
});
</script>
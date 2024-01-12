<?php
require_once('login.model.php');
?>


<style>
.card {
    max-width: 600px;
    margin: 2rem auto;
    padding: 2rem;
}
</style>

<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="" method="post">

                <!-- Dropdown menu for selecting a user -->
                <div class="form-group">
                    <label for="userSelect">Seleziona Utente:</label>
                    <div class="autocomplete-container">
                        <input type="text" id="userSelect" name="userSelect" oninput="showAutocomplete(this.value)">
                        <div id="autocompleteResults" class="autocomplete-results"></div>
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
    var userList = <?php echo json_encode(getListaElencoUtenti()); ?>;

    // Filter the user list based on the input value
    var filteredUsers = userList.filter(function(user) {
        return user.username.toLowerCase().includes(inputValue.toLowerCase());
    });

    // Display the autocomplete results
    var autocompleteResults = document.getElementById('autocompleteResults');
    autocompleteResults.innerHTML = '';

    filteredUsers.forEach(function(user) {
        var option = document.createElement('div');
        option.textContent = user.username;
        option.addEventListener('click', function() {
            document.getElementById('userSelect').value = user.username;
            autocompleteResults.innerHTML = '';
        });
        autocompleteResults.appendChild(option);
    });

    // Show/hide the autocomplete results container based on the number of results
    autocompleteResults.style.display = filteredUsers.length > 0 ? 'block' : 'none';
}

// Close the autocomplete results when clicking outside the input and results
document.addEventListener('click', function(event) {
    var autocompleteContainer = document.querySelector('.autocomplete-container');
    var autocompleteResults = document.getElementById('autocompleteResults');

    if (!autocompleteContainer.contains(event.target)) {
        autocompleteResults.style.display = 'none';
    }
});
</script>
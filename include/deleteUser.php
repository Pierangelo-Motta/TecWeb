<?php
require_once('login.model.php');
//require_once('userList.php');

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
                        <input type="text" id="userSelect" name="userSelect"
                            oninput="showAutocomplete(this.value, 'userSelect','deleteUserAutocompleteResults')">
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

<script src="javascript/userList.js"></script>
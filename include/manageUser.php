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

.userSelect {
    width: 100px;
}

.autocomplete-container {
    position: relative;
}

.autocomplete-results {
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

.autocomplete-results div {
    padding: 8px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #ccc;
}

.autocomplete-results div:hover {
    background-color: #f0f0f0;
}
</style>

<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="" method="post">

                <!-- Dropdown menu for selecting a user -->
                <div class="form-group">
                    <label for="manageThisUser">Seleziona Utente:</label>
                    <div class="autocomplete-container">
                        <input type="text" id="manageThisUser" name="manageThisUser"
                            oninput="showAutocomplete(this.value,'manageThisUser','autocompleteResults')">
                        <div id="autocompleteResults" class="autocomplete-results"></div>
                    </div>
                </div>

                <!-- Checkbox for checking isAdmin field -->
                <div class="form-group">
                    <label for="isAdminCheckbox">Amministratore:</label>
                    <input type="checkbox" id="isAdminCheckbox" name="isAdmin" value="1">
                </div>

                <!-- Checkbox for status field -->
                <div class="form-group">
                    <label for="userBannedCheckbox">Blocco Utente:</label>
                    <input type="checkbox" id="userBannedCheckbox" name="userBannedCheckbox" value="1">
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>

            </form>

        </div>
    </div>
</div>

<script src="javascript/userList.js"></script>
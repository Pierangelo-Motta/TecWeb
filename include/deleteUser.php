<?php
require_once('login.model.php');
//require_once('userList.php');

?>


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
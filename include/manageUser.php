
<?php
require_once('login.model.php');

?>

<link rel="stylesheet" href="css/settingPage.css">
<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <form action="include/updateUserProperties.php" method="post">
                
                <!-- Dropdown menu for selecting a user -->
                <div class="form-group">
                    <label for="manageThisUser">Seleziona Utente:</label>
                    <div class="autocomplete-container">
                        <input type="text" id="manageThisUser" name="manageThisUser" placeholder="Seleziona l'utente dalla lista">
                        <div id="autocompleteResults" class="autocomplete-results"></div>
                    </div>
                </div>
                
                <!-- Checkbox for checking isAdmin field -->
                <!-- DONE: show the checkbox already flagged if selected user is admin or banned.. -->
                <div class="form-group" id="adminBox">
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
                    <input type="submit" class="btn btn-primary" value="Salva">
                </div>
                
            </form>
            
        </div>
    </div>
</div>

<script src="javascript/userList.js"></script>
<?php
require_once('login.model.php');
?>

<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="include/updateUserDescription.php" method="post">

                <div class="form-group">
                    <label for="userDescription">Descrizione Utente</label>
                    <textarea id="userDescription"
                        name="userDescription"><?php echo getUserDescription($_SESSION['username']); ?></textarea>
                    <!-- You can add a submit button and update.php to handle form submission -->
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Salva le modifiche">
                </div>
            </form>

        </div>
    </div>
</div>
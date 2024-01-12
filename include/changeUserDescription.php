<?php
require_once('login.model.php');
?>


<!-- FIXME: does not work without embedded style!!-->
<!-- <link rel="stylesheet" type="text/css" href="../css/changeImageCard.css"> -->
<style>
.card {
    /* width */
    max-width: 600px;
    /* for vertical centering */
    margin: 2rem auto;
    /* for spaces*/
    padding: 2rem;

}

.textarea {
    width: 500px;
}
</style>


<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="updateUserDescription.php" method="post">

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
<!-- FIXME: does not work without embedded style!!-->
<!-- <link rel="stylesheet" type="text/css" href="../css/changeImageCard.css"> -->
<style>
.card {
    /* width */
    max-width: 400px;
    /* for vertical centering */
    margin: 2rem auto;
    /* for spaces*/
    padding: 2rem;
}
</style>
<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="include/upload.php" method="post" enctype="multipart/form-data">
                <label for="image" class="mb-3">Seleziona l'immagine:</label>
                <!-- Add mb-3 to the label for bottom margin -->
                <input type="file" name="image" id="image" accept="image/*" required class="mb-3">
                <!-- Add mb-3 to the file input for bottom margin -->
                <input type="submit" class="btn btn-primary" value="Carica Immagine">
            </form>

        </div>
    </div>
</div>
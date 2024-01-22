
<!-- area cambio immagine profilo -->

<link rel="stylesheet" href="css/changeUserImage.css">
<div class="card">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form action="include/upload.php" method="post" enctype="multipart/form-data">
                <label for="image" class="mb-3">Seleziona l'immagine:</label>
                <!-- Add mb-3 to the label for bottom margin -->
                <input type="file" name="image" id="image" accept="image/*" required class="mb-3">

                <!-- preview dell'immagine -->
                <div id="imagePreview" class="mb-3" >
                    <img src="#" alt="Preview immagine profilo">
                </div>

                <!-- Add mb-3 to the file input for bottom margin -->
                <input type="submit" class="btn btn-primary" value="Carica Immagine">
            </form>

        </div>
    </div>
</div>

<script src="javascript/changeUserImage.js"></script>
  

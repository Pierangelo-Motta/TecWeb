<?php
session_start();

if (!($_SESSION['loggedin'] === true)) {
//user is not logged in go to login page
header("Location: index.html");
}
?>

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>settingPage</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
  </head>
  <body>
    <?php require('navbarSelect.php'); ?>

    <main class="container">
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
          <h1>Impostazioni</h1>
        </div>
        <div class="col-md-4">
        </div>
      </div>
      <br/>
      <br/>
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
          <ul class="list-unstyled">
            <li><a href="#" onclick="showContent('password')">Cambia password</a></li>
            <li><a href="#" onclick="showContent('description')">Modifica la tua descrizione utente</a></li>
            <li><a href="#" onclick="showContent('profile')">Cambia immagine del profilo</a></li>
            <li><a href="#" onclick="showContent('delete')">Elimina account</a></li>
          </ul>
        </div>
        <div class="col-md-4">
        </div>
            <!-- Content for "Cambia password" -->
            <div id="passwordContent" style="display: none;" class="col-md-12 text-center">
                <!-- Content for changing password -->
                <p>Pannello Cambio Password</p>
                <?php
                include('include/changePassword.php');
                if (isset($_GET['password_changed']) && $_GET['password_changed'] == 1) {
                  echo '<p class="success-message">La Password è stata cambiata!</p>';
                }
                ?>
            </div>

            <!-- Content for "Modifica la tua descrizione utente" -->
            <div id="descriptionContent" style="display: none;" class="col-md-12 text-center">
                <!-- Content for modifying user description -->
                <p>Modifica Descrizione Utente</p>
                <?php include('include/changeUserDescription.php'); ?>
            </div>

            <!-- Content for \"Cambia immagine del profilo\" -->
            <div id="profileContent" style="display: none;" class="col-md-12 text-center">
                <!-- Content for changing profile image -->
                <p>Modifica Immagine Profilo</p>
                <?php include('include/changeUserImage.php'); ?>
            </div>

            <!-- Content for "Elimina account" -->
            <div id="deleteContent" style="display: none;" class="col-md-12 text-center">
                <!-- Content for deleting account -->
                <p>Elimina Profilo Utente</p>
                <?php include('include/deleteUser.php'); ?>

            </div>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous">
    </script>
    <script>
      function showContent(contentType) {
          document.getElementById('passwordContent').style.display = 'none';
          document.getElementById('descriptionContent').style.display = 'none';
          document.getElementById('profileContent').style.display = 'none';
          document.getElementById('deleteContent').style.display = 'none';

          // Show the selected content section
          document.getElementById(contentType + 'Content').style.display = 'block';
      }
    </script>
  </body>
</html>

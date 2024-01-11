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
        <br />
        <br />
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <ul class="list-unstyled">
                    <li><a href="#" class='password'>Cambia password</a></li>
                    <li><a href="#" class='description'>Modifica la tua descrizione utente</a></li>
                    <li><a href="#" class='profile'>Cambia immagine del profilo</a></li>
                    <li><a href="#" class='delete'>Elimina account</a></li>
                </ul>
            </div>
            <div class="col-md-4">
            </div>
            <!-- Content for "Cambia password" -->
            <div id="passwordContent" style="display: none;" class="col-md-12 text-center content">
                <!-- Content for changing password -->
                <!-- <p>Pannello Cambio Password</p> -->
                <?php
                include('include/changePassword.php');
                ?>
            </div>
            <!-- TODO: mostrare correttamente l'informazione sotto.. AJAX? -->
            <div id="passwordChanged" style="display: none;" class="col-md-12 text-center content">
                <p>La password è stata cambiata correttametne!</p>
            </div>

            <!-- Content for "Modifica la tua descrizione utente" -->
            <div id="descriptionContent" style="display: none;" class="col-md-12 text-center content">
                <!-- Content for modifying user description -->
                <p>Modifica Descrizione Utente</p>
                <?php include('include/changeUserDescription.php'); ?>
            </div>

            <!-- Content for \"Cambia immagine del profilo\" -->
            <div id="profileContent" style="display: none;" class="col-md-12 text-center content">
                <!-- Content for changing profile image -->
                <!-- <p>Modifica Immagine Profilo</p> -->
                <?php include('include/changeUserImage.php'); ?>
            </div>

            <!-- Content for "Elimina account" -->
            <div id="deleteContent" style="display: none;" class="col-md-12 text-center content">
                <!-- Content for deleting account -->
                <p>Elimina Profilo Utente</p>
                <?php include('include/deleteUser.php'); ?>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="settingPage.js"></script>
</body>

</html>
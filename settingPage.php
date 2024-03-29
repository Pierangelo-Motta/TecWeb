<?php
session_start();

if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <title>TecWeb - Gestione Impostazioni </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/landingPage.css">
    <link rel="icon" href="images/favicon_io/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/settingPage.css">
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
                    <?php if (isUserAdmin($_SESSION['username'])) {?>
                    <li><a href="gestioneLibri.php" class='book'>Gestione Libri</a></li>
                    <li><a href="gestioneMedaglieri.php" class='goal'>Gestione Medagliere</a></li>
                    <li><a href="#" class='manage'>Gestisci Utenti</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-4">
            </div>
            <!-- Content for "Cambia password" -->
            <div id="passwordContent"   class="col-md-12 text-center content">
                <!-- Content for changing password -->
                <strong>Cambia la tua Password</strong>
                <?php
                include('include/changePassword.php');
                ?>
            </div>
            <div id="passwordChanged"   class="col-md-12 text-center content">
                <p>La password è stata cambiata correttamente!</p>
            </div>
            <div id="passwordNotChanged2"   class="col-md-12 text-center content">
                <p>Errore: vecchia password non corretta!</p>
            </div>
            <div id="passwordNotChanged1"   class="col-md-12 text-center content">
                <p>Errore: le password non corrispondono.</p>
            </div>            
            <!-- Content for "Modifica la tua descrizione utente" -->
            <div id="descriptionContent"   class="col-md-12 text-center content">
                <!-- Content for modifying user description -->
                <strong>Modifica Descrizione Utente</strong>
                <?php include('include/changeUserDescription.php'); ?>
            </div>

            <!-- Content for \"Cambia immagine del profilo\" -->
            <div id="profileContent"   class="col-md-12 text-center content">
                <!-- Content for changing profile image -->
                <strong>Modifica Immagine Profilo</strong>
                <?php include('include/changeUserImage.php'); ?>
            </div>

            <!-- Content for "Gestisci Libri" -->
            <div id="bookContent"   class="col-md-12 text-center content">
           
            </div>


            <!-- Content for "Elimina account" -->
            <div id="deleteContent"   class="col-md-12 text-center content">
                <!-- Content for deleting account -->
                <strong>Elimina Profilo Utente</strong>
                <?php include('include/deleteUser.php'); ?>

            </div>

            <!-- Content for "GEstisci account" -->
            <div id="manageContent"   class="col-md-12 text-center content">
                <strong>Gestisci Profilo Utente</strong>
                <?php include('include/manageUser.php'); ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="settingPage.js"></script>
</body>

</html>
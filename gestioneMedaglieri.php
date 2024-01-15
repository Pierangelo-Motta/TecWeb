<?php
session_start();
require_once 'include/login.model.php';
require_once 'include/config.php';
require_once 'include/libri.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    // Utente non autenticato, reindirizza alla pagina di login
    header("Location: index.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medaglieri</title>
</head>

<body>
    <h1>Medaglieri</h1>
    <?php
    if (!isUserAdmin($_SESSION['username'])) {
    // Utente non admin
        die("Per accedede alla pagina occorre loggarsi come utente amministratore!");
        exit();
    }
    ?>

    <h2>Informazioni generali</h2>
    

</body>

</html>
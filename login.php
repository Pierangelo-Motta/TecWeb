<?php
session_start();
require_once 'include/config.php';
require_once 'include/login.controller.php';
require_once 'include/login.model.php';

// Set parameters and execute
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the cookie is set and has the value "accept"
// if (!((isset($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] === 'accept') )) {
//     header("Location: index.html");
//     exit;
// }

if (isUserBanned($username)) {
    die("<h1>Utente Bannato!</h1><h2><a href=\"mailto:admin@tecweb.it?subject=Utente%20Bannato\">Contatta l'amministratore</a></h2>");
}

if (isLoginOk($conn, $username, $password)) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['id'] = getUserId($conn, $username, $password);
    header("Location: landingPage.php");
} else {
    // echo "Nome utente o password non corretti. Riprova per favore.";
    // header("Location: indexError.html");
    header("Location: index.html?log=e");
}

?>
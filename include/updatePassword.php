<?php
session_start();
require 'config.php';
require 'login.model.php';


$oldPassword = $_POST['oldPassword'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!($password === $confirm_password)){
    header("Location: ../settingPage.php?pwdup=KO1");
    // die("Errore: le password non corrispondono.");
    die();
}

if (checkUserPassword($conn, $_SESSION['username'], $oldPassword)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE utente SET pwd = ? WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $_SESSION['username']);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['password_changed'] = 1;
            // header("Location: ../settingPage.php");
            header("Location: ../settingPage.php?pwdup=OK");
            exit();
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}
else{
    // die("Errore: vecchia password non corretta");
    header("Location: ../settingPage.php?pwdup=KO2");
    die();
}
    
mysqli_close($conn);

?>
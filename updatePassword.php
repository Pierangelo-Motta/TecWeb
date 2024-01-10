<?php
session_start();
require 'include/config.php';
require 'include/login.model.php';


$oldPassword = $_POST['oldPassword'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (!($password === $confirm_password)){
    die("Errore: le password non corrispondono.");
}

if (checkUserPassword($conn, $_SESSION['username'], $oldPassword)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE utente SET pwd = ? WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $_SESSION['username']);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: settingPage.php?password_changed=1");
            exit();
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}
else{
    die("Errore: vecchia password non corretta");
}
    
mysqli_close($conn);

?>

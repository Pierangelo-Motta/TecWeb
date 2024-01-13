<?php
require_once('login.model.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form
    $selectedUser = isset($_POST['manageThisUser']) ? $_POST['manageThisUser'] : '';
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0; 
    $userBanned = isset($_POST['userBannedCheckbox']) ? 1 : 0; 

    updateUserData($selectedUser, $isAdmin, $userBanned);
    
    $_SESSION['updated_user_information'] = true;
    //echo "OK: informazioni utente aggiorante " . $_SESSION['updated_user_information'] . " " . $selectedUser . " ". $isAdmin . " " . $userBanned;
    header('Location: ../settingPage.php');
    exit();
}
?>
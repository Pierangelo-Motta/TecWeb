<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the form
    $selectedUser = isset($_POST['userSelect']) ? $_POST['userSelect'] : '';
    $logMessage = date("Ymd-His") . ": Utente " . $selectedUser . " cancellato dal DB!\n";
    error_log($logMessage, 3, "phplogfile_deletedUsers.log");
    
    //TODO: implementare la funzione?
    // deleteUserFromDb($selectedUser);
    
    $_SESSION['risultato'] = 1;
    // TODO: gestire il risultato..
    header('Location: ../settingPage.php?userdel=1');
    exit();
}



?>
<?php
require_once 'config.php';

function getUserId(object $conn, string $username){
    $sql = "SELECT id FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return  $result->fetch_assoc()['id'];
    } else {
        return -1;
    }
    
}

function checkUserPassword(object $conn, string $username, string $password){
    $sql = "SELECT id, pwd FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if (password_verify($password, $result->fetch_assoc()['pwd'])) {
        return true;
    }
    else{
        return false;
    }
}


function getUserImage(string $username){
    global $conn;
    $sql = "SELECT immagineProfilo FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    $imageName = $result->fetch_assoc()['immagineProfilo'];
    $defaultProfileImage = "images/users/default.png";
    $image = "images/users/" . $imageName;
    try {
        if (is_file($image) && (getimagesize($image) !== false)) {
                return $image;
            }
    }
    catch (Exception $e) {
        // qualcosa è andato storto
        echo '<script>';
        echo 'console.log("Errore nel reperire l\'immagine del profilo utente da db");';
        echo '</script>';   
        }
    return $defaultProfileImage;
}

?>
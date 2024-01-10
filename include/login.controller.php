<?php
require_once 'config.php';

function isLoginOk(object $conn, string $username, string $password){
   
    if (getUserId($conn, $username, $password) > 0 && checkUserPassword($conn, $username, $password)) {
        return true;
    } else {
        return false;
    }
    
}

function getUserImage(string $username){
    $defaultProfileImage = "images/users/default.png";
    $image = "images/users/" . getDbImageName($username);
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

function deleteOldImage(string $pathToImage,string $imageName){
    //echo "PATH:" . $pathToImage . " NAME:" . $imageName;
    //echo "<br>" . $fp;
    if ($imageName !== "default.png") {
        try {
            unlink($pathToImage.$imageName);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

?>
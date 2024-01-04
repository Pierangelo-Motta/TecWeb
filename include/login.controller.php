<?php
require_once 'config.php';

function isLoginOk(object $conn, string $username, string $password){
   
    if (getUserId($conn, $username, $password) > 0 && checkUserPassword($conn, $username, $password)) {
        return true;
    } else {
        return false;
    }
    
}
?>
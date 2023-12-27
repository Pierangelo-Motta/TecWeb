<?php
require_once 'config.php';

function isLoginOk(object $conn, string $username, string $password){
   
    if (getUserId($conn, $username, $password) > 0) {
        return  true;
    } else {
        return false;
    }
    
}
?>
<?php
require_once 'config.php';

function getUserId(object $conn, string $username){
    $sql = "SELECT id FROM users WHERE username = ?";
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
    $sql = "SELECT id, pwd FROM users WHERE username = ?";
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


?>
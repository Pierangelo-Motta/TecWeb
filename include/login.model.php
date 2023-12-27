<?php
require_once 'config.php';

function getUserId(object $conn, string $username, string $password){
    $sql = "SELECT id FROM users WHERE username = ? AND pwd = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    $result = $stmt->get_result();
    
    
    if ($result->num_rows > 0) {
        return  $result->fetch_assoc()['id'];;
    } else {
        return -1;
    }
    
}
?>
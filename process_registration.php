<?php
session_start();
require 'include/config.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


function checkUser($user){
    $sql = "SELECT username from utente WHERE username = ?";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    //$conn->close();
    
    if ($result->num_rows == 0){
        return true;
    } 
    else{
        //return false;
        die("Error: username already present");
    }
}


if ($password === $confirm_password && checkUser($username)) {
    
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, pwd) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>New user registered successfully.</>";
            echo "<p>Go to <a href=\"index.html\">Login Page</a></p>";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: Passwords do not match.";
}

mysqli_close($conn);

?>
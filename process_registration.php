<?php
session_start();
require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password === $confirm_password) {
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, pwd) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

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
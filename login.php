<?php
session_start();
require 'include/config.php';


// Set parameters and execute
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id FROM users WHERE username = ? AND pwd = ?";
// $sql = "SELECT id FROM users";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $result->fetch_assoc()['id'];
    header("Location: dashboard.php");
} else {
    echo "Invalid username or password. Please try again.";
}

$stmt->close();
$conn->close();
?>
<?php
session_start();
require 'include/config.php';
include_once("include/login.controller.php");
include_once("include/login.model.php");


$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

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
        // die("Nome utente già presente");
        header("Location: register.html?log=u");
        die();
    }
}


if ($password === $confirm_password && checkUser($username)) {
    
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utente (username, pwd, email) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
        mysqli_stmt_bind_param($stmt, "sss", $username, $hashed_password, $email);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Nuovo utente registrato correttamente</>";
            echo "<p>Torna alla <a href=\"index.php\">Login Page</a></p>";

        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);


    //TODO SOLVED JP : sottoscrivere un nuovo utente ai 2 medaglieri standard
    $defaultMedIndex = array(0,1);
    $userId = getUserId1($username);

    foreach ($defaultMedIndex as $medId) {
        $sql = "INSERT INTO sottoscrive (medagliereId, utenteId) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
            mysqli_stmt_bind_param($stmt, "ii", $medId, $userId);
    
            if (mysqli_stmt_execute($stmt)) {
                // echo "<p>Nuovo utente registrato correttamente</>";
                // echo "<p>Torna alla <a href=\"index.php\">Login Page</a></p>";
    
            } else {
                echo "Errore: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }


} else {
    // echo "Errore: le password non corrispondono.";
    header("Location: register.html?log=p");
    die();
}

mysqli_close($conn);

?>
<?php

require_once("include/config.php"); //TODO: possibile fonte di problemi

function execQ($sql){
    global $conn;
    $userIdP = $_POST["userIdP"];
    $dateP = $_POST["dateP"];
    $userIdC = $_POST["userIdC"];
    $dateC = $_POST["dateC"];
    $comm = $_POST["comm"];


    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isiss", $userIdP,  $dateP , $userIdC , $dateC , $comm);

        if (mysqli_stmt_execute($stmt)) {
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.html\">Login Page</a></p>";
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function createComment(){
    $sql = "INSERT INTO commenti(utenteIdPost, dataOraPost, utenteIdComm, dataOraComm, commento) VALUES (?,?,?,?,?);";
    execQ($sql);
}

function deleteComment(){
    $sql = "DELETE FROM commenti WHERE utenteIdPost = ? AND dataOraPost = ? AND utenteIdComm = ? AND dataOraComm = ? AND commento = ?";
    execQ($sql);
}

$funcToExec = $_POST["codeQ"];
switch ($funcToExec) {
    case '1':
        createComment();
        break;
    
    case '2':
        deleteComment();
        break;

    default:
        # code...
        break;
}



?>
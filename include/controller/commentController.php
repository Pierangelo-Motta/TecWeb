<?php

require_once("../config.php"); //TODO: possibile fonte di problemi

function execQ($sql, $isCreate){
    global $conn;

    $a = date("Y-m-d H:i:s", time());
    // echo $a . "<br>";
    // $b = str_replace(" ","__",$a);
    // $b = str_replace(":","_",$b);
    // $b = str_replace("-","_",$b);
    // echo $b;
    
    $userIdP = $_POST["userIdP"];
    $dateP = $_POST["dateP"];
    $userIdC = $_POST["userIdC"];
    $dateC = isset($_POST["dateC"]) ? $_POST["dateC"] : $a; //se è di insert si potrebbe farla calcolare da PHP
    $comm = isset($_POST["comm"]) ? $_POST["comm"] : "";

    

    if ($stmt = mysqli_prepare($conn, $sql)) {
        if($isCreate){
            mysqli_stmt_bind_param($stmt, "isiss", $userIdP,  $dateP , $userIdC , $dateC , $comm);
        } else {
            mysqli_stmt_bind_param($stmt, "isis", $userIdP,  $dateP , $userIdC , $dateC);   
        }
        

        if (mysqli_stmt_execute($stmt)) {
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.php\">Login Page</a></p>";
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function createComment(){
    $sql = "INSERT INTO commenti(utenteIdPost, dataOraPost, utenteIdComm, dataOraComm, commento) VALUES (?,?,?,?,?);";
    execQ($sql, true);
}

function deleteComment(){
    $sql = "DELETE FROM commenti WHERE utenteIdPost = ? AND dataOraPost = ? AND utenteIdComm = ? AND dataOraComm = ?";
    execQ($sql, false);
}

$funcToExec = $_POST["codeQ"];
switch ($funcToExec) {
    case "1":
        createComment();
        break;
    
    case "2":
        deleteComment();
        break;

    default:
        # code...
        break;
}



?>
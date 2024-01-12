<?php

require_once("config.php");

function getLibroIdFromLibroWhereTitle($title){
    global $conn;
    $sql = "SELECT L.id from libro L WHERE L.titolo=?";
    // $sql = "SELECT isAdmin FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);

    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_assoc();
    // print_r($tmp);
    return isset($tmp["id"]) ? $tmp["id"] : 0;
}

function getMedCompletatiByUserId($idUser){
    global $conn;
    $sql = "SELECT M.id
            FROM medagliere M
            WHERE M.id not in(
                SELECT MM.id
                FROM medagliere MM, compone C, libro L, sottoscrive S
                WHERE L.id = C.libroId
                AND C.medagliereId = MM.id
                AND MM.id = S.medagliereId
                AND S.utenteId = ?
                and L.id not in (
                    SELECT P.libroId
                    FROM post P
                    WHERE P.utenteId = ?))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $idUser, $idUser);

    $stmt->execute();

    $result = $stmt->get_result();
    // echo "<br>";
    // print_r($result);
    // echo "<br>";
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');
    //print_r(array_column($tmp, 'id'));
    // return isset($tmp["id"]) ? $tmp["id"] : 0;
}

function getAllMedOfUserId($idUser){
    global $conn;
    $sql = "SELECT M.id
            from medagliere M, sottoscrive S
            where S.utenteId = ?
            and M.id = S.medagliereId;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);

    $stmt->execute();

    $result = $stmt->get_result();

    // echo "<br>";
    // print_r($result);
    // echo "<br>";
    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    // echo "AAA:";
    // print_r($tmp);
    return array_column($tmp, 'id');
    //print_r(array_column($tmp, 'id'));
    // return isset($tmp["id"]) ? $tmp["id"] : 0;
}


?>

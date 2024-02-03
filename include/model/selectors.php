<?php

if (isset($GLOBALS["farFromInclude"])) {
    $new = $GLOBALS["farFromInclude"] . DIRECTORY_SEPARATOR . "include/config.php";
    require_once($new);
} else {
    require_once("include/config.php");
}


function getLibroIdFromLibroWhereTitle($title){
    global $conn;
    $sql = "SELECT L.id from libro L WHERE L.titolo=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);

    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_assoc();
    return isset($tmp["id"]) ? $tmp["id"] : 0;
}


function getMedCompletatiByUserId($idUser){
    global $conn;
    $sql = "SELECT M.id
            FROM medagliere M
            WHERE M.id not in(
                SELECT MM.id
                FROM medagliere MM, compone C, libro L
                WHERE L.id = C.libroId
                AND C.medagliereId = MM.id
                and L.id not in (
                    SELECT P.libroId
                    FROM post P
                    WHERE P.utenteId = ?))";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');

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

    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');

}



// Array ( 
//     [0] => Array ( [titolo] => L'uomo che cammina [nome] => Christian Bobin ) 
//     [1] => Array ( [titolo] => Winnie Puh [nome] => A.A. Milne ) 
//     [2] => Array ( [titolo] => Il primo caffè della giornata [nome] => Toshikazu Kawaguchi ) 
//     )
function getLibroEAutoreByMedagliereId($medID){
    global $conn;
    $sql = "SELECT L.titolo, A.nome
            from libro L, autore A, scrittoda S, compone C
            WHERE C.medagliereId = ?
            and C.libroId = L.id
            and L.id = S.libroId
            and S.autoreId = A.id
            ORDER by  A.nome, L.titolo;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medID);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}

function getMedagliereInfo($medID){
    global $conn;
    $sql = "SELECT *
            from medagliere
            WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medID);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}



function existIdUser(string $userId) {
    global $conn;
    $sql = "SELECT id FROM utente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    } else {
        return -1;
    }
    
}

function checkIfUserReadBook($userId, $libroId){
    global $conn;
    $sql = "SELECT *
            from post p 
            where p.utenteId = ?
            and p.libroId = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $libroId);

    $stmt->execute();

    $result = $stmt->get_result();
        
    return $result->num_rows > 0;
}

function checkIfUserFollowUser($userIdFrom, $userIdTo){
    global $conn;

    $sql = "SELECT * FROM segue S WHERE S.seguenteId=? and S.seguitoId=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userIdFrom, $userIdTo);

    $stmt->execute();

    $result = $stmt->get_result();
        
    return $result->num_rows > 0;
}

function gestisciFollowerFollowed($userIdFrom, $isOttieniFollower){
    global $conn;
    $sql = "";

    if($isOttieniFollower){
        $sql = "SELECT * FROM segue S WHERE S.seguitoId=?;"; 
    } else {
        $sql = "SELECT * FROM segue S WHERE S.seguenteId=?;";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userIdFrom);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}

function ottieniFollower($userIdFrom){
    $isOttieniFollower = true;
    return gestisciFollowerFollowed($userIdFrom, $isOttieniFollower);
}

function ottieniSegue($userIdFrom){
    $isOttieniFollower = false;
    return gestisciFollowerFollowed($userIdFrom, $isOttieniFollower);
}

function getAllMeds(){
    global $conn;
    $sql = "SELECT id
            From medagliere M";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');
}

function getMedsChallengedByUserId($idUser){
    global $conn;
    $sql = "SELECT medagliereId
            From sottoscrive
            where utenteId = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');
}

function getMedInfo($medId){
    global $conn;
    $sql = "SELECT * FROM medagliere M WHERE M.id=?;";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medId);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}

function getLibriLettiDaUserId($idUser){
    global $conn;
    $sql = "SELECT libroId
            From post
            where utenteID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'libroId');

}

function checkIfTagExists($tagText) {
    global $conn;
    $sql = "SELECT id FROM tags WHERE testo = \"" . $tagText . "\";";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['id'];
    } else {
        return -1;
    }
    
}

function getUserIdWithSimilarName($simName){
    global $conn;
    $sql = "SELECT id FROM utente U WHERE U.username LIKE \"%" . $simName . "%\";";
    
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return array_column($tmp, "id");
}



function getCommentInfoByPost($userIdPost, $datePost){
    global $conn;
    $sql = "SELECT utenteIdComm, dataOraComm, commento 
        FROM commenti  
        where utenteIdPost = ? and dataOraPost = ? 
        ORDER BY dataOraComm DESC;";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userIdPost, $datePost);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return $tmp;
}

function checkIfPostExist($userId, $dataPost){
    global $conn;
    $sql = "SELECT *
            from Post P 
            where p.utenteId = ?
            and p.dataOra = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userId, $dataPost);

    $stmt->execute();

    $result = $stmt->get_result();
        
    return $result->num_rows > 0;
}

?>

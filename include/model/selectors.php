<?php

require_once("include/config.php");

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
    $sql = "SELECT MMM.id
            From medagliere MMM, sottoscrive SSS
            WHERE SSS.utenteId = ?
            and SSS.medagliereId = MMM.id
            and MMM.id in(
                SELECT M.id
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
                        WHERE P.utenteId = ?)))";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $idUser, $idUser, $idUser);
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

    // echo "<br>";
    // print_r($result);
    // echo "<br>";
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
            from Post P 
            where p.utenteId = ?
            and p.libroId = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $libroId);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        // return $result->fetch_assoc()['id'];
        return true;
    } else {
        return false;
    }
}

function checkIfUserFollowUser($userIdFrom, $userIdTo){
    global $conn;

    $sql = "SELECT * FROM segue S WHERE S.seguenteId=? and S.seguitoId=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userIdFrom, $userIdTo);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
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
    // $stmt->bind_param("iii", $idUser, $idUser, $idUser);
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
    //print_r(array_column($tmp, 'id'));
    // return isset($tmp["id"]) ? $tmp["id"] : 0;
}

function getMedThatUserNotChallenge($idUser, $textSearch=""){
    global $conn;
    $sql = "SELECT M.id 
            From medagliere M
            where M.titolo like \"%" . $textSearch . "%\"
            and M.id not in(select S.medagliereId
                        from sottoscrive S
                        where S.utenteId = ?);";
    // echo $sql;
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'id');
    //print_r(array_column($tmp, 'id'));
    // return isset($tmp["id"]) ? $tmp["id"] : 0;
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
            where utenteID=?";
    
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
    // $stmt->bind_param("s", $tagText);

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
    // $stmt->bind_param("s", $simName);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return array_column($tmp, "id");
}

?>

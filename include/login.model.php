<?php
require_once 'config.php';

function getUserId(object $conn, string $username){
    
    $sql = "SELECT id FROM utente WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return  $result->fetch_assoc()['id'];
    } else {
        return -1;
    }
    
}

function getUserId1(string $username) {
    global $conn;
    $sql = "SELECT id FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        return  $result->fetch_assoc()['id'];
    } else {
        return -1;
    }
    
}

function checkUserPassword(object $conn, string $username, string $password){
    $sql = "SELECT id, pwd FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if (password_verify($password, $result->fetch_assoc()['pwd'])) {
        return true;
    }
    else{
        return false;
    }
}


function getDbImageName(string $username){
    global $conn;
    $sql = "SELECT immagineProfilo FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['immagineProfilo'];
}

function uploadImageName($username, $imageName){
    global $conn;
    $sql = "UPDATE utente SET immagineProfilo = ? WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $imageName,$username);
    $stmt->execute();
    $stmt->close();
    
}

function getUserPasswod(string $username){
    global $conn;
    $sql = "SELECT pwd FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['pwd'];
}

function getUserDescription(string $username){
    global $conn;
    $sql = "SELECT descrizione FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['descrizione'];
}

function updateUserDescription(string $username, string $text){
    global $conn;
    $sql = "UPDATE utente SET descrizione = ? WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $text,$username);
    $stmt->execute();
    $stmt->close();
}

function isUserAdmin(string $username){
    global $conn;
    $sql = "SELECT isAdmin FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['isAdmin'] ? 1 : 0;
    
}

function isUserBanned($username){
    global $conn;
    $sql = "SELECT stato FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['stato'] ? 1 : 0;
}


function getListaElencoUtenti(){
    global $conn;
    $sql = "SELECT id,username,isAdmin,stato FROM utente where username != 'admin'";
    // $sql = "SELECT id,username,isAdmin,stato FROM utente";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("s", $username);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);

}

function tmpGetUsernameById($userid){
    global $conn;
    $sql = "SELECT username FROM utente WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userid);

    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc()['username'];
}

function updateUserData(string $selectedUser, string $isAdmin, string $userBanned){
    global $conn;
    $sql = "UPDATE utente SET isAdmin = ?, stato = ? WHERE username = ?";
    
    // Log the query and parameters to a file
    $logMessage = "Query: $sql, Parameters: [isAdmin=$isAdmin, stato=$userBanned,username=$selectedUser]";
    error_log($logMessage, 3, "phplogfile.log");
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $isAdmin, $userBanned, $selectedUser);
    $stmt->execute();
    $stmt->close();

}


function saveBooks(array $books){
    global $conn;
    $sql = "INSERT INTO compone (libroId, medagliereId) VALUES (?, ?)";
    
    // TODO: manage medaglieri update?
    // $sql = "UPDATE compone SET libroId = ? WHERE medagliereId = ?";
    
    $stmt = $conn->prepare($sql);
    
    foreach ($books as $book) {
        $stmt->bind_param('ss', $book['id'], $book['medagliere_id']);
        $stmt->execute();
    }
    
    $stmt->close();

};



?>
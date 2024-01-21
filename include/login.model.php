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
    

    // Assuming $books array has 'id' and 'medagliere_id' keys
    $medagliereId = $books[0]['medagliere_id'];

    // Check if the medagliere already exists
    $checkSql = "SELECT COUNT(*) as conta FROM compone WHERE medagliereId = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('i', $medagliereId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $row = $checkResult->fetch_assoc();

    // If the conta is greater than 0, the medagliere already exists
    if ($row['conta'] > 0) {
        // TODO: Decide what to do when the medagliere already exists
        // For example, update existing records or skip insertion
        // echo "Medagliere already exists. You may want to update existing records or skip insertion.";
        $sqlDelete = "DELETE FROM compone WHERE medagliereId = ?";
    
        $stmtDelete = $conn->prepare($sqlDelete);
   
        $stmtDelete->bind_param('i', $medagliereId);
        $stmtDelete->execute();
    
        $stmtDelete->close();
        //return;
    }

    $checkStmt->close();
    
    $stmt = $conn->prepare($sql);
    
    foreach ($books as $book) {
        $stmt->bind_param('ss', $book['id'], $book['medagliere_id']);
        $stmt->execute();
    }
    
    $stmt->close();

};

// function deleteMedagliere(int $id){
//     global $conn;
//     $sqlDelete = "DELETE FROM compone WHERE medagliereId = ?";
//     $stmtDelete = $conn->prepare($sqlDelete);
//     $stmtDelete->bind_param('i', $id);
//     $stmtDelete->execute();
//     $stmtDelete->close();
// }


// function medagliereHasBooks(int $id){
//     global $conn;
    
//     $checkSql = "SELECT COUNT(*) as numeroMed FROM compone WHERE medagliereId = ?";
//     $checkStmt = $conn->prepare($checkSql);
//     $checkStmt->bind_param('i', $medagliereId);
//     $checkStmt->execute();
//     $checkResult = $checkStmt->get_result();
//     $row = $checkResult->fetch_assoc();
//     $valore = $row['numeroMed']; 
//     $checkStmt->close();

//     if ($valore > 0) {
//         return 1;
//     }else {
//         return 0;
//     }

// }


?>

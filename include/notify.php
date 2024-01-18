<?php
// follow.php

class FollowSystem {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        // Connessione al database
        $this->conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la connessione
        if ($this->conn->connect_error) {
            die("Connessione al database fallita: " . $this->conn->connect_error);
        }
    }

    public function followUser($followerUserId, $userIdToFollow) {
        // Verifica se l'utente è già seguito
        if ($this->isAlreadyFollowing($followerUserId, $userIdToFollow)) {
            return ['status' => 'already_following'];
        }

        // Se non è già seguito, esegui l'azione di "follow"
        $followQuery = "INSERT INTO segue (seguitoId, seguenteId) VALUES ($userIdToFollow, $followerUserId)";

        if ($this->conn->query($followQuery) === TRUE) {
            // Restituisci una risposta di successo
            return ['status' => 'success'];
        } else {
            // Gestisci gli errori di inserimento
            return ['status' => 'error'];
        }
    }

    private function isAlreadyFollowing($followerUserId, $userIdToFollow) {
        // Verifica se l'utente è già seguito
        $checkQuery = "SELECT * FROM segue WHERE seguitoId = $userIdToFollow AND seguenteId = $followerUserId";
        $checkResult = $this->conn->query($checkQuery);

        return ($checkResult->num_rows > 0);
    }

    public function closeConnection() {
        // Chiudi la connessione al database
        $this->conn->close();
    }
}

// Assicurati di sostituire le seguenti informazioni con le tue credenziali
$servername = "localhost";
$username = "il_tuo_username";
$password = "la_tua_password";
$dbname = "il_tuo_database";

// Inizializza la classe FollowSystem
$followSystem = new FollowSystem($servername, $username, $password, $dbname);

// Esempio di utilizzo della classe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera l'ID dell'utente da seguire dalla richiesta AJAX
    $userIdToFollow = $_POST['userId'];

    // Recupera l'ID dell'utente che sta eseguendo l'azione (puoi modificarlo a seconda del tuo sistema di autenticazione)
    $followerUserId = 1; // Sostituisci con il tuo sistema di autenticazione

    // Esegui l'azione di "follow"
    $result = $followSystem->followUser($followerUserId, $userIdToFollow);

    // Restituisci la risposta in formato JSON
    echo json_encode($result);
}

// Chiudi la connessione al database alla fine dello script
$followSystem->closeConnection();
?>

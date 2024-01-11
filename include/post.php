<?php

require_once 'config.php';

class Post {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPost() {
        if (!$this->conn) {
            die("Database connection not established.");
        }

        $stmt = $this->conn->prepare("SELECT u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
                                FROM post p, utente u, libro l WHERE p.utenteId = u.id AND p.libroId = l.id ORDER BY p.dataOra");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

$post = new Post($conn);
$posts = $post->getPost();

?>

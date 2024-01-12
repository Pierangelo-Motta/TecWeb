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

        if (isset($_GET['id'])) {
            $user_id = $_GET['id'];


            $stmt = $this->conn->prepare("SELECT u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
                                    FROM post p, utente u, libro l
                                    WHERE p.utenteId = u.id AND p.libroId = l.id
                                    AND p.utenteId = ?
                                    ORDER BY p.dataOra DESC");

            $stmt->bind_param("i", $user_id);

            if (!$stmt->execute()) {
                die("Errore nella query: " . $stmt->error);
            }

            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'anno/i',
        'm' => 'mese/i',
        'w' => 'settimana/e',
        'd' => 'giorno/i',
        'h' => 'ora/e',
        'i' => 'minuto/i',
        's' => 'secondo/i',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return count($string) > 0 ? implode(', ', $string) . ' fa' : 'ora';
}

$post = new Post($conn);
$posts = $post->getPost();

?>

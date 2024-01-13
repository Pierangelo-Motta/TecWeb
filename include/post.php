<?php
require_once 'config.php';

class Post {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPost($user_id = null) {
        if (!$this->conn) {
            die("Database connection not established.");
        }

        if ($user_id === null){
            $query = "SELECT u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
                      FROM post p
                      INNER JOIN utente u ON p.utenteId = u.id
                      INNER JOIN libro l ON p.libroId = l.id
                      ORDER BY p.dataOra DESC";
            $stmt = $this->conn->prepare($query);
        } else {
            $query = "SELECT u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
                      FROM post p
                      INNER JOIN utente u ON p.utenteId = u.id
                      INNER JOIN libro l ON p.libroId = l.id
                      WHERE p.utenteId = ?
                      ORDER BY p.dataOra DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
        }

        if (!$stmt->execute()) {
            die("Errore nella query: " . $stmt->error);
        }

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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

function getPostImage($username, $imageName) {
    $imagePath = "images/post/posted/" . $username . "/" . $imageName;
    if (file_exists($imagePath)) {
        return $imagePath;
    }
}

$post = new Post($conn);

$user_id_to_fetch = ($_SESSION['loggedin'] === true) ? $_SESSION['id'] : null;

$posts = $post->getPost($user_id_to_fetch);
?>

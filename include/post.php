<?php
require_once 'config.php';

$is_discovery_page = false;
$is_landing_page = false;
$is_profile_page = false;

class Post {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getDiscoveryPosts($user_id) {
        if (!$this->conn) {
            return array();
        }

        $query = "SELECT u.immagineProfilo, u.username, p.utenteId, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo,
        GROUP_CONCAT(t.testo) AS elencoTag
        FROM post p
        INNER JOIN utente u ON p.utenteId = u.id
        INNER JOIN libro l ON p.libroId = l.id
        LEFT JOIN tagperpost tp ON p.utenteId = tp.utenteIdPost AND p.dataOra = tp.dataOraPost
        LEFT JOIN tags t ON tp.tagId = t.id
        WHERE p.utenteId != ? AND p.utenteId NOT IN (SELECT seguitoId FROM segue WHERE seguenteId = ?)
        GROUP BY p.utenteId, p.dataOra
        ORDER BY p.dataOra DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $user_id);


        return $this->executeAndGetPosts($stmt);
    }

    public function getLandingPosts($user_id) {
        if (!$this->conn) {
            return array();
        }

        $query = "SELECT u.immagineProfilo, u.username, p.utenteId, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo,
            GROUP_CONCAT(t.testo) AS elencoTag
            FROM post p
            INNER JOIN utente u ON p.utenteId = u.id
            INNER JOIN libro l ON p.libroId = l.id
            INNER JOIN segue s ON p.utenteId = s.seguitoId
            LEFT JOIN tagperpost tp ON p.utenteId = tp.utenteIdPost AND p.dataOra = tp.dataOraPost
            LEFT JOIN tags t ON tp.tagId = t.id
            WHERE s.seguenteId = ?
            GROUP BY p.utenteId, p.dataOra
            ORDER BY p.dataOra DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);

        return $this->executeAndGetPosts($stmt);
    }

    public function getProfilePosts($profile_id) {
        if (!$this->conn) {
            return array();
        }

        $query = "SELECT u.id AS utenteId, u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo,
            GROUP_CONCAT(t.testo) AS elencoTag
            FROM post p
            INNER JOIN utente u ON p.utenteId = u.id
            INNER JOIN libro l ON p.libroId = l.id
            LEFT JOIN tagperpost tp ON p.utenteId = tp.utenteIdPost AND p.dataOra = tp.dataOraPost
            LEFT JOIN tags t ON tp.tagId = t.id
            WHERE p.utenteId = ?
            GROUP BY p.utenteId, p.dataOra
            ORDER BY p.dataOra DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $profile_id);

        return $this->executeAndGetPosts($stmt);
    }

    private function executeAndGetPosts($stmt) {
        if (!$stmt->execute()) {
            return array();
        }

        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $posts;
    }

    private function getLikesCount($utenteId, $dataOra) {
        $query = "SELECT counterMiPiace FROM post WHERE utenteId = ? AND dataOra = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $utenteId, $dataOra);

        $likesCount = 0;

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $likesCount = $row ? $row['counterMiPiace'] : 0;
        }

        $stmt->close();

        return $likesCount;
    }

    private function getLovesCount($utenteId, $dataOra) {
        $query = "SELECT counterAdoro FROM post WHERE utenteId = ? AND dataOra = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $utenteId, $dataOra);

        $lovesCount = 0;

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $lovesCount = $row ? $row['counterAdoro'] : 0;
        }

        $stmt->close();

        return $lovesCount;
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
    return is_file($imagePath) ? $imagePath : null;
}

function getFollowingUsers($user_id, $conn) {
    $query = "SELECT seguitoId FROM segue WHERE seguenteId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if (!$stmt->execute()) {
        return array();
    }

    $result = $stmt->get_result();
    $following_users = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $following_users;
}

$post = new Post($conn);

if ($is_discovery_page) {
    $posts_discovery = $post->getDiscoveryPosts($_SESSION['id']);
} elseif ($is_landing_page) {
    $posts_landing = $post->getLandingPosts($_SESSION['id']);
} elseif ($is_profile_page && isset($profile_id)) {
    $posts_profile = $post->getProfilePosts($profile_id);
}



?>

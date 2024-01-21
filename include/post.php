<?php
require_once 'config.php';

class Post {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPost($user_id = null, $following = false) {
        if (!$this->conn) {
            return array();
        }

        if ($following) {
            $query = "SELECT u.immagineProfilo, u.username, p.utenteId, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
            FROM post p
            INNER JOIN utente u ON p.utenteId = u.id
            INNER JOIN libro l ON p.libroId = l.id
            INNER JOIN segue s ON p.utenteId = s.seguitoId
            WHERE s.seguenteId = ?
            ORDER BY p.dataOra DESC";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $user_id);
        } else {
            if ($user_id === null){
                $query = "SELECT u.immagineProfilo, u.username, p.dataOra, p.citazioneTestuale, p.fotoCitazione, p.riflessione, p.counterMiPiace, p.counterAdoro, l.titolo
                          FROM post p
                          INNER JOIN utente u ON p.utenteId = u.id
                          INNER JOIN libro l ON p.libroId = l.id
                          WHERE p.utenteId != ?
                          ORDER BY p.dataOra DESC";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $_SESSION["id"]);
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
        }

        if (!$stmt->execute()) {
            return array();
        }

        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $posts;
    }

    public function updateLikes($postID) {
        list($utenteId, $dataOra) = explode('|', $postID);

        $likeUpdateResult = $this->updateLikesInDatabase($utenteId, $dataOra);
        return json_encode($likeUpdateResult);
    }

    private function updateLikesInDatabase($utenteId, $dataOra) {
        $query = "UPDATE post SET counterMiPiace = counterMiPiace + 1 WHERE utenteId = ? AND dataOra = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $utenteId, $dataOra);

        $success = false;
        $newLikesCount = 0;
        $alreadyLiked = false;

        if ($stmt->execute()) {
            $success = true;
            $newLikesCount = $this->getLikesCount($utenteId, $dataOra);
            $alreadyLiked = $this->checkIfAlreadyLiked($utenteId, $dataOra);
        }

        $stmt->close();

        return array('success' => $success, 'data' => array('newLikesCount' => $newLikesCount, 'alreadyLiked' => $alreadyLiked));
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

    private function checkIfAlreadyLiked($utenteId, $dataOra) {
        $query = "SELECT counterMiPiace FROM post WHERE utenteId = ? AND dataOra = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $utenteId, $dataOra);

        $alreadyLiked = false;

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $alreadyLiked = $row && $row['counterMiPiace'] > 0;
        }

        $stmt->close();

        return $alreadyLiked;
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
$following_users = getFollowingUsers($_SESSION['id'], $conn);
$posts_following = $post->getPost($_SESSION['id'], true);
?>

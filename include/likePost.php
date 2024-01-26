<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Utente non autenticato";
    exit;
}

$utenteId = $_POST['utenteId'];
$dataOra = isset($_POST['dataOra']) ? $_POST['dataOra'] : '';
$utenteIdPost = $_SESSION['id'];

$sql_check_like = "SELECT * FROM notifica WHERE tipo = 'K' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?";
$stmt_check_like = $conn->prepare($sql_check_like);
$stmt_check_like->bind_param("iis", $utenteId, $utenteIdPost, $dataOra);
$stmt_check_like->execute();
$alreadyLiked = $stmt_check_like->fetch();
$stmt_check_like->close();

if ($alreadyLiked) {
    $sql_remove_like = "UPDATE post SET counterMiPiace = counterMiPiace - 1 WHERE utenteId = ? AND dataOra = ?";
    $stmt_remove_like = $conn->prepare($sql_remove_like);
    $stmt_remove_like->bind_param("is", $utenteId, $dataOra);
    $stmt_remove_like->execute();
    $stmt_remove_like->close();

    $sql_remove_notification = "DELETE FROM notifica WHERE tipo = 'K' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?";
    $stmt_remove_notification = $conn->prepare($sql_remove_notification);
    $stmt_remove_notification->bind_param("iis", $utenteId, $utenteIdPost, $dataOra);
    $stmt_remove_notification->execute();
    $stmt_remove_notification->close();

    $result = array("status" => "success", "likeRemoved" => true);
} else {
    $sql_add_like = "UPDATE post SET counterMiPiace = counterMiPiace + 1 WHERE utenteId = ? AND dataOra = ?";
    $stmt_add_like = $conn->prepare($sql_add_like);
    $stmt_add_like->bind_param("is", $utenteId, $dataOra);
    $result_add_like = $stmt_add_like->execute();

    if ($result_add_like !== false) {
        $sql_get_post_data = "SELECT dataOra FROM post WHERE utenteId = ? AND dataOra = ?";
        $stmt_get_post_data = $conn->prepare($sql_get_post_data);
        $stmt_get_post_data->bind_param("is", $utenteId, $dataOra);
        $stmt_get_post_data->execute();
        $stmt_get_post_data->bind_result($post_dataOra);
        $stmt_get_post_data->fetch();
        $stmt_get_post_data->close();

        $tipo_notifica = "K";
        $sql_insert_notification = "INSERT INTO notifica(tipo, utenteId, utenteIdPost, dataOraPost) VALUES (?, ?, ?, ?)";
        $stmt_insert_notification = $conn->prepare($sql_insert_notification);
        $stmt_insert_notification->bind_param("siis", $tipo_notifica, $utenteId, $utenteIdPost, $post_dataOra);
        $result_insert_notification = $stmt_insert_notification->execute();

        if ($result_insert_notification !== false) {
            $result = array("status" => "success", "likeRemoved" => false);
        } else {
            $result = array("status" => "error", "message" => "Errore SQL nell'inserimento della notifica: " . mysqli_error($conn));
        }

        $stmt_insert_notification->close();
    } else {
        $result = array("status" => "error", "message" => "Errore SQL nell'aggiornamento dei Mi Piace: " . mysqli_error($conn));
    }

    $stmt_add_like->close();
}

$conn->close();
echo json_encode($result);
?>

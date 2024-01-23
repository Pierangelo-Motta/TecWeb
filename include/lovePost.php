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

$sql_check_love = "SELECT * FROM notifica WHERE tipo = 'V' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?";
$stmt_check_love = $conn->prepare($sql_check_love);
$stmt_check_love->bind_param("iis", $utenteId, $utenteIdPost, $dataOra);
$stmt_check_love->execute();
$alreadyloved = $stmt_check_love->fetch();
$stmt_check_love->close();

if ($alreadyloved) {
    $sql_remove_love = "UPDATE post SET counterAdoro = counterAdoro - 1 WHERE utenteId = ? AND dataOra = ?";
    $stmt_remove_love = $conn->prepare($sql_remove_love);
    $stmt_remove_love->bind_param("is", $utenteId, $dataOra);
    $stmt_remove_love->execute();
    $stmt_remove_love->close();

    $sql_remove_notification = "DELETE FROM notifica WHERE tipo = 'V' AND utenteId = ? AND utenteIdPost = ? AND dataOraPost = ?";
    $stmt_remove_notification = $conn->prepare($sql_remove_notification);
    $stmt_remove_notification->bind_param("iis", $utenteId, $utenteIdPost, $dataOra);
    $stmt_remove_notification->execute();
    $stmt_remove_notification->close();

    $result = array("status" => "success", "loveRemoved" => true);
} else {
    $sql_add_love = "UPDATE post SET counterAdoro = counterAdoro + 1 WHERE utenteId = ? AND dataOra = ?";
    $stmt_add_love = $conn->prepare($sql_add_love);
    $stmt_add_love->bind_param("is", $utenteId, $dataOra);
    $result_add_love = $stmt_add_love->execute();

    if ($result_add_love !== false) {
        $sql_get_post_data = "SELECT dataOra FROM post WHERE utenteId = ? AND dataOra = ?";
        $stmt_get_post_data = $conn->prepare($sql_get_post_data);
        $stmt_get_post_data->bind_param("is", $utenteId, $dataOra);
        $stmt_get_post_data->execute();
        $stmt_get_post_data->bind_result($post_dataOra);
        $stmt_get_post_data->fetch();
        $stmt_get_post_data->close();

        $tipo_notifica = "V";
        $sql_insert_notification = "INSERT INTO notifica(tipo, utenteId, utenteIdPost, dataOraPost) VALUES (?, ?, ?, ?)";
        $stmt_insert_notification = $conn->prepare($sql_insert_notification);
        $stmt_insert_notification->bind_param("siis", $tipo_notifica, $utenteId, $utenteIdPost, $post_dataOra);
        $result_insert_notification = $stmt_insert_notification->execute();

        if ($result_insert_notification !== false) {
            $result = array("status" => "success", "loveRemoved" => false);
        } else {
            $result = array("status" => "error", "message" => "Errore SQL nell'inserimento della notifica: " . mysqli_error($conn));
        }

        $stmt_insert_notification->close();
    } else {
        $result = array("status" => "error", "message" => "Errore SQL nell'aggiornamento dei Adoro: " . mysqli_error($conn));
    }

    $stmt_add_love->close();
}

$conn->close();

echo json_encode($result);
?>

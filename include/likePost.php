<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Utente non autenticato";
    exit;
}

$utenteId = $_POST['utenteId'];
$dataOra = isset($_POST['dataOra']) ? $_POST['dataOra'] : '';

$sql_add_like = "UPDATE post SET counterMiPiace = counterMiPiace + 1 WHERE utenteId = ? AND dataOra = ?";
$stmt = $conn->prepare($sql_add_like);

$stmt->bind_param("is", $utenteId, $dataOra);
$result = $stmt->execute();

if ($result !== false) {
    echo "success";
} else {
    echo "error";
    echo "Errore SQL: " . $stmt->error;
}
?>

<?php
session_start();

require_once("config.php");
include_once("model/insertOnDB.php");

function getUserName($id, $conn) {
    $query = "SELECT username FROM utente WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['username'];
    } else {
        return "Nome utente non disponibile";
    }
}



$notifications = getNotifications($_SESSION["id"]);

$notificationMessages = array();

foreach ($notifications as $notification) {
    $followerId = $notification["utenteIdPost"];
    $followerUsername = getUserName($followerId, $conn);

    $notificationMessage = "$followerUsername ha iniziato a seguirti!";
    $notificationMessages[] = $notificationMessage;
}

echo implode('<br>', $notificationMessages);
?>

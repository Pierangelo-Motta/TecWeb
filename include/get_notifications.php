<?php
session_start();

require_once("config.php");
include_once("model/insertOnDB.php");

function getUserName($id, $conn) {
    $query = "SELECT username FROM utente WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['username'];
    } else {
        return "Nome utente non disponibile";
    }
}


function getNotificationMessage($notification, $conn) {
    $followerId = $notification["utenteIdPost"];
    $followerUsername = getUserName($followerId, $conn);

    switch ($notification["tipo"]) {
        case "F":
            return "$followerUsername ha iniziato a seguirti!";
        case "K":
            return "$followerUsername ha messo like a un tuo post!";
        case "V":
        return "$followerUsername ha messo love a un tuo post!";
        default:
            return "Nuova notifica!";
    }
}

$notifications = getNotifications($_SESSION["id"]);

$notificationMessages = array();

foreach ($notifications as $notification) {
    $notificationMessage = getNotificationMessage($notification, $conn);
    $notificationMessages[] = $notificationMessage;
}

echo implode('<br>', $notificationMessages);
?>

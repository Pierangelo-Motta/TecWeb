<?php
session_start();

require_once("config.php");

$GLOBALS["farFromInclude"] = "..";
require_once("model/insertOnDB.php");

function getUserName($id, $conn) {
    $query = "SELECT username FROM utente WHERE id = ?;";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $row['username'];
        }
        mysqli_stmt_close($stmt);
    }
    return "Nome utente non disponibile";

}


function getNotificationMessage($notification, $conn) {
    $followerId = $notification["utenteIdPost"];
    $followerUsername = getUserName($followerId, $conn);


    switch ($notification["tipo"]) {
        case "C":
          return "$followerUsername ha commentato il tuo post!";
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

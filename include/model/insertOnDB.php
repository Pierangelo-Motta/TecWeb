<?php

if (isset($GLOBALS["farFromInclude"])) {
    $new = $GLOBALS["farFromInclude"] . DIRECTORY_SEPARATOR . "include/config.php";
    require_once($new);
} else {
    require_once("include/config.php");
}

function createNewPost($userID, $date, $citTex, $citImg, $riflessione, $libroID) {

    // è un pò ad hoc... vediamo se poterlo migliorare TODO
    global $conn;

    $start = "INSERT INTO post(utenteId, dataOra,"; //inizio query
    $end1 = "riflessione, counterMiPiace, counterAdoro, libroId) VALUES("; //completamento prima fase
    $end2 = ");"; //completamento seconda

    $secureParams = 4 + 2; //i due counters
    $amountInsered = 0;

    //creazione completa per specificare cosa inserisco
    $tmp = " ";
    $isSetText = false;
    if (strcmp($citTex, "") != 0) {
        $tmp = $tmp . "citazioneTestuale, ";
        $amountInsered++;
        $isSetText = true;
    }
    if (strcmp($citImg, "") != 0) {
        $tmp = $tmp . "fotoCitazione, ";
        $amountInsered++;
    }
    //vedo quante cose ho aggiunto e vedo quindi quanti ? aggiungere
    $amount = $secureParams + $amountInsered;


    $sql = $start . $tmp . $end1; // completo la prima parte della query

    $querys = "";
    for ($i=0; $i < $amount; $i++) {
        $querys = $querys . "?";
        if ($i != $amount-1) { //se non è l'ultimo, ci vuole spazio e virgola
            $querys = $querys . ", ";
        }
    }

    $sql = $sql . $querys . $end2; // completo la seconda parte della query

    /////////creazione della stringa di binding
    $startBiding = "is"; //indexUser, TODO date
    $endBiding = "siii"; //riflessione, counter1, counter2, libroID

    $betweenBiding = ""; //vedo cosa devo aggiungere
    for ($i=0; $i < $amountInsered; $i++) {
        $betweenBiding = $betweenBiding . "s";
    }

    $biding = $startBiding . $betweenBiding . $endBiding;

    /////////


    $stmt = $conn->prepare($sql);

    $initLikeLove = 0;

    switch ($amountInsered) {
        case 2:
            $stmt->bind_param($biding, $userID, $date, $citTex, $citImg, $riflessione, $initLikeLove, $initLikeLove, $libroID);
            break;

        case 1:
            if($isSetText){
                $stmt->bind_param($biding, $userID, $date, $citTex, $riflessione, $initLikeLove, $initLikeLove, $libroID);
            } else {
                $stmt->bind_param($biding, $userID, $date, $citImg, $riflessione, $initLikeLove, $initLikeLove, $libroID);
            }
            break;

        default:
            header("Location: index.html"); //debug choise: se il programmatore programma male la funzione, se ne accorge subito
            break;
    }

    $stmt->execute();
    $stmt->close();
}

function savePostedPhoto($imgRelPath, $userName){
    // Get the absolute path to the current directory
    $currentDirectory = __DIR__;


    /////////////// estrazione nome della foto
    $dirs = explode("/", $imgRelPath);
    $imgName = $dirs[sizeof($dirs)-1];

    $timeStampTMP = date("Y-m-d H:i:s", time());
    $timeStamp = str_replace(" ", "__", $timeStampTMP);
    $timeStamp = str_replace(":", "_", $timeStamp);
    $timeStamp = str_replace("-", "_", $timeStamp);

    $tmp1 = explode(".", $imgName);
    $extension = $tmp1[sizeof($tmp1)-1];
    $newImgName = "";
    for ($i=0; $i < (sizeof($tmp1)-1); $i++) {
        $newImgName = $newImgName . $tmp1[$i];
    }
    ///////////////


    // nuovo nome della foto
    $newImgName = $newImgName . "__" . $timeStamp . "." . $extension;

    $distanceByRoot = DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

    // Construct the full path for the source dir
    $fromDir = $currentDirectory . $distanceByRoot . $imgRelPath; //. "images/post/tmp/" . $imageName;
    // e per la destination directory
    $toDir = $currentDirectory . $distanceByRoot . "images/post/posted/" . $userName;

    if (!is_dir($toDir)){
        mkdir($toDir, 0777, true);
    }

    $toDir = $toDir . DIRECTORY_SEPARATOR . $newImgName;

    rename($fromDir, $toDir);
    return $newImgName;
}

function manageFollow($userIDFrom, $userIDTo, $query){
    global $conn;

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $userIDFrom, $userIDTo);

        if (mysqli_stmt_execute($stmt)) {
            $tipo = 'F';
            createNotification($userIDTo, $userIDFrom, $tipo);
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function createFollow($userIDFrom, $userIDTo) {
    $sql = "INSERT INTO segue(seguenteId, seguitoId) VALUES (?,?);";
    manageFollow($userIDFrom, $userIDTo, $sql);
}

function destroyFollow($userIDFrom, $userIDTo) {
    $sql = "DELETE FROM segue WHERE seguenteId=? AND seguitoId=?;";
    manageFollow($userIDFrom, $userIDTo, $sql);
}

function createNotification($userIDTo, $userIDFrom, $tipo) {
    global $conn;

    $notification_query = "INSERT INTO notifica(tipo, utenteId, utenteIdPost, dataOraPost) VALUES (?, ?, ?, NOW())";

    if ($stmt = mysqli_prepare($conn, $notification_query)) {
        // "s" è usato per una stringa
        mysqli_stmt_bind_param($stmt, "sii", $tipo, $userIDTo, $userIDFrom);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Errore nell'inserimento della notifica: " . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}

function getNotifications($userID) {
    global $conn;

    $notifications = array();

    $query = "SELECT * FROM notifica WHERE utenteId = ? ORDER BY dataOra DESC"; // Ordina per data decrescente
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $notifications[] = $row;
        }

        mysqli_stmt_close($stmt);
    }

    return $notifications;
}

function subscribeUserToMed($userID, $medID){
    global $conn;

    $sql = "INSERT INTO sottoscrive(utenteId, medagliereId) VALUES (?,?);";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $userID, $medID);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function createNewTag($textToInsert){
    global $conn;

    $sql = "INSERT INTO tags(testo) VALUES (?);";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $textToInsert);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function embedTagPost($idTag, $userId, $datetime){
    global $conn;

    $sql = "INSERT INTO tagperpost(utenteIdPost, dataOraPost, tagId) VALUES (?,?,?);";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isi", $userId, $datetime,  $idTag);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}




function createNotifyToUserForComment($userIdPost, $datePost, $when, $who) {

    //FIXME luca controllami
    global $conn;
    //FIXME luca controllami
    $sql = "INSERT INTO notifica(utenteId, dataOra, utenteIdPost, dataOraPost, tipo) VALUES (?,?,?,?,?);";

    //FIXME luca controllami
    $tipo = "C"; //TODO luca controllami
    //FIXME luca controllami

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isiss", $who, $when, $userIdPost, $datePost, $tipo);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}

function deleteNotifyToUserForComment($userIdPost, $datePost, $when, $who) {

    //FIXME luca controllami
    global $conn;
    //FIXME luca controllami
    $sql = "DELETE FROM notifica WHERE utenteId = ? AND dataOra = ? AND utenteIdPost = ? AND dataOraPost = ?;";
    //FIXME luca controllami

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "isis", $who, $when, $userIdPost, $datePost);

        if (mysqli_stmt_execute($stmt)) {
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}


?>

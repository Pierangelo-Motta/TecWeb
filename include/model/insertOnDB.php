<?php


require_once("include/config.php");


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

    // echo $sql;
    // echo $biding;

    $stmt = $conn->prepare($sql);

    $initLikeLove = 0; //se no si lamentava, ma aiuta a non diffondere magic number, ci sta

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
            return; //ERROREEEEE TODO lo facciamo presente?
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


    // echo "<br>";
    // echo ("insertOnDB.newImgName: " . $newImgName);
    // echo "<br>";

    // nuovo nome della foto
    $newImgName = $newImgName . "__" . $timeStamp . "." . $extension;

    // echo "<br>";
    // echo ("insertOnDB.newImgName2: " . $newImgName);
    // echo "<br>";

    $distanceByRoot = "/../../";

    // Construct the full path for the source dir
    $fromDir = $currentDirectory . $distanceByRoot . $imgRelPath; //. "images/post/tmp/" . $imageName;
    // e per la destination directory
    $toDir = $currentDirectory . $distanceByRoot . "images/post/posted/" . $userName;

    
    // echo "<br>";
    // echo ("insertOnDB.toDir: " . $toDir);
    // echo "<br>";
    if (!is_dir($toDir)){
        mkdir($toDir, 0777, true);
    }

    //$fromDir = $fromDir . "/" . $imgName;
    $toDir = $toDir . "/" . $newImgName;

    // echo ($fromDir . " " . $toDir);
    rename($fromDir, $toDir);
    return $newImgName;
}

function manageFollow($userIDFrom, $userIDTo, $query){
    global $conn;

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $userIDFrom, $userIDTo);

        if (mysqli_stmt_execute($stmt)) {
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.html\">Login Page</a></p>";
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

function subscribeUserToMed($userID, $medID){
    global $conn;

    $sql = "INSERT INTO sottoscrive(utenteId, medagliereId) VALUES (?,?);";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $userID, $medID);

        if (mysqli_stmt_execute($stmt)) {
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.html\">Login Page</a></p>";
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
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.html\">Login Page</a></p>";
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
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.html\">Login Page</a></p>";
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}
?>
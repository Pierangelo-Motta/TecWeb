<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
}

require_once("../config.php");
//require_once("../model/selectors.php");






function getMedInfo($medId){
    global $conn;
    $sql = "SELECT * FROM medagliere M WHERE M.id=?;";

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medId);

    $stmt->execute();

    $result = $stmt->get_result();

    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}


function getLibroEAutoreByMedagliereId($medID){
    global $conn;
    $sql = "SELECT L.titolo, A.nome
            from libro L, autore A, scrittoda S, compone C
            WHERE C.medagliereId = ?
            and C.libroId = L.id
            and L.id = S.libroId
            and S.autoreId = A.id
            ORDER by  A.nome, L.titolo;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medID);

    $stmt->execute();

    $result = $stmt->get_result();

    // echo "<br>";
    // print_r($result);
    // echo "<br>";
    $tmp = $result->fetch_all(MYSQLI_ASSOC);
    return $tmp;
}



function getLibroIdFromLibroWhereTitle($title){
    global $conn;
    $sql = "SELECT L.id from libro L WHERE L.titolo=?";
    // $sql = "SELECT isAdmin FROM utente WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $title);

    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_assoc();
    // print_r($tmp);
    return isset($tmp["id"]) ? $tmp["id"] : 0;
}


function obtainList($libriInMedagliere, $who){
    $res = "";
    foreach ($libriInMedagliere as $a) {
        $tmpRes = "";
        if (checkIfUserReadBook($who, getLibroIdFromLibroWhereTitle($a["titolo"]))){
            $tmpRes = "<li> <p class='libroLetto'>";
        } else {
            $tmpRes = "<li> <p class='libroNonLetto'>";
        }
        $nomeLibroS = str_replace(" ", "+", $a["titolo"]);
        $virgola = ",";
        $nomeAutoreS = str_replace(" ", "+", $a["nome"]);
        
        $totalLink = "https://www.google.com/search?q=" . $nomeLibroS . $virgola . "+" . $nomeAutoreS;

        $tmpRes .= "\"<a href=\"" . $totalLink . "\">" . $a["titolo"] . "</a>\" di " . $a["nome"];
        $tmpRes .= "</p></li>";

        $res .= $tmpRes;
    }
    return $res;
}


function checkIfUserReadBook($userId, $libroId){
    global $conn;
    $sql = "SELECT *
            from post p 
            where p.utenteId = ?
            and p.libroId = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $libroId);

    $stmt->execute();

    $result = $stmt->get_result();
        
    if ($result->num_rows > 0) {
        // return $result->fetch_assoc()['id'];
        return true;
    } else {
        return false;
    }
}

function getLibriLettiDaUserId($idUser){
    global $conn;
    $sql = "SELECT libroId
            From post
            where utenteID=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return array_column($tmp, 'libroId');

}













































function exploseStringToArray($toExplode){
    return explode("§", $toExplode);
}











function returnActUser() {  
    //useless

    // //print_r(array_column($tmp, 'id'));
    // // return isset($tmp["id"]) ? $tmp["id"] : 0;
    // //echo "ciao";
    // //echo "--------->>>>>>>>>>>>>>>" . $_SESSION["id"];
    // $tmp = array("id" => $_SESSION["id"]);
    // //print_r($tmp);
    // return json_encode($tmp);
}

function returnAllMissMeds() {
    $idUser = $_GET["userId"];
    $textSearch = $_GET["pTitMed"];

    global $conn;
    $sql = "SELECT M.id 
            From medagliere M
            where M.titolo like \"%" . $textSearch . "%\"
            and M.id not in(select S.medagliereId
                        from sottoscrive S
                        where S.utenteId = ?);";
    // echo $sql;
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return json_encode(array_column($tmp, 'id'));

    // return json_encode(getMedThatUserNotChallenge($userIdToConsider, $searchingMedStr));
}

function getCorrectImg($amountLeastBooks){
    $imgName = "";
    $altImg = "";
    $limits = array(5,15);
    $category = 0;
    while ($amountLeastBooks > 0 && $category < sizeof($limits)){
        $delta = $limits[$category];
        if ($category > 0) {
            $delta = $delta - $limits[$category-1];
        }

        $amountLeastBooks = $amountLeastBooks - $delta;

        if ($amountLeastBooks > 0) {
            $category = $category + 1;
        }
    }

    //magari implementare ricerca binaria?
    switch ($category){
        case 0:
            $imgName = "medagliaFacile.png";
            $altImg = "Ce l'hai quasi fatta!";
            break;
        case 1:
            $imgName = "medagliaMedia.png";
            $altImg = "Non manca troppo dai...";
            break;
        case 2:
            $imgName = "medagliaDifficile.png";
            $altImg = "Meglio se guardi altrove!";
            break;
        default:
            $imgName = "err.png";
            $altImg = "err.png";
            break;
    }
    return array($imgName, $altImg);
    
}

function createOneMed($medToPrint, $indexToConsider, $libriLetti, $who){

    // echo "ciao";
    // print_r($medToPrint);

    $toAdd = "Med" . $indexToConsider;
    $infos = getMedInfo($medToPrint[$indexToConsider])[0];

    //print_r("<br>");
    //print_r($indexToConsider . " / " . $medToPrint[$indexToConsider] . " / " . print_r(getMedInfo($medToPrint[$indexToConsider])[0]) . " §§§");

    $libriInMedagliere = getLibroEAutoreByMedagliereId($medToPrint[$indexToConsider]);
    // echo "<br>";
    // echo $medToPrint[$indexToConsider];
    // echo "<br>";
    // print_r($libriInMedagliere);
    $medBookIndex = array();
    foreach (array_column($libriInMedagliere,"titolo") as $titolo) {
        array_push($medBookIndex, getLibroIdFromLibroWhereTitle($titolo));
    }
    // echo "<br>";
    // echo print_r($medBookIndex);
    // echo "<br>";
    $remainsBook = array_diff($medBookIndex, $libriLetti);
    $canReclame = empty($remainsBook);
    //echo $medToPrint[$indexToConsider];
    //print_r($libriInMedagliere);

    $titleMed = $infos["titolo"];
    
    $descMed = $infos["descrizione"];

    // print_r($libriInMedagliere);
    $books = obtainList($libriInMedagliere, $who);

    $buttonText = "Sfidami!";
    if($canReclame){
        $buttonText = "Reclamami!";
    }
    $buttonValue = $infos["id"];

    $decorativeInfos = getCorrectImg(sizeof($remainsBook));
    // print_r($decorativeInfos);
    $imgToAdd = $decorativeInfos[0];
    $altImg = $decorativeInfos[1];

    $complete = "<div class=\"card medContainer\">" .
                    "<div class=\"card-body\" id=\"" . $toAdd . "\">" .
                        "<h1 class=\"card-text titleMed\">" . $titleMed . "</h1>" .

                        "<div class=\"allMedInfo d-md-flex\">" . 
                            "<div class=\"mx-auto titlecontainer order-md-1\" id=\"titlecontainer" . $toAdd . "\">" . 
                                //d-flex justify-content-center 
                                "<img " .
                                    "src=\"images/medagliereNewIcons/" . $imgToAdd . "\" " .
                                    "alt=\"" . $altImg . "\" " .
                                    "class=\"rounded text-center imgmedagliere mx-auto\" " .
                                    "id=\"imgmedagliere" . $toAdd . "\" " .
                                    "/>" .

                            "</div>" .

                            "<div class=\"infocontainer order-md-0\" id=\"infocontainer" . $toAdd . "\">" . 
                                "<p class=\"descrizioneMed\">" . $descMed . "</p>" . 
                                "<p class=\"messaggio\"> Per completare questo medagliere è necessario:</p>" .
                                "<ol>" . 
                                    $books .
                                "</ol>" . 
                            "</div>" .

                        "</div>" .

                        "<footer>" . 
                            "<button class=\"btn btn-secondary\" " . 
                                "form=\"challengeNewMed\" " . 
                                "type=\"submit\" " .
                                "name=\"submitButton\" ".
                                "value=\"" . $buttonValue . "\">" . $buttonText . "</button>" .
                        "</footer>" .

                    "</div>" .

                "</div>";
    return $complete; //valuta se ritornare un array medagliere-da-stampare / quantità libri mancante per poi sortarlo
}

function byIdsToGUI() {
    $medsToShow = exploseStringToArray($_GET["idMeds"]);
    $who = $_GET["userId"];
    $libriLetti = getLibriLettiDaUserId($who);
    
    // $textSearch = ;
    //print_r($medsToShow);

    $res = "";
    
    for ($i=0; $i < sizeof($medsToShow); $i++) { 
        $res .= createOneMed($medsToShow, $i, $libriLetti, $who);
    }

    return $res;

}


function createSubmission(){
    
    $userID = $_GET["userId"];
    $medID = $_GET["medId"];
    
    global $conn;

    $sql = "INSERT INTO sottoscrive(utenteId, medagliereId) VALUES (?,?);";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $userID, $medID);

        if (mysqli_stmt_execute($stmt)) {
            // echo "<p>Nuovo utente registrato correttamente</>";
            // echo "<p>Torna alla <a href=\"index.php\">Login Page</a></p>";
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}




$command = $_GET["codeQ"];
switch($command) {
    case '0':
        //echo "HIRNIFRIENKFN";
        //print "[" . returnActUser() . "]";
        //return "[" . returnActUser() . "]";
        break;
    case '10':
        echo returnAllMissMeds(); //debug o no?
        //return returnAllMissMeds();
        break;
    case '11':
        echo byIdsToGUI();
        break;
    case '12':
        createSubmission();
        break;
    default:
        header("Location: index.php");
        break;
}



?>
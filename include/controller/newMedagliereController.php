<?php

session_start();
if (!($_SESSION['loggedin'] === true)) {
    //user is not logged in go to login page
    header("Location: index.php");
}

$GLOBALS["farFromInclude"] = ".." . DIRECTORY_SEPARATOR . "..";
require_once("../model/selectors.php");

require_once("../view/formattators.php");



function exploseStringToArray($toExplode){
    return explode("§", $toExplode);
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
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUser);
    $stmt->execute();

    $result = $stmt->get_result();
    $tmp = $result->fetch_all(MYSQLI_ASSOC);

    return json_encode(array_column($tmp, 'id'));
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

    $toAdd = "Med" . $indexToConsider;
    $infos = getMedInfo($medToPrint[$indexToConsider])[0];

    $libriInMedagliere = getLibroEAutoreByMedagliereId($medToPrint[$indexToConsider]);

    $medBookIndex = array();
    foreach (array_column($libriInMedagliere,"titolo") as $titolo) {
        array_push($medBookIndex, getLibroIdFromLibroWhereTitle($titolo));
    }

    $remainsBook = array_diff($medBookIndex, $libriLetti);
    $canReclame = empty($remainsBook);


    $titleMed = $infos["titolo"];
    
    $descMed = $infos["descrizione"];

    $books = obtainList($libriInMedagliere, $who);

    $buttonText = "Sfidami!";
    if($canReclame){
        $buttonText = "Reclamami!";
    }
    $buttonValue = $infos["id"];

    $decorativeInfos = getCorrectImg(sizeof($remainsBook));
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
    return $complete; 
}

function byIdsToGUI() {
    $medsToShow = exploseStringToArray($_GET["idMeds"]);
    $who = $_GET["userId"];
    $libriLetti = getLibriLettiDaUserId($who);
    
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
        } else {
            echo "Errore: " . $sql . "<br>" . mysqli_error($conn); //TODO tenuto per debug
        }
    }

    mysqli_stmt_close($stmt);
}




$command = $_GET["codeQ"];
switch($command) {
    case '10':
        echo returnAllMissMeds(); //debug o no?
        break;
    case '11':
        echo byIdsToGUI();
        break;
    case '12':
        createSubmission();
        break;
    default:
        header("Location: index.php"); //debug choise
        break;
}



?>